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
        	'actividad_nombre' => 'Ilicita',
        	'actividad_tarifa' => 400,
        	'actividad_categoria' => 'A'
        	]);
    }
}
