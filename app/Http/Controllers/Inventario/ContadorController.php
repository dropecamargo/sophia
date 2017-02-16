<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables, Cache;

use App\Models\Inventario\Contador;

class ContadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Contador::query();
            return Datatables::of($query)->make(true);
        }
        return view('inventario.contador.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.contador.create');
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

            $contador = new Contador;
            if ($contador->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Contador
                    $contador->fill($data);
                    $contador->fillBoolean($data);
                    $contador->save();

                    // Cache
                    Cache::forget( Contador::$key_cache );
                    // Commit
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $contador->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $contador->errors]);
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
        $contador = Contador::findOrFail($id);
        if ($request->ajax()){
            return response()->json($contador);
        }
        return view('inventario.contador.show', ['contador' => $contador]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contador = Contador::findOrFail($id);
        return view('inventario.contador.edit', ['contador' => $contador]);
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
        if ($request->ajax()){
            $data = $request->all();
            $contador = Contador::findOrFail($id);
            if ($contador->isValid($data)){
                DB::beginTransaction();
                try {
                    // contador
                    $contador->fill($data);
                    $contador->fillBoolean($data);
                    $contador->save();
                    // Commit Transaction
                    DB::commit();
                    // Cache
                    Cache::forget( Contador::$key_cache );
                    return response()->json(['success' => true, 'id' => $contador->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $contador->errors]);
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
