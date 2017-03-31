<?php

namespace App\Models\Base;
use Validator,Cache;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Estado extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'estado';

    public $timestamps = false;

    /**
     * The key used by cache store.
     *
     * @var static string
     */
    public static $key_cache = '_estados';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['estado_nombre'];

    protected $boolean = ['estado_activo'];

    public function isValid($data)
    {
        $rules = [
            'estado_nombre' => 'required|max:200'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getEstados()
    {
        if ( Cache::has(self::$key_cache)) {
            return Cache::get(self::$key_cache);
        }

        return Cache::rememberForever( self::$key_cache , function() {
            $query = Estado::query();
            $query->where('estado_activo', true);
            $query->orderBy('estado_nombre', 'asc');
            $collection = $query->lists('estado_nombre', 'estado.id');

            $collection->prepend('', '');
            return $collection;
        });
    }
}
