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

            if($request->contadoresp){
                $query = Contadoresp::query();
                $query->select('contadoresp.id','contador.contador_nombre','contadoresp_valor');
                $query->join('productocontador', 'contadoresp.contadoresp_producto_contador', '=', 'productocontador.id');
                $query->join('contador', 'productocontador.productocontador_contador', '=', 'contador.id');
                $query->where('contadoresp_documento_numero', $request->contadoresp);
                $query->orderBy('contadoresp.id', 'asc');
                return  $query->get();
            }

            $query = ProductoContador::getProductoContador($request->producto_id);
            return  $query;
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
        // 
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
