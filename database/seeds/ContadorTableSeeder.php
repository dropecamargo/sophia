<?php

use Illuminate\Database\Seeder;
use App\Models\Inventario\Contador;

class ContadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contador::create([
            'contador_nombre' => 'General'
        ]);
    }
}
