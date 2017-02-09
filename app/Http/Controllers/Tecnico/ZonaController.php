<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use DB, Log, Datatables,Cache;
use App\Models\Tecnico\Zona;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Zona::query();
            return Datatables::of($query)->make(true);
        }
        return view('tecnico.zona.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tecnico.zona.create');
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

            $zona = new Zona;
            if ($zona->isValid($data)) {
                DB::beginTransaction();
                try {
                    // daños
                    $zona->fill($data);
                    $zona->fillBoolean($data);
                    $zona->save();

                    // Commit Transaction
                    DB::commit();
                    //Forget Cache
                     Cache::forget( Zona::$key_cache );

                    return response()->json(['success' => true, 'id' => $zona->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $zona->errors]);
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
        $zona = Zona::findOrFail($id);
        if($request->ajax()){
            return response()->json($zona);
        }
        return view('tecnico.zona.show', ['zona' => $zona]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zona = Zona::findOrFail($id);
        return view('tecnico.zona.edit', ['zona' => $zona]);
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
            $zona = Zona::findOrFail($id);
            if ($zona->isValid($data)) {
                DB::beginTransaction();
                try {
                    // daños
                    $zona->fill($data);
                    $zona->fillBoolean($data);
                    $zona->save();
                    // Commit Transaction
                    DB::commit();
                    
                    return response()->json(['success' => true, 'id' => $zona->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $zona->errors]);
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
