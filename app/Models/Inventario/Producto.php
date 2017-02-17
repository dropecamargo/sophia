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
    public static $key_cache = '_pruduct';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['producto_placa','producto_serie','producto_referencia','producto_codigo','producto_nombre','producto_parte','producto_vida_util','producto_tipo','producto_estado','producto_modelo','producto_marca'];

    /**
    * The attributes nulleables from the model.
    *
    * @var array
    */

    protected $nullable = ['producto_estado', 'producto_marca','producto_modelo'];

    public function isValid($data)
    {
        $rules = [
            'producto_placa' => 'unique:producto',
            'producto_serie' => 'unique:producto',
            'producto_referencia' => 'required|max:20',
            'producto_codigo' => 'required|max:20',
            'producto_nombre' => 'required|max:100',
            'producto_parte' => 'max:20',
            'producto_tipo' => 'required',
            'producto_vida_util'=> 'numeric'
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
        // Validar parte
        if(in_array($this->tipo->tipo_codigo, ['RP', 'CO'])) {
            if(empty(trim($this->producto_parte)) || is_null(trim($this->producto_parte))) {
                return trans('validation.required_if', ['attribute' => 'Parte', 'other' => 'Tipo',  'value' => 'Repuesto o Consumible']);
            }
        }

        // Validar vida util
        if(in_array($this->tipo->tipo_codigo, ['RP', 'CO', 'IN'])) {
            if(empty(trim($this->producto_vida_util)) || is_null(trim($this->producto_vida_util))) {
                return trans('validation.required_if', ['attribute' => 'Vida util', 'other' => 'Tipo',  'value' => 'Repuesto, Consumible o Insumo']);
            }
        }

        //Validar Estado,Marca,Modelo
        if(in_array($this->tipo->tipo_codigo, ['EQ'])) {
            if(empty(trim($this->producto_estado)) || is_null(trim($this->producto_estado))) {
                return trans('validation.required_if', ['attribute' => 'Estado', 'other' => 'Tipo',  'value' => 'Equipo']);
            }
            if (empty(trim($this->producto_modelo)) || is_null(trim($this->producto_modelo))) {
                return trans('validation.required_if', ['attribute' => 'Modelo', 'other' => 'Tipo',  'value' => 'Equipo']);
            }
            if (empty(trim($this->producto_marca)) || is_null(trim($this->producto_marca))) {
                return trans('validation.required_if', ['attribute' => 'Marca', 'other' => 'Tipo',  'value' => 'Equipo']);
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
