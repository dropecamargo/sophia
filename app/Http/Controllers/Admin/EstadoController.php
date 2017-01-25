<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables, Cache;

use App\Models\Base\Estado;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $query = Estado::query();
            return Datatables::of($query)->make(true);
        }
        return view('admin.estado.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estado.create');
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

            $estado = new Estado;
            if ($estado->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Centro costo
                    $estado->fill($data);
                    $estado->fillBoolean($data);
                    $estado->save();

                    // Commit Transaction
                    DB::commit();
                    //Forget cache
                    Cache::forget( Estado::$key_cache );

                    return response()->json(['success' => true, 'id' => $estado->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $estado->errors]);
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
        $estado = Estado::findOrFail($id);
        if ($request->ajax()) {
            return response()->json($estado);
        }
        return view('admin.estado.show', ['estado' => $estado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estado = Estado::findOrFail($id);
        return view('admin.estado.edit', ['estado' => $estado]);
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
            $estado = Estado::findOrFail($id);
            if ($estado->isValid($data)) {
                DB::beginTransaction();
                try {
                    // estado
                    $estado->fill($data);
                    $estado->fillBoolean($data);
                    $estado->save();
                    // Commit Transaction
                    DB::commit();
                    
                    return response()->json(['success' => true, 'id' => $estado->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $estado->errors]);
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
