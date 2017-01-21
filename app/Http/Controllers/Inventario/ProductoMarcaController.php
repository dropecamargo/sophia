<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB, Log;

use App\Models\Inventario\Producto;
use App\Models\Inventario\ProductoMarca;

class ProductoMarcaController extends Controller
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
            $query = ProductoMarca::query();
            $query->where('productomarca_producto', $request->producto_id);
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

            $productomarca = new ProductoMarca;
            if ($productomarca->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Validar producto
                    $producto = Producto::find($request->productomarca_producto);
                    if(!$producto instanceof Producto) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => 'No es posible recuperar producto, por favor verifique la información o consulte al administrador.']);
                    }


                    // Validar unique
                    $producto4uq = ProductoMarca::where('productomarca_producto', $producto->id)->where('productomarca_marca', $marca->id)->first();
                    if($producto4uq instanceof ProductoMarca) {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => "La marca {$marca->marca_modelo} ya se encuentra asociada a este producto."]);
                    }   

                    // Area
                    $productomarca->fill($data);
                    $productomarca->productomarca_producto = $producto->id;
                    $productop4->productomarca_marca = $marca->id;
                    $productomarca->save();

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $productomarca->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $productomarca->errors]);
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

                $productomarca = ProductoMarca::find($id);
                if(!$productomarca instanceof ProductoMarca){
                    return response()->json(['success' => false, 'errors' => 'No es posible recuperar marca, por favor verifique la información o consulte al administrador.']);
                }

                // Eliminar item productomarca
                $productomarca->delete();

                DB::commit();
                return response()->json(['success' => true]);

            }catch(\Exception $e){
                DB::rollback();
                Log::error(sprintf('%s -> %s: %s', 'ProductoMarcaController', 'destroy', $e->getMessage()));
                return response()->json(['success' => false, 'errors' => trans('app.exception')]);
            }
        }
        abort(403);
    }
}
