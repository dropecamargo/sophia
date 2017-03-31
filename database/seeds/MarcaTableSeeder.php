<?php

use Illuminate\Database\Seeder;
use App\Models\Inventario\Marca;

class MarcaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marca::create([
        	'marca_modelo' => 'APPLE',
        	'marca_activo' => true
    	]);

        Marca::create([
            'marca_modelo' => 'LENOVO',
            'marca_activo' => true
        ]);

        Marca::create([
            'marca_modelo' => 'MOTOROLA',
            'marca_activo' => true
        ]);

        Marca::create([
            'marca_modelo' => 'SAMSUNG',
            'marca_activo' => true
        ]);

        Marca::create([
            'marca_modelo' => 'JANUS',
            'marca_activo' => true
        ]);
    }
}
