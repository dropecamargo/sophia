<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables, Cache;

use App\Models\Inventario\Modelo;

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
                    // Modelo
                    $modelo->fill($data);
                    $modelo->fillBoolean($data);
                    $modelo->save();

                    // Commit Transaction
                    DB::commit();
                    //Forget cache
                    Cache::forget( Modelo::$key_cache );

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
        $query = Modelo::where('modelo.id' ,$id);
        $query->Leftjoin('marca','modelo.producto_marca','=','marca.id');
        $query->select('modelo.*','marca_modelo');
        $modelo = $query->first();

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
                    // Modelo
                    $modelo->fill($data);
                    $modelo->fillBoolean($data);
                    $modelo->save();

                    // Commit Transaction
                    DB::commit();
                    // Forget cache
                    //Cache::forget( Modelo::$key_cache );

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
