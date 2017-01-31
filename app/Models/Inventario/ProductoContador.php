<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

use Validator,Cache;

class ProductoContador extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productocontador';

    public $timestamps = false;

    /**
     * The key used by cache store.
     *
     * @var static string
     */
    public static $key_cache = '_productoscontador';

    public function isValid($data)
    {
        $rules = [
            'productocontador_producto' => 'required',
            'productocontador_contador' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getContadores()
    {
        if ( Cache::has(self::$key_cache)) {
            return Cache::get(self::$key_cache);
        }

        return Cache::rememberForever( self::$key_cache , function() {
            $query = Contador::query();
            $query->orderBy('contador_nombre', 'asc');
            $collection = $query->lists('contador_nombre', 'contador.id');

            $collection->prepend('', '');
            return $collection;
        });
    }
}
