<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;

use Validator, Cache;

class Modelo extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modelo';

    public $timestamps = false;

    /**
     * The key used by cache store.
     *
     * @var static string
     */
 //public static $key_cache = '';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['modelo_nombre','modelo_activo'];

    public function isValid($data)
    {
        $rules = [
            'modelo_nombre' => 'required|max:200',
            'modelo_activo' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
