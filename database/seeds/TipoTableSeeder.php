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
            'tipo_codigo' => 'EQ',
            'tipo_nombre' => 'Equipo',
            'tipo_activo' => true
        ]);

        Tipo::create([
            'tipo_codigo' => 'CO',
            'tipo_nombre' => 'Consumible',
            'tipo_activo' => true
        ]);

        Tipo::create([
            'tipo_codigo' => 'IN',
            'tipo_nombre' => 'Insumo',
            'tipo_activo' => true
        ]);

        Tipo::create([
            'tipo_codigo' => 'RP',
            'tipo_nombre' => 'Repuesto',
            'tipo_activo' => true
        ]);
        
        Tipo::create([
            'tipo_codigo' => 'AC',
        	'tipo_nombre' => 'Accesorio',
        	'tipo_activo' => true
        ]);
    }
}
