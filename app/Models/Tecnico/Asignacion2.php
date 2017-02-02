<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Asignacion2 extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asignacion2';

    public $timestamps = false;

    public function isValid($data)
    {
        $rules = [
            'asignacion2_asignacion1' => 'required',
            'asignacion2_producto' => 'required',
            'asignacion2_deproducto' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
