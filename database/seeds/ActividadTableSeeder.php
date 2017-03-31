<?php

use Illuminate\Database\Seeder;
use App\Models\Base\Actividad;

class ActividadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actividad::create([
        	'actividad_codigo' => '1',
        	'actividad_nombre' => 'ILICITA',
        	'actividad_tarifa' => 3.9,
        	'actividad_categoria' => '100'
    	]);

        Actividad::create([
            'actividad_codigo' => '10',
            'actividad_nombre' => 'COMERCIAL',
            'actividad_tarifa' => 3.3,
            'actividad_categoria' => '101'
        ]);

        Actividad::create([
            'actividad_codigo' => '1052',
            'actividad_nombre' => 'CONTABLE',
            'actividad_tarifa' => 3.3,
            'actividad_categoria' => '102'
        ]);

        Actividad::create([
            'actividad_codigo' => '1056',
            'actividad_nombre' => 'ALMACENAR',
            'actividad_tarifa' => 3.3,
            'actividad_categoria' => '103'
        ]);
    }
}
