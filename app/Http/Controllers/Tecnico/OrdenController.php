<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables;

use App\Models\Tecnico\Orden;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->ajax()){
            $query = Orden::query();

            $query->select('orden.*',
                DB::raw("
                    CONCAT(
                        (CASE WHEN tercero_persona = 'N'
                            THEN CONCAT(tercero_nombre1,' ',tercero_nombre2,' ',tercero_apellido1,' ',tercero_apellido2,
                                (CASE WHEN (tercero_razonsocial IS NOT NULL AND tercero_razonsocial != '') THEN CONCAT(' - ', tercero_razonsocial) ELSE '' END)
                            )
                            ELSE tercero_razonsocial
                        END)
                    
                    ) AS tercero_nombre"
                )
            );
            $query->join('tercero', 'orden_tercero', '=', 'tercero.id');


               // Persistent data filter
            if($request->has('persistent') && $request->persistent) {
                session(['searchorden_orden_id' => $request->has('id') ? $request->id : '']);
                session(['searchorden_tercero' => $request->has('tercero_nit') ? $request->tercero_nit : '']);
                session(['searchorden_tercero_nombre' => $request->has('tercero_nombre') ? $request->tercero_nombre : '']);
                session(['searchorden_orden_estado' => $request->has('orden_abierta') ? $request->orden_abierta : '']);
            }


            return Datatables::of($query)

                ->filter(function($query) use($request) {

                    //id Orden
                    if($request->has('id')){
                        $query->where('orden.id',$request->id);
                    }
                    // Tercero nit
                    if($request->has('tercero_nit')) {
                        $query->where('tercero_nit', $request->tercero_nit);
                    }

                    // Estado
                    if($request->has('orden_abierta')) {
                        if($request->orden_abierta == 'A') {
                            $query->where('orden_abierta', true);
                        }
                        if($request->orden_abierta == 'C') {
                            $query->where('orden_abierta', false);
                        }
                        /*if($request->orden_abierta == 'N') {
                            $query->where('orden_anulada', true);
                        }*/
                    }
                })
                ->make(true);
        }
        return view ('tecnico.orden.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tecnico.orden.create');
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
    public function show(Request $request, $id)
    {
          $orden = Orden::getOrden($id);
          //dd($orden);
        if($request->ajax()){
            return response()->json($orden);
        }
        return view('tecnico.orden.show',['orden' => $orden]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$orden = Orden::getOrden($id);
        if(!$orden instanceof Orden) {
            abort(404);
        }*/
        return view('tecnico.orden.edit', ['orden' => 1]);    
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
