<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

use Validator,Cache,DB;

class ProductoContador extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productocontador';

    public $timestamps = false;

    
    public function isValid($data)
    {
        $rules = [
            'productocontador_producto' => 'required',
            'productocontador_contador' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

  
    public static function getProductoContador($id)
    {
        $query = ProductoContador::query();
        $query->select('productocontador.*','producto.producto_nombre','contador.contador_nombre');
        $query->where('productocontador_producto', $id);
        $query->join('contador', 'productocontador.productocontador_contador', '=', 'contador.id');
        $query->join('producto', 'productocontador.productocontador_producto', '=', 'producto.id'); 
        $query->orderBy('productocontador.id', 'asc');
        return  $query->get();
    }

    /**
     * Get the contador record associated with the producto contador.
     */
    public function contador()
    {
        return $this->hasOne('App\Models\Inventario\Contador', 'id' , 'productocontador_contador');
    }
}
