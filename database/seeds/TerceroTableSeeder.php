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
            'tercero_nombre1'   => 'Pedro',
            'tercero_nombre2'   => 'Antonio',
            'tercero_apellido1'   => 'Camargo',
            'tercero_apellido2'   => 'Jimenez',
            // 'tercero_actividad'   => 204,
            'tercero_activo'   => true,
            'tercero_interno'   => true,
            'tercero_email'    => 'dropecamargo@gmail.com',
            'username'    => 'admin',
            'password' => bcrypt('admin')
        ]);

        Tercero::create([
            'tercero_nit'   => 1019120165,
            'tercero_tipo'   => 'CC',
            'tercero_regimen'   => 1,
            'tercero_persona'   => 'N',
            'tercero_nombre1'   => str_random(6),
            'tercero_nombre2'   => str_random(6),
            'tercero_apellido1'   => str_random(6),
            'tercero_apellido2'   => str_random(6),
            // 'tercero_actividad'   => 204,
            'tercero_activo'   => true,
            'tercero_interno'   => true,
            'tercero_email'    => str_random(10).'dropecamargo@gmail.com',
            'username'    => 'koi',
            'password' => bcrypt('admin')
        ]);
    }
 }

