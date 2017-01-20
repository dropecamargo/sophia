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
        	'estado_nombre' => 'Excelente',
        	'estado_activo' => true
        	]);
    }
}
