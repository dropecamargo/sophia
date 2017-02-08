<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables, Auth;

use App\Models\Tecnico\Orden ,App\Models\Inventario\Producto, App\Models\Base\Tercero ;

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
         if ($request->ajax()) {
            $data = $request->all();

            $orden = new Orden;

            if ($orden->isValid($data)) {


                DB::beginTransaction();
                try {
                    $tercero = Tercero::where('tercero_nit', $request->orden_tercero)->first();
                    $producto = Producto::where('producto_serie', $request->sirvea_codigo)->first();
                    $tecnico = Tercero::where('tercero_nit', $request->orden_tecnico)->first();
                    if(!$producto instanceof Producto && !$tercero instanceof Tercero && !$tecnico instanceof Tercero) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar datos, por favor verifique la información o consulte al administrador.']);
                    }

                    // orden
                    $orden->fill($data);
                    $orden->orden_fh_servicio = "$request->orden_fecha_servicio $request->orden_hora_servicio";
                    $orden->orden_placa = $producto->id;
                    $orden->orden_tercero = $tercero->id;
                    $orden->orden_tecnico = $tecnico->id;
                    $orden->orden_usuario_elaboro = Auth::user()->id;
                    $orden->orden_fecha_elaboro = date('Y-m-d H:m:s');
                    $orden->save();

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $orden->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $orden->errors]);
        }
        abort(403);
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
        $orden = Orden::getOrden($id);
        if(!$orden instanceof Orden) {
            abort(404);
        }
        //dd($orden);
        return view('tecnico.orden.edit', ['orden' => $orden]);    
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
         if ($request->ajax()) {
            $data = $request->all();
            $orden = Orden::findOrFail($id);
            if ($orden->isValid($data)) {
                DB::beginTransaction();
                try {
                    $tercero = Tercero::where('tercero_nit', $request->orden_tercero)->first();
                    $producto = Producto::where('producto_serie', $request->sirvea_codigo)->first();
                    $tecnico = Tercero::where('tercero_nit', $request->orden_tecnico)->first();
                    if(!$producto instanceof Producto && !$tercero instanceof Tercero && !$tecnico instanceof Tercero) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar datos, por favor verifique la información o consulte al administrador.']);
                    }

                    // ordenes
                     $orden->orden_fh_servicio = "$request->orden_fecha_servicio $request->orden_hora_servicio";
                    $orden->orden_placa = $producto->id;
                    $orden->orden_tercero = $tercero->id;
                    $orden->orden_tecnico = $tecnico->id;
                    $orden->orden_usuario_elaboro = Auth::user()->id;
                    $orden->orden_fecha_elaboro =  date('Y-m-d H:m:s');
                    $orden->save();

                    // Commit Transaction
                    DB::commit();                    
                    return response()->json(['success' => true, 'id' => $orden->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $orden->errors]);
        }
        abort(403);
           
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
