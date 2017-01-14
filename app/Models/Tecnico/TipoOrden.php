<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Models\BaseModel;

class TipoOrden extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipoorden';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipoorden_nombre'];

    protected $boolean = ['tipoorden_activo'];

    public function isValid($data)
    {
        $rules = [
            'tipoorden_nombre' => 'required|max:200'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
