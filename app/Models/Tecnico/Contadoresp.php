<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventario\ProductoContador;
use Validator, Cache,DB;

class Contadoresp extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contadoresp';

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contadoresp_documento','contadoresp_genero','contadoresp_producto_contador','contadoresp_valor'];

     public function isValid($data)
    {
        $rules = [
            
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

  	
}
