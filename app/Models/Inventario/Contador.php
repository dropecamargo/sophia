<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;
use Validator;
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
}
