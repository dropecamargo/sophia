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
        	'modelo_nombre' => 'Bmw',
        	'modelo_activo' => true
        	]);

    }
}
