<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Models\BaseModel;

class Marca extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marca';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['marca_modelo'];

    protected $boolean = ['marca_activo'];

    public function isValid($data)
    {
        $rules = [
            'marca_modelo' => 'required|max:200'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
