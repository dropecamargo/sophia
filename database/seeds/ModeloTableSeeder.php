<?php

use Illuminate\Database\Seeder;
use App\Models\Inventario\Modelo;

class ModeloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modelo::create([
        	'modelo_nombre' => 'GALAXY',
        	'modelo_activo' => true
    	]);

        Modelo::create([
            'modelo_nombre' => 'PLUS',
            'modelo_activo' => true
        ]);

        Modelo::create([
            'modelo_nombre' => 'GENERACION',
            'modelo_activo' => true
        ]);

        Modelo::create([
            'modelo_nombre' => 'BMW',
            'modelo_activo' => true
        ]);

        Modelo::create([
            'modelo_nombre' => 'ULTRA',
            'modelo_activo' => true
        ]);
    }
}
