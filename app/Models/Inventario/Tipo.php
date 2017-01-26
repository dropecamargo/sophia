<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

use App\Models\BaseModel;

use Validator,Cache;

class Tipo extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo';

    public $timestamps = false;

    /**
     * The key used by cache store.
     *
     * @var static string
     */
    public static $key_cache = '_tipos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_codigo','tipo_nombre'];

    /**
     * The attributes that are mass boolean assignable.
     *
     * @var array
     */
    protected $boolean = ['tipo_activo'];

    public function isValid($data)
    {
        $rules = [
            'tipo_codigo' => 'required|max:2|min:1|unique:tipo',
            'tipo_nombre' => 'required|max:200'
        
        ];

        if($this->exists){
            $rules['tipo_codigo'] .= ',tipo_codigo,' . $this->id;
        }else{
            $rules['tipo_codigo'] .= '|required';
        }

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getTipos()
    {
        if ( Cache::has(self::$key_cache)) {
            return Cache::get(self::$key_cache);
        }

        return Cache::rememberForever( self::$key_cache , function() {
            $query = Tipo::query();
            $query->orderBy('tipo_nombre', 'asc');
            $collection = $query->lists('tipo_nombre', 'tipo.id');

            $collection->prepend('', '');
            return $collection;
        });
    }

    public static function getTipo()
    {
        if ( Cache::has(self::$key_cache)) {
            return Cache::get(self::$key_cache);
        }

        return Cache::rememberForever( self::$key_cache , function() {
            $query = Tipo::query();
            $query->orderBy('tipo_codigo', 'asc');
            $collection = $query->lists('tipo_codigo', 'tipo.id');

            $collection->prepend('', '');
            return $collection;
        });
    }
}
