<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Inventario\Sirvea;
use App\Models\Inventario\Producto;
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
            $query->where('sirvea_maquina', $request->producto_id);
            $query->select('sirvea.*','p.producto_nombre as nombre','po.producto_serie as serie');
            $query->join('producto as p', 'sirvea.sirvea_codigo', '=', 'p.id');
            $query->join('producto as po', 'sirvea.sirvea_codigo', '=', 'po.id');
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
                    // Validar producto
                    $producto = Producto::where('producto_serie', $request->sirvea_codigo)->first();
                    if(!$producto instanceof Producto) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar serie, por favor verifique la información o consulte al administrador.']);
                    }

                    // Validar producto
                    $pp = Producto::where('id', $request->sirvea_maquina)->first();
                    if(!$pp instanceof Producto) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar maquina, por favor verifique la información o consulte al administrador.']);
                    }

                    // Validar unique
                    $sirveauq = Sirvea::where('sirvea_maquina', $request->sirvea_maquina)->where('sirvea_codigo', $producto->id)->first();
                    if($sirveauq instanceof Sirvea) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => "La maquina {$producto->producto_nombre} ya se encuentra asociada a este producto."]);
                    }

                    $sirvea->sirvea_maquina = $pp->id;
                    $sirvea->sirvea_codigo = $producto->id;
                    $sirvea->save();

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $sirvea->id, 'sirvea_maquina'=>$sirvea->sirvea_maquina, 'serie'=>$producto->producto_serie , 'nombre'=>$producto->producto_nombre]);
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
