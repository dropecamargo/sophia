<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Cache,Auth;
use App\Models\Tecnico\Visita;

class VisitaController extends Controller
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
            $query = Visita::query();
            $query->where('visita_orden', $request->orden_id);
           // dd($query->get());
            $query->select('visita.*', 'orden.id');
            $query->join('orden', 'visita_orden', '=', 'orden.id');
            $query->orderBy('orden.id', 'asc'); 
                   
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
            //dd($data);
            $visita = new Visita;

            if ($visita->isValid($data)) {

                DB::beginTransaction();
                try {

                    // visita
                    $visita->fill($data);
                    $visita->visita_fh_llegada = "$request->visita_fecha_llegada $request->visita_hora_llegada";
                    $visita->visita_fh_inicio = "$request->visita_fecha_inicio $request->visita_hora_inicio";
                    $visita->visita_fh_finaliza = "$request->visita_fecha_fin $request->visita_hora_fin";
                    
                    $visita->visita_usuario_elaboro = Auth::user()->id;
                    $visita->visita_fh_elaboro = date('Y-m-d H:m:s');
                    $visita->save();

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $visita->id, 'visita_fh_llegada'=>$visita->visita_fh_llegada,'visita_fh_inicio'=>$visita->visita_fh_inicio]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $visita->errors]);
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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {

                $visita = Visita::find($id);
                //dd($visita);
                if(!$visita instanceof Visita){
                    return response()->json(['success' => false, 'errors' => 'No es posible recuperar visita, por favor verifique la información o consulte al administrador.']);
                }

                // Eliminar item visita
                $visita->delete();

                DB::commit();
                return response()->json(['success' => true]);

            }catch(\Exception $e){
                DB::rollback();
                Log::error(sprintf('%s -> %s: %s', 'VisitaController', 'destroy', $e->getMessage()));
                return response()->json(['success' => false, 'errors' => trans('app.exception')]);
            }
        }
        abort(403);   
    }
}
