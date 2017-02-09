<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;
use Validator,Cache,Log,DB;
use App\Models\BaseModel;

class Contador extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contador';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contador_nombre'];

    protected $boolean = ['contador_activo'];

    /**
     * The key used by cache store.
     *
     * @var static string
     */
    public static $key_cache = '_pcontador';


    /**
     * The default contador if machines.
     *
     * @var static integer
     */
    
    public static $ctr_machines = 1;
    
    public function isValid($data)
    {
        $rules = [
            'contador_nombre' => 'required|max:200'
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
