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
                $query->select('asignacion2.*','tipo_nombre as nombre', 'producto.producto_nombre', 'p.producto_nombre as producto_nombre_search');
                $query->join('producto', 'asignacion2.asignacion2_producto', '=', 'producto.id');
                $query->join('tipo', 'producto.producto_tipo', '=', 'tipo.id');
                $query->Leftjoin('producto as p', 'asignacion2_deproducto', '=', 'p.id');
                $query->where('asignacion2_asignacion1', $request->asignacion2);
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
                    $accesorios = [];
                    if($request->tipo == 'E')
                    {  
                        // Recuperar producto
                        $producto = Producto::where('producto_serie', $request->asignacion2_producto)->whereNull('producto_tercero')->whereNull('producto_contrato')->first();
                        if(!$producto instanceof Producto) {
                            return response()->json(['success' => false, 'errors' => 'Este producto ya esta asignado, por favor verifique la información o consulte al administrador.']);
                        }

                        // Validar equipo de accesorio
                        if($request->has('producto_tipo_search') && $request->has('producto_nombre_search')){
                            if( !empty($request->producto_tercero) && !empty($request->producto_contrato) ){
                                $contrato = Contrato::find($request->producto_contrato);
                                $tercero = Tercero::find($request->producto_tercero);
                                
                                if(!$tercero instanceof Tercero) {
                                    return response()->json(['success' => false, 'errors' => 'No es posible recuperar cliente, por favor verifique la información o consulte al administrador.']);   
                                }

                                // Recuperar equipo de accesorio
                                $productoEq = Producto::where('producto_serie', $request->producto_tipo_search)->where('producto_tercero', $tercero->id)->where('producto_contrato', $contrato->id)->first();
                                if(!$productoEq instanceof Producto) {
                                    return response()->json(['success' => false, 'errors' => 'No es posible recuperar el producto, por favor verifique la información o consulte al administrador.']);
                                }

                                // Validar los hidden
                                if($productoEq->producto_tercero != $request->producto_tercero){
                                    return response()->json(['success' => false, 'errors' => 'No es posible cambiar el cliente, por favor verifique la información o consulte al administrador.']);   
                                }

                                // Validar los hidden
                                if($productoEq->producto_contrato != $request->producto_contrato){
                                    return response()->json(['success' => false, 'errors' => 'No es posible cambiar el contrato, por favor verifique la información o consulte al administrador.']);   
                                }
                            }

                        }

                        $tipo = Tipo::find($producto->producto_tipo);
                        if(!$tipo instanceof Tipo) {
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar tipo, por favor verifique la información o consulte al administrador.']);
                        }
                        //Valida tipo producto
                        if(!in_array($tipo->tipo_codigo, ['AC', 'EQ'])){
                            return response()->json(['success' => false, 'errors' => 'Ingrese un Equipo ó un Accesorio, por favor verifique la información o consulte al administrador.']);  
                        }
                    }

                    if($request->tipo == 'R')
                    {  
                        $contrato = Contrato::find($request->contrato_id);
                        $tercero = Tercero::where('tercero_nit', $request->tercero_id)->first();
                        if(!$tercero instanceof Tercero) {
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar cliente, por favor verifique la información o consulte al administrador.']);   
                        }
                        
                        // Recuperar producto
                        $producto = Producto::where('producto_serie', $request->asignacion2_producto)->where('producto_tercero',$tercero->id)->where('producto_contrato', $contrato->id)->first();
                        if(!$producto instanceof Producto) {
                            return response()->json(['success' => false, 'errors' => 'Este producto ya esta Retirado, por favor verifique la información o consulte al administrador.']);
                        }

                        // Recuperar Tipo
                        $tipo = Tipo::find($producto->producto_tipo);
                        if(!$tipo instanceof Tipo) {
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar tipo, por favor verifique la información o consulte al administrador.']);
                        }

                        //Valida tipo producto
                        if(!in_array($tipo->tipo_codigo, ['AC', 'EQ'])){
                            return response()->json(['success' => false, 'errors' => 'Ingrese un Equipo ó un Accesorio, por favor verifique la información o consulte al administrador.']);  
                        }
                        if($tipo->tipo_codigo == 'EQ'){
                            // Validar contrato tercero
                            if($contrato->contrato_tercero != $tercero->id) {
                                return response()->json(['success' => false, 'errors' => 'El contrato seleccionado no corresponde al tercero, por favor seleccione de nuevo el contrato o consulte al administrador.']);
                            }

                            // Recuperar Accesorio de la maquina
                            $query = Producto::select('producto_nombre','producto_serie as asignacion2_producto','tipo_nombre as nombre', 'tipo_codigo');
                            $query->join('tipo', 'producto.producto_tipo', '=', 'tipo.id');
                            $query->where('producto_tercero',$tercero->id);
                            $query->where('producto_contrato', $contrato->id);
                            $query->where('producto_maquina', $producto->id);
                            $accesorios = $query->get();
                        }
                    }
                    return response()->json(['success' => true, 'id' => uniqid(), 'nombre'=>$tipo->tipo_nombre, 'accesorio'=>$accesorios]);
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
