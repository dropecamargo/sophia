<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(TerceroTableSeeder::class);
<<<<<<< HEAD
        $this->call(DepartamentoTableSeeder::class);
=======
         $this->call(DepartamentoTableSeeder::class);
>>>>>>> 37d3d84fd4906fd5dab8bbf919d6255ca6cc2485
        $this->call(MunicipioTableSeeder::class);
        $this->call(ActividadTableSeeder::class);
        $this->call(ContactoTableSeeder::class);

        Model::reguard();
    }
}
