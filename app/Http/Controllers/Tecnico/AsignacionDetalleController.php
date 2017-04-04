<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Log, DB;

use App\Models\Inventario\Tipo;
use App\Models\Inventario\Producto;
use App\Models\Base\Tercero;
use App\Models\Tecnico\Contrato;
use App\Models\Tecnico\Asignacion;
use App\Models\Tecnico\AsignacionDetalle;

class AsignacionDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $asignacion2 = [];
            if($request->has('asignacion2')) {
                $query = AsignacionDetalle::query();
                $query->select('asignacion2.*','tipo_nombre as nombre', 'producto.producto_nombre', 'p.producto_nombre as producto_nombre_search')
                ->join('producto', 'asignacion2.asignacion2_producto', '=', 'producto.id')
                ->join('tipo', 'producto.producto_tipo', '=', 'tipo.id')
                ->Leftjoin('producto as p', 'asignacion2_deproducto', '=', 'p.id')
                ->where('asignacion2_asignacion1', $request->asignacion2);
                $asignacion2 = $query->get();
            }
            return response()->json($asignacion2);
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $asignacion2 = new AsignacionDetalle;
            if ($asignacion2->isValid($data)) {
                try {
                    $asignacion = [];
                    if($request->tipo == 'E')
                    {  
                        // Recuperar producto
                        $producto = Producto::where('producto_serie', $request->asignacion2_producto)->whereNull('producto_tercero')->whereNull('producto_contrato')->first();
                        if(!$producto instanceof Producto) {
                            return response()->json(['success' => false, 'errors' => 'Este producto ya esta asignado, por favor verifique la información o consulte al administrador.']);
                        }

                        $tipo = Tipo::find($producto->producto_tipo);
                        if(!$tipo instanceof Tipo) {
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar tipo, por favor verifique la información o consulte al administrador.']);
                        }
                        //Valida tipo producto
                        if(!in_array($tipo->tipo_codigo, ['AC', 'EQ'])){
                            DB::rollback();
                            return response()->json(['success' => false, 'errors' => 'Ingrese un Equipo ó un Accesorio, por favor verifique la información o consulte al administrador.']);  
                        }
                    }

                    if($request->tipo == 'R')
                    {  
                        $tercero = Tercero::where('tercero_nit', $request->tercero)->first();
                        $contrato = Contrato::find($request->contrato);
                        $producto = Producto::where('producto_serie', $request->asignacion2_producto)->where('producto_tercero',$tercero->id)->where('producto_contrato', $contrato->id)->first();
                        $tipo = Tipo::find($producto->producto_tipo);
                        
                        if(!$tercero instanceof Tercero) {
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar cliente, por favor verifique la información o consulte al administrador.']);   
                        }
                        // Recuperar producto
                        if(!$producto instanceof Producto) {
                            return response()->json(['success' => false, 'errors' => 'Este producto ya esta Retirado, por favor verifique la información o consulte al administrador.']);
                        }

                        // Recuperar Tipo
                        if(!$tipo instanceof Tipo) {
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar tipo, por favor verifique la información o consulte al administrador.']);
                        }

                        //Valida tipo producto
                        if(!in_array($tipo->tipo_codigo, ['AC', 'EQ'])){
                            DB::rollback();
                            return response()->json(['success' => false, 'errors' => 'Ingrese un Equipo ó un Accesorio, por favor verifique la información o consulte al administrador.']);  
                        }
                        if($tipo->tipo_codigo == 'EQ'){
                            // Validar contrato tercero
                            if($contrato->contrato_tercero != $tercero->id) {
                                DB::rollback();
                                return response()->json(['success' => false, 'errors' => 'El contrato seleccionado no corresponde al tercero, por favor seleccione de nuevo el contrato o consulte al administrador.']);
                            }

                            $query = AsignacionDetalle::query();
                            $query->select('asignacion2.id as id_asignacion','producto.id as id_producto','producto_nombre','producto_serie as asignacion2_producto','tipo_nombre as nombre', 'tipo_codigo');
                            $query->where('asignacion2_producto', $producto->id);
                            $query->where('asignacion1_tercero', $tercero->id);
                            $query->where('asignacion1_contrato', $contrato->id);
                            $query->where('asignacion1_tipo', 'R');
                            $query->join('asignacion1', 'asignacion2.asignacion2_asignacion1', '=', 'asignacion1.id');
                            $query->join('producto', 'asignacion2.asignacion2_producto', '=', 'producto.id');
                            $query->join('tipo', 'producto.producto_tipo', '=', 'tipo.id');
                            $retiro = $query->get();
                            dd($retiro);

                            $query = AsignacionDetalle::query();
                            $query->select('producto.id','producto_nombre','producto_serie as asignacion2_producto','tipo_nombre as nombre', 'tipo_codigo');
                            $query->where('asignacion2_deproducto', $producto->id);
                            $query->where('asignacion1_tercero', $tercero->id);
                            $query->where('asignacion1_contrato', $contrato->id);
                            $query->join('asignacion1', 'asignacion2.asignacion2_asignacion1', '=', 'asignacion1.id');
                            $query->join('producto', 'asignacion2.asignacion2_producto', '=', 'producto.id');
                            $query->join('tipo', 'producto.producto_tipo', '=', 'tipo.id');
                            $asignacion = $query->get();
                        }
                    }

                    return response()->json(['success' => true, 'id' => uniqid(), 'nombre'=>$tipo->tipo_nombre, 'accesorio'=>$asignacion]);
                }catch(\Exception $e){
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $asignacion2->errors]);
        }
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
