<?php

use Illuminate\Database\Seeder;
use App\Models\Inventario\Tipo;

class TipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create([
            'tipo_codigo' => 'D',
        	'tipo_nombre' => 'Unico',
        	'tipo_activo' => false
        	]);
    }
}
