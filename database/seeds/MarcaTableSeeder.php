<?php

use Illuminate\Database\Seeder;
use App\Models\Tecnico\Marca;


class MarcaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marca::create([
            'marca_modelo' => 'Nike',
            'marca_activo' => true
        ]);
    }
}
