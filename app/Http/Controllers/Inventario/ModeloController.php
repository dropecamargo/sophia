<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Inventario\Modelo, App\Models\Inventario\Marca;
use DB, Log, Datatables, Cache;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Modelo::query();

            return Datatables::of($query)
                ->filter(function($query) use($request) {
                    // Filter
                    if($request->has('filter')){
                        $query->whereNotNull('producto_referencia')->whereNotNull('producto_nombre')->whereNotNull('producto_marca');
                    }

                    // Filter create producto
                    if($request->has('marca')){
                        $query->where('producto_marca', $request->marca);
                        $query->where('modelo_activo', true);
                        $query->lists('modelo_nombre', 'modelo.id');
                    }

                    // modelo
                    if($request->has('modelo')){
                        $query->where('modelo_nombre', $request->modelo);
                    }
                    // referencia
                    if($request->has('referencia')){
                        $query->where('producto_referencia', $request->referencia);
                    }
                })
                ->make(true);
        }

        return view('inventario.modelo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.modelo.create');
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
            $modelo = new Modelo;
            if ($modelo->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Recuperar Marca
                    $marca = Marca::find($request->producto_marca);
                    if( !$marca instanceof Marca ){
                        DB::rollback();
                        return response()->json(['success'=>false, 'errors'=>'No es posible recuperar la marca, por favor verifique la informacion ó consulte al administrador.']);
                    }

                    // Modelo
                    $modelo->fill($data);
                    $modelo->fillBoolean($data);
                    $modelo->producto_marca = $marca->id;
                    $modelo->save();

                    //Forget cache
                    Cache::forget( Modelo::$key_cache );
                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $modelo->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $modelo->errors]);
        }
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $modelo = Modelo::getModel($id);
        if ($request->ajax()) {
            return response()->json($modelo);    
        }        
        return view('inventario.modelo.show', ['modelo' => $modelo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelo = Modelo::findOrFail($id);
        return view('inventario.modelo.edit', ['modelo' => $modelo]);
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

            $modelo = Modelo::findOrFail($id);
            if ($modelo->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Recuperar Marca
                    $marca = Marca::find($request->producto_marca);
                    if( !$marca instanceof Marca ){
                        DB::rollback();
                        return response()->json(['success'=>false, 'errors'=>'No es posible recuperar la marca, por favor verifique la informacion ó consulte al administrador.']);
                    }

                    // Modelo
                    $modelo->fill($data);
                    $modelo->fillBoolean($data);
                    $modelo->producto_marca = $marca->id;
                    $modelo->save();

                    // Forget cache
                    Cache::forget( Modelo::$key_cache );
                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $modelo->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $modelo->errors]);
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

    /**
     * Search modelo.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request->has('modelo')) {
            $modelo = Modelo::select('modelo.id', 'modelo_nombre', 'producto_referencia')
                ->where('modelo_nombre', $request->modelo)->whereNotNull('producto_referencia')->whereNotNull('producto_nombre')->whereNotNull('producto_marca')->first();

            if($modelo instanceof Modelo) {
                return response()->json(['success' => true, 'id' => $modelo->id, 'modelo_nombre' => $modelo->modelo_nombre, 'producto_referencia' => $modelo->producto_referencia]);
            }
        }
        return response()->json(['success' => false]);
    }
}
