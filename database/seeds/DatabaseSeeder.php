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
        $this->call(TipoTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(ActividadTableSeeder::class);
        $this->call(ContactoTableSeeder::class);
        $this->call(ContratoSeeder::class);
        $this->call(ContadorTableSeeder::class);
        $this->call(ModulosTableSeeder::class);
        $this->call(PermisosTableSeeder::class);
        $this->call(ZonaTableSeeder::class);
        $this->call(RolTableSeeder::class);
        $this->call(UsuarioRolTableSeeder::class);
        Model::reguard();
    }
}
