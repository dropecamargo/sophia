<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Producto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'producto';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['producto_placa','producto_serie','producto_referencia','producto_codigo','producto_nombre','producto_parte','producto_vida_util','producto_costo_promedio','producto_ultimo_costo'];

    public function isValid($data)
    {
        $rules = [
            'producto_placa' => 'unique:producto',
            'producto_serie' => 'unique:producto|max:20',
            'producto_referencia' => 'required|max:20',
            'producto_codigo' => 'required|max:20',
            'producto_nombre' => 'required|max:100',
            'producto_parte' => 'required|max:20',
            'producto_vida_util' => 'required',
            'producto_costo_promedio' => 'required',
            'producto_ultimo_costo' => 'required',
        ];

        if($this->exists){
            $rules['producto_placa'] .= ',producto_placa,' . $this->id;
        }else{
            $rules['producto_placa'] .= '|max:20';
        }

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
