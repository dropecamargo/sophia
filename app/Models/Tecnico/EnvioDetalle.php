<?php

namespace App\Models\Tecnico;

use Illuminate\Database\Eloquent\Model;
use Validator,DB;
use App\Models\Inventario\Producto;

class EnvioDetalle extends Model
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
            'asignacion2_producto' => 'required',
        ];

        $producto = Producto::where('producto_serie', $data['producto_tipo_search'])->first();

        if($producto){
            $rules = ['producto_tipo_search' => 'required'];
        }

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }
}
