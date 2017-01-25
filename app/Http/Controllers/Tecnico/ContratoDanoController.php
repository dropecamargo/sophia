<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables;

use App\Models\Tecnico\Contrato, App\Models\Tecnico\ContratoDano,App\Models\Tecnico\Dano;

class ContratoDanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = ContratoDano::query();
            $query->where('contratodano_contrato', $request->contrato_id);
            $query->select('contratodano.*', 'dano.*');
            $query->join('dano', 'contratodano_dano', '=', 'dano.id');
            $query->orderBy('contratodano.id', 'asc');
            return response()->json( $query->get() );
          
            $query->orderBy('id', 'asc');
            return response()->json( $query->get() );
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
         if ($request->ajax()) {
            $data = $request->all();
            $contratodano = new ContratoDano;
            if ($contratodano->isValid($data)) {

                DB::beginTransaction();
                try {
                      // Validar producto
                    $contrato = Contrato::find($request->contratodano_contrato);
                    if(!$contrato instanceof Contrato) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar contrato, por favor verifique la información o consulte al administrador.']);
                    }

                    // Validar daño
                    $dano = Dano::find($request->contratodano_dano);
                    if(!$dano instanceof Dano) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar maquina, por favor verifique la información o consulte al administrador.']);
                    }

                    // Validar unique
                    $contratodanouq = ContratoDano::where('contratodano_contrato', $contrato->id)->where('contratodano_dano', $dano->id)->first();
                    if($contratodanouq instanceof ContratoDano) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => "El daño {$dano->dano_nombre} ya se encuentra asociado a este contrato."]);
                    }

                    // ContratoDano
                    $contratodano->fill($data); 
                    $contratodano->save();

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $contratodano->id, 'dano_id' => $dano->id, 'dano_nombre' => $dano->dano_nombre]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $contratodano->errors]);
        }
        abort(403);       
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
        dd('destroy');    
    }
}
