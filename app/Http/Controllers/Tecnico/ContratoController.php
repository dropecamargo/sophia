<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables;

use App\Models\Tecnico\Contrato ,App\Models\Base\Tercero ;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->ajax()){
            $query = Contrato::query();
            $query->select('contrato.id', 'contrato_numero', 'contrato_fecha', 'contrato_vencimiento', 'contrato_activo', 'contrato_condiciones',
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
            $query->join('tercero', 'contrato_tercero', '=', 'tercero.id');

                // Persistent data filter
            if($request->has('persistent') && $request->persistent) {
                session(['searchcontrato_contrato_numero' => $request->has('contrato_numero') ? $request->contrato_numero : '']);
                session(['searchcontrato_tercero' => $request->has('tercero_nit') ? $request->tercero_nit : '']);
                session(['searchcontrato_tercero_nombre' => $request->has('tercero_nombre') ? $request->tercero_nombre : '']);
            }

           return Datatables::of($query)

                ->filter(function($query) use($request) {

                    //id Contrato
                    if($request->has('contrato_numero')){
                        $query->where('contrato.contrato_numero',$request->contrato_numero);
                    }
                    // Tercero nit
                    if($request->has('tercero_nit')) {
                        $query->where('tercero_nit', $request->tercero_nit);
                    }

                })
            ->make(true);
        }
        return view('tecnico.contrato.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tecnico.contrato.create');
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

            $contrato = new Contrato;

            if ($contrato->isValid($data)) {
                DB::beginTransaction();
                try {
                    $tercero = Tercero::where('tercero_nit', $request->contrato_tercero)->first();
                    if(!$tercero instanceof Tercero) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar cliente, por favor verifique la información o consulte al administrador.']);
                    }

                    // Contrato
                    $contrato->fill($data);
                    $contrato->fillBoolean($data);
                    $contrato->contrato_tercero = $tercero->id;
                    $contrato->save();

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $contrato->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $contrato->errors]);
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
        $contrato = Contrato::getContrato($id);
        
        if(!$contrato instanceof Contrato) {
            abort(404);
        }

        if($request->ajax()) {
            return response()->json($contrato);
        }
        return view('tecnico.contrato.show', ['contrato' => $contrato]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrato = Contrato::getContrato($id);
        if(!$contrato instanceof Contrato) {
            abort(404);
        }
        return view('tecnico.contrato.edit', ['contrato' => $contrato]);
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
            $contrato = Contrato::findOrFail($id);
            if ($contrato->isValid($data)) {
                DB::beginTransaction();
                try {
                    $tercero = Tercero::where('tercero_nit', $request->contrato_tercero)->first();
                    if(!$tercero instanceof Tercero) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar cliente, por favor verifique la información o consulte al administrador.']);
                    }

                    // contratos
                    $contrato->fill($data);
                    $contrato->fillBoolean($data);
                    $contrato->contrato_tercero = $tercero->id;
                    $contrato->save();

                    // Commit Transaction
                    DB::commit();                    
                    return response()->json(['success' => true, 'id' => $contrato->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $contrato->errors]);
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
