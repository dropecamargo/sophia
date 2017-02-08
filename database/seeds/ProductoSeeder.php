<?php

use Illuminate\Database\Seeder;

use App\Models\Inventario\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'producto_placa'   => 1,
            'producto_serie'   => 'TC',
            'producto_referencia'   => 'T-2',
            'producto_codigo'   => 'T-2',
            'producto_nombre'   => 'TONER',
            'producto_parte'   => 'MAQUINA',
            'producto_tipo'   => 1,
            'producto_marca'   => 1,
            'producto_modelo'   => 1,
            'producto_estado'   => 1,
            'producto_proveedor'    => 1,
            'producto_vida_util'    => 1,
            'producto_costo_promedio'=> 1.52 ,
            'producto_ultimo_costo' => 5.033 ,
            'producto_tercero' => 1,
            'producto_contrato' =>1,
            
        ]);
           
           
    }
}
