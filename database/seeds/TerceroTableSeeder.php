<?php

use Illuminate\Database\Seeder;
use App\Models\Base\Tercero;

class TerceroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         	 Tercero::create([
            'tercero_nit'   => 1023878024,
            'tercero_tipo'   => 'CC',
            'tercero_regimen'   => 1,
            'tercero_persona'   => 'N',
            'tercero_nombre1'   => 'Cristian',
            'tercero_nombre2'   => 'Daniel',
            'tercero_apellido1'   => 'Camargo',
            'tercero_apellido2'   => 'Jimenez',
                       
            'username'    => 'admin',
            'password' => bcrypt('admin')
        ]);
    }
}
