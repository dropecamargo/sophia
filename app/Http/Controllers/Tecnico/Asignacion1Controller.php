<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Cache,Datatables, Auth;

use App\Models\Tecnico\Asignacion1;
use App\Models\Tecnico\Asignacion2;
use App\Models\Tecnico\Contrato;
use App\Models\Inventario\Producto;
use App\Models\Base\Tercero;
use App\Models\Base\Contacto;

class Asignacion1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Asignacion1::query();
            $query->select('asignacion1.*',DB::raw("CONCAT(t.tercero_nombre1, ' ', t.tercero_nombre2, ' ',t.tercero_apellido1, ' ',t.tercero_apellido2) as tecnico_nombre"),DB::raw("CONCAT(a.tercero_nombre1, ' ', a.tercero_nombre2, ' ',a.tercero_apellido1, ' ',a.tercero_apellido2) as tercero_nombre"));
            $query->join('tercero as t','asignacion1.asignacion1_tecnico', '=', 't.id');
            $query->join('tercero as a','asignacion1.asignacion1_tercero', '=', 'a.id');

            // Persistent data filter
            if($request->has('persistent') && $request->persistent) {
                session(['searchasignacion1_tecnico' => $request->has('tecnico_nit') ? $request->tecnico_nit : '']);
                session(['searchasignacion1_tecnico_nombre' => $request->has('tecnico_nombre') ? $request->tecnico_nombre : '']);
                session(['searchasignacion1_tipo' => $request->has('asignacion1_tipo') ? $request->asignacion1_tipo : '']);
                session(['searchasignacion1_tercero' => $request->has('tercero_nit') ? $request->tercero_nit : '']);
                session(['searchasignacion1_tercero_nombre' => $request->has('tercero_nombre') ? $request->tercero_nombre : '']);
            }

            return Datatables::of($query)->filter(function($query) use($request) {
                    
                    // Tercero nit
                    if($request->has('tercero_nit')) {
                        $query->where('a.tercero_nit', $request->tercero_nit);
                    }
                    // Tercero nit
                    if($request->has('tecnico_nit')) {
                        $query->where('t.tercero_nit', $request->tecnico_nit);
                    }


                    // Tipo
                    if($request->has('asignacion1_tipo')) {
                        if($request->asignacion1_tipo == 'E') {
                            $query->where('asignacion1_tipo', 'E');
                        }
                        if($request->asignacion1_tipo == 'R') {
                            $query->where('asignacion1_tipo', 'R');
                        }
                    }
                })
                ->make(true);
        }
        return view('tecnico.asignacion1.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tecnico.asignacion1.create');
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

            $asignacion1 = new Asignacion1;
            if ($asignacion1->isValid($data)) {
                DB::beginTransaction();
                try {
                    $tercero = Tercero::where('tercero_nit', $request->asignacion1_tercero)->first();
                    $contacto = Contacto::find($request->asignacion1_contacto);
                    $tecnico = Tercero::where('tercero_nit', $request->asignacion1_tecnico)->first();
                    $contrato = Contrato::find($request->asignacion1_contrato);
                    
                    if(!$contacto instanceof Contacto && !$tercero instanceof Tercero && !$tecnico instanceof Tercero) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar datos, por favor verifique la información o consulte al administrador.']);
                    }

                    // asignacion1
                    $asignacion1->fill($data);
                    if($data['nombre_contrato']){
                        $asignacion1->asignacion1_contrato = $contrato->id;
                    }
                    $asignacion1->asignacion1_tercero = $tercero->id;
                    $asignacion1->asignacion1_contacto = $contacto->id;
                    $asignacion1->asignacion1_tecnico = $tecnico->id;
                    $asignacion1->asignacion1_usuario_elaboro = Auth::user()->id;
                    $asignacion1->asignacion1_fh_elaboro = date('Y-m-d H:m:s');
                    $asignacion1->save();

                    // Asignacion2
                    $asignacion2 = isset($data['asignacion2']) ? $data['asignacion2'] : null;
                    foreach ($asignacion2 as $item)
                    {
                        // Recuperar producto
                        $producto = Producto::where('producto_serie', $item['asignacion2_producto'])->first();
                        $deproducto = Producto::where('producto_serie', $item['producto_tipo_search'])->first();
                        
                        if(!$producto instanceof Producto) {
                            DB::rollback();
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar producto, por favor verifique la información o consulte al administrador.']);
                        }

                            $asignacion2 = new Asignacion2;
                            $asignacion2->asignacion2_asignacion1 = $asignacion1->id;
                            $asignacion2->asignacion2_producto = $producto->id;
                            if($item['producto_tipo_search']){
                                $asignacion2->asignacion2_deproducto = $deproducto->id;
                            }
                            $asignacion2->save();
                    }


                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $asignacion1->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $asignacion1->errors]);
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
        $asignacion = Asignacion1::getAsignacion($id);
        if(!$asignacion instanceof Asignacion1){
            abort(404);
        }

        if ($request->ajax()) {
            return response()->json($asignacion);
        }

        return view('tecnico.asignacion1.show', ['asignacion1' => $asignacion]);
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
        if ($request->ajax()) {
            $data = $request->all();
            $asignacion1 = Asignacion1::findOrFail($id);
                DB::beginTransaction();
                try {
                    $tercero = Tercero::where('tercero_nit', $request->asignacion1_tercero)->first();
                    $contacto = Contacto::find($request->asignacion1_contacto);
                    $tecnico = Tercero::where('tercero_nit', $request->asignacion1_tecnico)->first();
                    
                    if(!$contacto instanceof Contacto && !$tercero instanceof Tercero && !$tecnico instanceof Tercero) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar datos, por favor verifique la información o consulte al administrador.']);
                    }

                    // asignacion1
                    $asignacion1->fill($data);
                    $asignacion1->asignacion1_tercero = $tercero->id;
                    $asignacion1->asignacion1_contacto = $contacto->id;
                    $asignacion1->asignacion1_tecnico = $tecnico->id;
                    $asignacion1->save();
                    // Commit Transaction
                    DB::commit();

                    return response()->json(['success' => true, 'id' => $asignacion1->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $asignacion1->errors]);
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
