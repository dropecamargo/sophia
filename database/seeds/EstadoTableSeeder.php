<?php

use Illuminate\Database\Seeder;
use App\Models\Base\Estado;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
        	'estado_nombre' => 'EXCELENTE',
        	'estado_activo' => true
    	]);

        Estado::create([
            'estado_nombre' => 'NUEVO',
            'estado_activo' => true
        ]);

        Estado::create([
            'estado_nombre' => 'USADO',
            'estado_activo' => true
        ]);

        Estado::create([
            'estado_nombre' => 'CRITICO',
            'estado_activo' => true
        ]);
    }
}
