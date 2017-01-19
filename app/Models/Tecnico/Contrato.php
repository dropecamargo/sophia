<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Models\BaseModel;

class Contrato extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contrato';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contrato_numero','contrato_tercero','contrato_fecha','contrato_vencimiento','contrato_condiciones'];

    protected $boolean = ['contrato_activo'];

    public function isValid($data)
    {
        $rules = [
            'contrato_numero' => 'required|max:10',
            'contrato_condiciones' => 'required',
            'contrato_fecha' => 'required',
            'contrato_vencimiento' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
