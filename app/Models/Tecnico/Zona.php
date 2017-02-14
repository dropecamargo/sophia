<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator ,Cache ,DB;
use App\Models\BaseModel;

class Zona extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'zona';

    public $timestamps = false;

    /**
     * The key used by cache store.
     *
     * @var static string
     */
    public static $key_cache = '_zonas';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['zona_nombre'];

    protected $boolean = ['zona_activo'];

    public function isValid($data)
    {
        $rules = [
            'zona_nombre' => 'required|max:10'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

     public static function getZonas()
    {
        if (Cache::has( self::$key_cache )) {
            return Cache::get( self::$key_cache );
        }

        return Cache::rememberForever( self::$key_cache , function() {
            $query = Zona::query();
            $query->orderBy('zona_nombre', 'asc');
            $collection = $query->lists('zona_nombre', 'id');

            $collection->prepend('', '');
            return $collection;
        });
    }
}
