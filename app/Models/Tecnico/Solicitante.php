<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator,Cache,DB;
use App\Models\BaseModel;

class Solicitante extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'solicitante';

    public $timestamps = false;

      /**
     * The key used by cache store.
     *
     * @var static string
     */
    public static $key_cache = '_solicitante';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['solicitante_nombre'];

    protected $boolean = ['solicitante_activo'];

    public function isValid($data)
    {
        $rules = [
            'solicitante_nombre' => 'required|max:200'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getSolicitantes()
    {
        if (Cache::has( self::$key_cache )) {
            return Cache::get( self::$key_cache );
        }

        return Cache::rememberForever( self::$key_cache , function() {
            $query = Solicitante::query();
            $query->orderBy('id', 'asc');
            $collection = $query->lists('solicitante_nombre', 'id');

            $collection->prepend('', '');
            return $collection;
        });
    }
}
