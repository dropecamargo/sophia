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
        	'zona_nombre' => 'Norte',
        	'zona_activo' => true
    	]);

    	Zona::create([
        	'zona_nombre' => 'Sur',
        	'zona_activo' => true
    	]);

    	Zona::create([
        	'zona_nombre' => 'Este',
        	'zona_activo' => true
    	]);

    	Zona::create([
        	'zona_nombre' => 'Oeste',
        	'zona_activo' => true
    	]);
    }
}
