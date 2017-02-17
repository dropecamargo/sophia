<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Inventario\ProductoContador;
use App\Models\Inventario\Producto;
use App\Models\Inventario\Contador;
use DB, Log, Datatables,Cache;

class ProductoContadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
         $productoContador = ProductoContador::getProductoContador($request->producto_id);
         return response()->json($productoContador);
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
            $pcontador = new ProductoContador;
            if ($pcontador->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Validar producto
                    $contador = Contador::where('id', $request->productocontador_contador)->first();
                    if(!$contador instanceof Contador) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar contador, por favor verifique la información o consulte al administrador.']);
                    }

                    // Validar producto
                    $pp = Producto::where('id', $request->productocontador_producto)->first();
                    if(!$pp instanceof Producto) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar producto, por favor verifique la información o consulte al administrador.']);
                    }

                    // Validar unique
                    $pcontadoruq = ProductoContador::where('productocontador_contador', $request->productocontador_contador)->where('productocontador_producto', $pp->id)->first();
                    if($pcontadoruq instanceof ProductoContador) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => "La maquina {$contador->contador_nombre} ya se encuentra asociada a este producto."]);
                    }

                    $pcontador->productocontador_producto = $pp->id;
                    $pcontador->productocontador_contador = $contador->id;
                    $pcontador->save();

                    // Commit Transaction
                    DB::commit();
                   
                    return response()->json(['success' => true, 'id' => $pcontador->id, 'productocontador_producto'=>$pcontador->productocontador_producto, 'contador_nombre'=>$contador->contador_nombre , 'producto_nombre'=>$pp->producto_nombre]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $pcontador->errors]);
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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {

                $pcontador = ProductoContador::find($id);
                $contador = Contador::$ctr_machines;
                
                if(!$pcontador instanceof ProductoContador){
                    DB::rollback();
                    return response()->json(['success' => false, 'errors' => 'No es posible recuperar producto contador, por favor verifique la información del asiento o consulte al administrador.']);
                }
                if ($pcontador->productocontador_contador == $contador) {
                    DB::rollback();
                    return response()->json(['success' => false, 'errors' => 'El CONTADOR GENERAL no puede ser eliminado ']);
                }

                // Eliminar item pcontador
                $pcontador->delete(); 
           
                DB::commit();
                return response()->json(['success' => true]);

            }catch(\Exception $e){
                DB::rollback();
                Log::error(sprintf('%s -> %s: %s', 'ProductoContadorController', 'destroy', $e->getMessage()));
                return response()->json(['success' => false, 'errors' => trans('app.exception')]);
            }
        }
        abortx(403);
    }
}
