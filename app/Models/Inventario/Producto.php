<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

use Validator,DB,Cache;

class Producto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'producto';

    public $timestamps = false;


      /**
     * The key used by cache store.
     *
     * @var static string
     */
    public static $key_cache = '_pruduct';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['producto_placa','producto_serie','producto_referencia','producto_codigo','producto_nombre','producto_parte','producto_vida_util','producto_marca','producto_modelo','producto_estado','producto_tipo','producto_proveedor'];

    public function isValid($data)
    {
        $rules = [
            'producto_placa' => 'unique:producto',
            'producto_serie' => 'unique:producto',
            'producto_referencia' => 'required|max:20',
            'producto_codigo' => 'required|max:20',
            'producto_nombre' => 'required|max:100',
            'producto_parte' => 'required|max:20',
            'producto_estado' => 'required',
            'producto_marca' => 'required',
            'producto_tipo' => 'required',
            'producto_modelo' => 'required',
            'producto_vida_util' => 'required|numeric'
        ];

        if($this->exists){
            $rules['producto_placa'] .= ',producto_placa,' . $this->id;
            $rules['producto_serie'] .= ',producto_serie,' . $this->id;
        }else{
            $rules['producto_placa'] .= '|max:20';
            $rules['producto_serie'] .= '|max:20';
        }

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getProducto($id)
    {
        $query = Producto::query();
        $query->select('producto.*','tercero_nit', 'marca_modelo', 'modelo_nombre', 'tipo_nombre', 'estado_nombre',DB::raw("CONCAT(tercero_nombre1, ' ', tercero_nombre2, ' ', tercero_apellido1, ' ', tercero_apellido2) as tercero_nombre"));
        $query->join('marca', 'producto.producto_marca', '=', 'marca.id');
        $query->join('tipo', 'producto.producto_tipo', '=', 'tipo.id');
        $query->join('modelo', 'producto.producto_modelo', '=', 'modelo.id');
        $query->join('estado', 'producto.producto_estado', '=', 'estado.id');
        $query->join('tercero', 'producto.producto_proveedor', '=', 'tercero.id');
        $query->where('producto.id', $id);
        return $query->first();
    }

    //EQ && RP
    public static function getProducts()
    {
        if (Cache::has( self::$key_cache )) {
            return Cache::get( self::$key_cache );
        }

        return Cache::rememberForever( self::$key_cache , function() {
            $query = Producto::query();
            $query->orderBy('producto_nombre', 'asc');
            $collection = $query->lists('producto_nombre', 'producto_placa');

            $collection->prepend('', '');
            return $collection;
        });
    }

     /**
     * Get the contadores for the product.
     */
    public function contadores()
    {
        return $this->hasMany('App\Models\Inventario\ProductoContador', 'productocontador_producto', 'id');
    }
}
