<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB, Log, Datatables, Cache;
use App\Models\Inventario\Producto, App\Models\Inventario\Contador, App\Models\Inventario\ProductoContador, App\Models\Inventario\Tipo;
use App\Models\Inventario\Marca;
use App\Models\Base\Tercero , App\Models\Base\Estado;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           // dd($request->all());
            $query = Producto::query();
            $query->select('producto.id','producto_placa','producto_serie' ,'producto_nombre','tipo_codigo', 'tipo_nombre');
            $query->join('tipo', 'producto.producto_tipo', '=', 'tipo.id');

            // Persistent data filter
            if($request->has('persistent') && $request->persistent) {
                session(['search_producto_serie' => $request->has('producto_serie') ? $request->producto_serie : '']);
                session(['search_producto_nombre' => $request->has('producto_nombre') ? $request->producto_nombre : '']);
                session(['searchproducto_tipo' => $request->has('producto_tipo') ? $request->producto_tipo : '']);
            }

            return Datatables::of($query)
                ->filter(function($query) use($request) {
                    // serie
                    if($request->has('producto_serie')) {
                        $query->whereRaw("producto_serie LIKE '%{$request->producto_serie}%'");
                    }

                    // Nombre
                    if($request->has('producto_nombre')) {
                        $query->whereRaw("producto_nombre LIKE '%{$request->producto_nombre}%'");
                    }
                    // Tipo
                    if($request->has('producto_tipo')) {
                        $tipo = Tipo::where('tipo_codigo' , $request->producto_tipo)->first();
                        if($tipo instanceof Tipo){
                            $query->where('producto_tipo',$tipo->id); 
                        }
                    }

                    // Filter default search
                    if($request->has('tipo_codigo')) {
                        $query->whereIn('tipo_codigo', explode(',', $request->tipo_codigo));
                    }
                    
                    //Filter of Asignaciones
                    if($request->has('productos_asignados')){
                       if ($request->productos_asignados == "true") {
                            $tercero = Tercero::where('tercero_nit' , $request->producto_tercero)->first();
                            $query->where('producto_contrato', $request->producto_contrato)->where('producto_tercero', $tercero->id);
                       }else{
                            $query->whereNull('producto_tercero')->whereNull('producto_contrato');

                       }
                    }   
                  
                })
                ->make(true);
        }
        return view('inventario.producto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.producto.create');
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
            $producto = new Producto;
            if ($producto->isValid($data)) {
                DB::beginTransaction();
                try {
                    // Proveedor
                    if($request->has('producto_proveedor')){
                        $tercero = Tercero::where('tercero_nit', $request->producto_proveedor)->first();
                        if(!$tercero instanceof Tercero) {
                            DB::rollback();
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar cliente, por favor verifique la información o consulte al administrador.']);
                        }
                        $producto->producto_proveedor = $tercero->id;
                    }
                    
                    $producto->fill($data);

                    // Validar producto
                    $result = $producto->validarProducto();
                    if($result != 'OK') {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => $result]);
                    }
                    $producto->save();

                    if(in_array($producto->tipo->tipo_codigo, ['EQ'])) {
                        $contador = Contador::find(Contador::$ctr_machines);
                        if(!$contador instanceof Contador) {
                            DB::rollback();
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar contador GENERAL para el eqipo, por favor verifique la información o consulte al administrador.']);
                        }

                        $pcontador = new ProductoContador;
                        $pcontador->productocontador_producto = $producto->id;
                        $pcontador->productocontador_contador = $contador->id;
                        $pcontador->save();
                    }

                    // Commit Transaction
                    DB::commit();

                    //forget cache
                    Cache::forget( Producto::$key_cache );
                    return response()->json(['success' => true, 'id' => $producto->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
            }
            return response()->json(['success' => false, 'errors' => $producto->errors]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $producto = Producto::getProducto($id);
        if($producto instanceof Producto){
            if ($request->ajax()) {
                return response()->json($producto);
            }
            return view('inventario.producto.show', ['producto' => $producto]);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('inventario.producto.edit', ['producto' => $producto]);
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
            $producto = Producto::findOrFail($id);
            if ($producto->isValid($data)) {
                DB::beginTransaction();
                try {
                   if($request->has('producto_proveedor')){
                        $tercero = Tercero::where('tercero_nit', $request->producto_proveedor)->first();
                        if(!$tercero instanceof Tercero) {
                            DB::rollback();
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar cliente, por favor verifique la información o consulte al administrador.']);
                        }
                        $producto->producto_proveedor = $tercero->id;
                    }

                    $producto->fill($data);

                    // Validar producto
                    $result = $producto->validarProducto();
                    if($result != 'OK') {
                        DB::rollback();
                        return response()->json(['success' => false, 'errors' => $result]);
                    }
                    $producto->save();

                    //Valida unico contadores
                    if(in_array($producto->tipo->tipo_codigo, ['EQ'])) {

                        $contador = Contador::find(Contador::$ctr_machines);
                        if(!$contador instanceof Contador) {
                            DB::rollback();
                            return response()->json(['success' => false, 'errors' => 'No es posible recuperar contador GENERAL para el eqipo, por favor verifique la información o consulte al administrador.']);
                        }

                        
                        // Validar unique
                        $pcontador = ProductoContador::where('productocontador_contador', $contador->id)->where('productocontador_producto', $producto->id)->first();
                        if(!$pcontador instanceof ProductoContador) {
                            
                            $pcontador = new ProductoContador;
                            $pcontador->productocontador_producto = $producto->id;
                            $pcontador->productocontador_contador = $contador->id;
                            $pcontador->save();
                        }
                        
                    }

                    // Commit Transaction
                    DB::commit();
                    return response()->json(['success' => true, 'id' => $producto->id]);
                }catch(\Exception $e){
                    DB::rollback();
                    Log::error($e->getMessage());
                    return response()->json(['success' => false, 'errors' => trans('app.exception')]);
                }
          }
        }
        return response()->json(['success' => false, 'errors' => $producto->errors]);

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

    /**
     * Search producto.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request->has('producto_serie')) {
            $producto = Producto::select('producto.id', 'producto_nombre', 'tipo_codigo')
                ->join('tipo', 'producto_tipo', '=', 'tipo.id')
                ->where('producto_serie', $request->producto_serie)->first();

            if($producto instanceof Producto) {
                return response()->json(['success' => true, 'id' => $producto->id, 'producto_nombre' => $producto->producto_nombre, 'tipo_codigo' => $producto->tipo_codigo]);
            }
        }
        return response()->json(['success' => false]);
    }
}
