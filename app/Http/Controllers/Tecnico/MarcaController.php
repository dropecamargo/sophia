<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables;

use App\Models\Tecnico\Marca;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Marca::query();
            return Datatables::of($query)->make(true);
        }
        return view('tecnico.marca.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tecnico.marca.create');
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
            
            $marca = new Marca;
            if ($marca->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Centro costo
                    $marca->fill($data);
                    $marca->fillBoolean($data);
                    $marca->save();

                    // Commit Transaction
                    DB::commit();

                    return response()->json(['success' => true, 'id' => $marca->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $marca->errors]);
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
        $marca = Marca::findOrFail($id);
        if ($request->ajax()) {
            return response()->json($marca);    
        }        
        return view('tecnico.marca.show', ['marca' => $marca]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('tecnico.marca.edit', ['marca' => $marca]);
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
            $marca = Marca::findOrFail($id);
            if ($marca->isValid($data)) {
                DB::beginTransaction();
                try {
                    // marca
                    $marca->fill($data);
                    $marca->fillBoolean($data);
                    $marca->save();
                    // Commit Transaction
                    DB::commit();
                    
                    return response()->json(['success' => true, 'id' => $marca->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $marca->errors]);
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
