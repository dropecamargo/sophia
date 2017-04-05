<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

use Validator,DB,Cache;

class Producto extends BaseModel
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
    public static $key_cache = '_product';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['producto_referencia','producto_codigo','producto_nombre','producto_placa', 'producto_serie','producto_vida_util','producto_tipo','producto_estado','producto_modelo','producto_marca','producto_maquina'];

    /**
    * The attributes nulleables from the model.
    *
    * @var array
    */
    protected $nullable = ['producto_estado', 'producto_marca','producto_modelo','producto_placa', 'producto_serie','producto_maquina'];

    public function isValid($data)
    {
        $rules = [
            'producto_placa' => 'unique:producto',
            'producto_serie' => 'unique:producto',
            'producto_codigo' => 'unique:producto',
            'producto_tipo' => 'required',
        ];

        if($this->exists){
            $rules['producto_placa'] .= ',producto_placa,' . $this->id;
            $rules['producto_serie'] .= ',producto_serie,' . $this->id;
            $rules['producto_codigo'] .= ',producto_codigo,' . $this->id;
        }else{
            $rules['producto_placa'] .= '|max:20';
            $rules['producto_serie'] .= '|max:20';
            $rules['producto_codigo'] .= '|max:20';
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
        $query->select('producto.*','tercero_nit', 'marca_modelo', 'modelo_nombre', 'tipo_nombre','tipo_codigo', 'estado_nombre',DB::raw("CONCAT(tercero_nombre1, ' ', tercero_nombre2, ' ', tercero_apellido1, ' ', tercero_apellido2) as tercero_nombre"));
        $query->Leftjoin('marca', 'producto.producto_marca', '=', 'marca.id');
        $query->join('tipo', 'producto.producto_tipo', '=', 'tipo.id');
        $query->Leftjoin('modelo', 'producto.producto_modelo', '=', 'modelo.id');
        $query->Leftjoin('estado', 'producto.producto_estado', '=', 'estado.id');
        $query->Leftjoin('tercero', 'producto.producto_proveedor', '=', 'tercero.id');
        $query->where('producto.id', $id);
        return $query->first();
    }

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

    public function validarProducto()
    {
        // Validar vida util
        if(in_array($this->tipo->tipo_codigo, ['CO', 'IN'])) {
            if(empty(trim($this->producto_vida_util)) || is_null(trim($this->producto_vida_util))) {
                return trans('validation.required_if', ['attribute' => 'Vida util', 'other' => 'tipo',  'value' => 'Consumible o Insumo']);
            }
            if(empty(trim($this->producto_marca)) || is_null(trim($this->producto_marca))){
                return trans('validation.required_if', ['attribute' => 'Marca', 'other' => 'tipo',  'value' => 'Consumible o Insumo']);
            }
            if(empty(trim($this->producto_estado)) || is_null(trim($this->producto_estado))) {
                return trans('validation.required_if', ['attribute' => 'Estado', 'other' => 'tipo',  'value' => 'Consumible o Insumo']);
            }
            if(empty(trim($this->producto_codigo)) || is_null(trim($this->producto_codigo))) {
                return trans('validation.required_if', ['attribute' => 'Codigo contable', 'other' => 'tipo',  'value' => 'Consumible o Insumo']);
            } 
            if(empty(trim($this->producto_referencia)) || is_null(trim($this->producto_referencia))) {
                return trans('validation.required_if', ['attribute' => 'Referencia de proovedor', 'other' => 'tipo',  'value' => 'Consumible o Insumo']);
            }
            if(empty(trim($this->producto_nombre)) || is_null(trim($this->producto_nombre))) {
                return trans('validation.required_if', ['attribute' => 'Nombre', 'other' => 'tipo',  'value' => 'Consumible o Insumo']);
            }
            if(empty(trim($this->producto_proveedor)) || is_null(trim($this->producto_proveedor))) {
                return trans('validation.required_if', ['attribute' => 'Proovedor', 'other' => 'tipo',  'value' => 'Consumible o Insumo']);
            }
        }

        //Validar Repuesto
        if(in_array($this->tipo->tipo_codigo, ['RP'])){
            if(empty(trim($this->producto_marca)) || is_null(trim($this->producto_marca))){
                return trans('validation.required_if', ['attribute' => 'Marca', 'other' => 'tipo',  'value' => 'Repuesto']);
            }
            if(empty(trim($this->producto_estado)) || is_null(trim($this->producto_estado))) {
                return trans('validation.required_if', ['attribute' => 'Estado', 'other' => 'tipo',  'value' => 'Repuesto']);
            }
            if(empty(trim($this->producto_codigo)) || is_null(trim($this->producto_codigo))) {
                return trans('validation.required_if', ['attribute' => 'Codigo contable', 'other' => 'tipo',  'value' => 'Repuesto']);
            }
            if(empty(trim($this->producto_referencia)) || is_null(trim($this->producto_referencia))) {
                return trans('validation.required_if', ['attribute' => 'Referencia de proovedor', 'other' => 'tipo',  'value' => 'Repuesto']);
            }
            if(empty(trim($this->producto_nombre)) || is_null(trim($this->producto_nombre))) {
                return trans('validation.required_if', ['attribute' => 'Nombre', 'other' => 'tipo',  'value' => 'Repuesto']);
            }
            if(empty(trim($this->producto_proveedor)) || is_null(trim($this->producto_proveedor))) {
                return trans('validation.required_if', ['attribute' => 'Proovedor', 'other' => 'tipo',  'value' => 'Repuesto']);
            }
        }

        if(in_array($this->tipo->tipo_codigo, ['AC'])){
            if(empty(trim($this->producto_referencia)) || is_null(trim($this->producto_referencia))) {
                return trans('validation.required_if', ['attribute' => 'Referencia de proovedor', 'other' => 'tipo',  'value' => 'Accesorio']);
            }
            if(empty(trim($this->producto_nombre)) || is_null(trim($this->producto_nombre))) {
                return trans('validation.required_if', ['attribute' => 'Nombre', 'other' => 'tipo',  'value' => 'Accesorio']);
            }
            if(empty(trim($this->producto_estado)) || is_null(trim($this->producto_estado))) {
                return trans('validation.required_if', ['attribute' => 'Estado', 'other' => 'tipo',  'value' => 'Accesorio']);
            }
            if (empty(trim($this->producto_marca)) || is_null(trim($this->producto_marca))) {
                return trans('validation.required_if', ['attribute' => 'Marca', 'other' => 'tipo',  'value' => 'Accesorio']);
            }
            if(empty(trim($this->producto_serie)) || is_null(trim($this->producto_serie))){
                return trans('validation.required_if', ['attribute' => 'Serie', 'other' => 'tipo',  'value' => 'Accesorio']);
            }
            if(empty(trim($this->producto_codigo)) || is_null(trim($this->producto_codigo))) {
                return trans('validation.required_if', ['attribute' => 'Codigo contable', 'other' => 'tipo',  'value' => 'Accesorio']);
            }
            if(empty(trim($this->producto_proveedor)) || is_null(trim($this->producto_proveedor))) {
                return trans('validation.required_if', ['attribute' => 'Proovedor', 'other' => 'tipo',  'value' => 'Accesorio']);
            }
        }

        //Validar Estado,Marca,Modelo
        if(in_array($this->tipo->tipo_codigo, ['EQ'])) {
            if(empty(trim($this->producto_referencia)) || is_null(trim($this->producto_referencia))) {
                return trans('validation.required_if', ['attribute' => 'Referencia de proovedor', 'other' => 'tipo',  'value' => 'Equipo']);
            }
            if(empty(trim($this->producto_nombre)) || is_null(trim($this->producto_nombre))) {
                return trans('validation.required_if', ['attribute' => 'nombre', 'other' => 'tipo',  'value' => 'Equipo']);
            }
            if(empty(trim($this->producto_estado)) || is_null(trim($this->producto_estado))) {
                return trans('validation.required_if', ['attribute' => 'Estado', 'other' => 'tipo',  'value' => 'Equipo']);
            }
            if (empty(trim($this->producto_modelo)) || is_null(trim($this->producto_modelo))) {
                return trans('validation.required_if', ['attribute' => 'Modelo', 'other' => 'tipo',  'value' => 'Equipo']);
            }
            if (empty(trim($this->producto_marca)) || is_null(trim($this->producto_marca))) {
                return trans('validation.required_if', ['attribute' => 'Marca', 'other' => 'tipo',  'value' => 'Equipo']);
            }
            if(empty(trim($this->producto_serie)) || is_null(trim($this->producto_serie))){
                return trans('validation.required_if', ['attribute' => 'Serie', 'other' => 'tipo',  'value' => 'Equipo']);
            }
            if(empty(trim($this->producto_placa)) || is_null(trim($this->producto_placa))){
                return trans('validation.required_if', ['attribute' => 'Placa', 'other' => 'tipo',  'value' => 'Equipo']);
            }
            if(empty(trim($this->producto_codigo)) || is_null(trim($this->producto_codigo))) {
                return trans('validation.required_if', ['attribute' => 'Codigo contable', 'other' => 'tipo',  'value' => 'Equipo']);
            }
            if(empty(trim($this->producto_proveedor)) || is_null(trim($this->producto_proveedor))) {
                return trans('validation.required_if', ['attribute' => 'Proovedor', 'other' => 'tipo',  'value' => 'Equipo']);
            }
        }
        return 'OK';
    }

    /**
    * Get the contadores for the product.
    */
    public function contadores()
    {
        return $this->hasMany('App\Models\Inventario\ProductoContador', 'productocontador_producto', 'id');
    }

    /**
    * Get tipo
    */
    public function tipo()
    {
        return $this->hasOne('App\Models\Inventario\Tipo', 'id' , 'producto_tipo');
    }

    /**
    * Get Estado
    */
    public function estado()
    {
        return $this->hasOne('App\Models\Base\Estado', 'id' , 'producto_estado');
    }
}
