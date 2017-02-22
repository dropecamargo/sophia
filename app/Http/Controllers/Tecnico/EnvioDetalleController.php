<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Log, DB;

use App\Models\Inventario\Tipo;
use App\Models\Inventario\Producto;
use App\Models\Tecnico\EnvioDetalle;

class EnvioDetalleController extends Controller
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
                $query = EnvioDetalle::query();
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
            $asignacion2 = new EnvioDetalle;
            if ($asignacion2->isValid($data)) {
                try {
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

                    return response()->json(['success' => true, 'id' => uniqid(), 'nombre'=>$tipo->tipo_nombre]);
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
