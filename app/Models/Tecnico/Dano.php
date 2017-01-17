<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Models\BaseModel;

class Dano extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dano';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dano_nombre'];

    protected $boolean = ['dano_activo'];

    public function isValid($data)
    {
        $rules = [
            'dano_nombre' => 'required|max:200'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
