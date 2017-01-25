<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;

use Validator;

class ContratoDano extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contratodano';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contratodano_contrato','contratodano_dano','contratodano_tiempo'];


    public function isValid($data)
    {
        $rules = [
            'contratodano_contrato' => 'required|numeric',
            'contratodano_dano' => 'required|numeric',
            'contratodano_tiempo' => 'required|numeric'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

}
