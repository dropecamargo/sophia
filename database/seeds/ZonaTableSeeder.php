<?php

use Illuminate\Database\Seeder;
use App\Models\Tecnico\Zona;

class ZonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zona::create([
        	'zona_nombre' => 'Ilicita',
        	'zona_activo' => true
    	]);

    	Zona::create([
        	'zona_nombre' => 'Ilicita',
        	'zona_activo' => true
    	]);

    	Zona::create([
        	'zona_nombre' => 'Ilicita',
        	'zona_activo' => true
    	]);

    	Zona::create([
        	'zona_nombre' => 'Ilicita',
        	'zona_activo' => true
    	]);
    }
}
