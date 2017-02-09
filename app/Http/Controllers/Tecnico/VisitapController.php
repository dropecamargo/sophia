<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tecnico\Visitap;
use App\Models\Inventario\Producto,App\Models\Inventario\ProductoContador;

use DB, Log, Datatables;
class VisitapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = VisitaP::query();

            $query->where('visitap_orden',$request->orden_id);
            $query->select('visitap.*','producto.producto_serie as visitasp_codigo', 'producto.producto_nombre as visitap_nombre');
            $query->join('producto','visitap_producto', '=','producto.id');
            return response()->json($query->get());
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
       
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
            $visitap = new Visitap;
            if ($visitap->isValid($data)) {

                DB::beginTransaction();
                try {
                      // Validar producto
                    $producto = Producto::where('producto_serie', $request->visitasp_codigo)->first();
                    if(!$producto instanceof Producto) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar producto, por favor verifique la información o consulte al administrador.']);
                    }

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => uniqid()]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $visitap->errors]);
        }
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
    public function destroy(Request $request,$id)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {

                $visitap = Visitap::find($id);
                if(!$visitap instanceof Visitap){
                    return response()->json(['success' => false, 'errors' => 'No es posible recuperar repuesto, por favor verifique la información o consulte al administrador.']);
                }

                // Eliminar item visitap
                $VisitaP->delete();

                DB::commit();
                return response()->json(['success' => true]);

            }catch(\Exception $e){
                DB::rollback();
                Log::error(sprintf('%s -> %s: %s', 'VisitapController', 'destroy', $e->getMessage()));
                return response()->json(['success' => false, 'errors' => trans('app.exception')]);
            }
        }
        abort(403);    }
}
