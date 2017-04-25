<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Inventario\Sirvea;
use App\Models\Inventario\Producto;
use App\Models\Inventario\Tipo;
use App\Models\Inventario\Modelo;
use DB, Log, Datatables;

class SirveaController extends Controller
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
            $query = Sirvea::query();
            $query->where('sirvea_codigo', $request->producto_id);
            $query->select('sirvea.*','modelo.modelo_nombre','modelo.producto_referencia');
            $query->join('modelo', 'sirvea.sirvea_modelo', '=', 'modelo.id');
            $query->join('producto', 'sirvea.sirvea_codigo', '=', 'producto.id');
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
            $sirvea = new Sirvea;
            if ($sirvea->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Validar modelo
                    $modelo = Modelo::where('modelo_nombre', $request->sirvea_codigo)->where('producto_referencia', $request->sirvea_codigo_nombre)->first();
                    if(!$modelo instanceof Modelo) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar modelo, por favor verifique la información o consulte al administrador.']);
                    }

                    $producto_maquina = Producto::find($request->sirvea_modelo);
                    if(!$producto_maquina instanceof Producto){
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar maquina, por favor verifique la información o consulte al administrador.']);
                    }

                    // Validar unique
                    $sirveauq = Sirvea::where('sirvea_modelo', $modelo->id)->where('sirvea_codigo', $producto_maquina->id)->first();
                    if($sirveauq instanceof Sirvea) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => "El modelo {$modelo->modelo_nombre} ya se encuentra asociada a este producto."]);
                    }

                    $sirvea->sirvea_modelo = $modelo->id;
                    $sirvea->sirvea_codigo = $producto_maquina->id;
                    $sirvea->save();

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $sirvea->id, 'sirvea_modelo'=>$sirvea->sirvea_modelo, 'modelo_nombre'=>$modelo->modelo_nombre , 'producto_referencia'=>$modelo->producto_referencia]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $sirvea->errors]);
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

                $sirvea = Sirvea::find($id);
                if(!$sirvea instanceof Sirvea){
                    return response()->json(['success' => false, 'errors' => 'No es posible recuperar sirve a, por favor verifique la información del asiento o consulte al administrador.']);
                }

                // Eliminar item sirvea
                $sirvea->delete();

                DB::commit();
                return response()->json(['success' => true]);

            }catch(\Exception $e){
                DB::rollback();
                Log::error(sprintf('%s -> %s: %s', 'SirveaController', 'destroy', $e->getMessage()));
                return response()->json(['success' => false, 'errors' => trans('app.exception')]);
            }
        }
        abort(403);
    }
}
