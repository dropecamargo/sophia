<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;

use App\Models\BaseModel;

use Validator;

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
        }

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
