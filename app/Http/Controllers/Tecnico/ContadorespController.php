<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Tecnico\Contadoresp,App\Models\Inventario\ProductoContador;
use DB, Log, Datatables,Cache;

class ContadorespController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $query = ProductoContador::query();
            $query->select('productocontador.*','producto.producto_nombre','contador.contador_nombre', 'contadoresp.contadoresp_valor');
            $query->where('productocontador_producto', $request->producto_id);
            $query->join('contador', 'productocontador.productocontador_contador', '=', 'contador.id');
            $query->join('producto', 'productocontador.productocontador_producto', '=', 'producto.id');
            $query->Leftjoin('contadoresp', 'productocontador.productocontador_producto', '=', 'contadoresp.contadoresp_producto_contador');

            return  $query->get();
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

            $contadoresp = new Contadoresp;
            if ($contadoresp->isValid($data)) {

                DB::beginTransaction();
                try {
                        // Validar producto
                        $productocontador = ProductoContador::getProductoContador($request->producto_id)->first();
                        if(!$productocontador instanceof ProductoContador) {
                            DB::rollback();
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar Contadores, por favor verifique la información o consulte al administrador.']);
                        } 

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => uniqid(), 'contadoresp_valor'=> $request->contadoresp_valor, 'contador_nombre'=> $request->contadoresp_nombre]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $contadoresp->errors]);
        }
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
        dd("ey");
    }
}
