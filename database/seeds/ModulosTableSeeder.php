<?php

use Illuminate\Database\Seeder;
use App\Models\Base\Modulo;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modulo::create([
        	'name' => 'administracion',
        	'display_name' => 'Administracion',
        	'nivel1' => 1
    	]);

    	Modulo::create([
        	'name' => 'inventario',
        	'display_name' => 'Inventario',
        	'nivel1' => 2
    	]);

    	Modulo::create([
        	'name' => 'tecnico',
        	'display_name' => 'Tecnico',
        	'nivel1' => 3
    	]);

    	// Administracion
    	Modulo::create([
        	'display_name' => 'Modulos',
        	'nivel1' => 1,
        	'nivel2' => 1
    	]);

    	Modulo::create([
        	'display_name' => 'Referencias',
        	'nivel1' => 1,
        	'nivel2' => 2
    	]);

    	//Modulos
    	Modulo::create([
        	'name' => 'terceros',
        	'display_name' => 'Tercero',
        	'nivel1' => 1,
        	'nivel2' => 1,
        	'nivel3' => 2
    	]);

    	Modulo::create([
        	'name' => 'roles',
        	'display_name' => 'Roles',
        	'nivel1' => 1,
        	'nivel2' => 1,
        	'nivel3' => 3
    	]);

    	//Referencias
    	Modulo::create([
        	'name' => 'actividades',
        	'display_name' => 'Acitividades',
        	'nivel1' => 1,
        	'nivel2' => 2,
        	'nivel3' => 1
    	]);

    	Modulo::create([
        	'name' => 'departamentos',
        	'display_name' => 'Departamentos',
        	'nivel1' => 1,
        	'nivel2' => 2,
        	'nivel3' => 2
    	]);

    	Modulo::create([
        	'name' => 'modulos',
        	'display_name' => 'Modulos',
        	'nivel1' => 1,
        	'nivel2' => 2,
        	'nivel3' => 3
    	]);

    	Modulo::create([
        	'name' => 'municipios',
        	'display_name' => 'Municipios',
        	'nivel1' => 1,
        	'nivel2' => 2,
        	'nivel3' => 4
    	]);

    	Modulo::create([
        	'name' => 'permisos',
        	'display_name' => 'Permisos',
        	'nivel1' => 1,
        	'nivel2' => 2,
        	'nivel3' => 5
    	]);

		Modulo::create([
        	'name' => 'sucursales',
        	'display_name' => 'Sucursales',
        	'nivel1' => 1,
        	'nivel2' => 2,
        	'nivel3' => 7
    	]);

    	// Inventario
    	Modulo::create([
        	'display_name' => 'Modulos',
        	'nivel1' => 2,
        	'nivel2' => 1
    	]);

    	Modulo::create([
        	'display_name' => 'Referencias',
        	'nivel1' => 2,
        	'nivel2' => 2
    	]);

    	//Modulos
    	Modulo::create([
        	'name' => 'productos',
        	'display_name' => 'Productos',
        	'nivel1' => 2,
        	'nivel2' => 1,
        	'nivel3' => 1
    	]);


    	//referencias
    	Modulo::create([
        	'name' => 'modelos',
        	'display_name' => 'Modelos',
        	'nivel1' => 2,
        	'nivel2' => 2,
        	'nivel3' => 1
    	]);

    	Modulo::create([
        	'name' => 'estados',
        	'display_name' => 'Estados',
        	'nivel1' => 2,
        	'nivel2' => 2,
        	'nivel3' => 2
    	]);

    	Modulo::create([
        	'name' => 'marcas',
        	'display_name' => 'Marcas',
        	'nivel1' => 2,
        	'nivel2' => 2,
        	'nivel3' => 3
    	]);

    	Modulo::create([
        	'name' => 'tipos',
        	'display_name' => 'Tipos',
        	'nivel1' => 2,
        	'nivel2' => 2,
        	'nivel3' => 4
    	]);

    	Modulo::create([
        	'name' => 'contadores',
        	'display_name' => 'Contadores',
        	'nivel1' => 2,
        	'nivel2' => 2,
        	'nivel3' => 5
    	]);

    	// Tecnico
    	Modulo::create([
        	'display_name' => 'Modulos',
        	'nivel1' => 3,
        	'nivel2' => 1
    	]);

    	Modulo::create([
        	'display_name' => 'Referencias',
        	'nivel1' => 3,
        	'nivel2' => 2
    	]);

    	//Modulos
    	Modulo::create([
        	'name' => 'contratos',
        	'display_name' => 'Contratos',
        	'nivel1' => 3,
        	'nivel2' => 1,
        	'nivel3' => 1
    	]);

    	Modulo::create([
        	'name' => 'asignaciones',
        	'display_name' => 'Asignaciones',
        	'nivel1' => 3,
        	'nivel2' => 1,
        	'nivel3' => 2
    	]);

    	Modulo::create([
        	'name' => 'ordenes',
        	'display_name' => 'Ordenes',
        	'nivel1' => 3,
        	'nivel2' => 1,
        	'nivel3' => 3
    	]);

    	//Referencias
    	Modulo::create([
        	'name' => 'tiposorden',
        	'display_name' => 'Tipo de Orden',
        	'nivel1' => 3,
        	'nivel2' => 2,
        	'nivel3' => 1
    	]);

    	Modulo::create([
        	'name' => 'solicitantes',
        	'display_name' => 'Solicitantes',
        	'nivel1' => 3,
        	'nivel2' => 2,
        	'nivel3' => 2
    	]);

    	Modulo::create([
        	'name' => 'danos',
        	'display_name' => 'Daños',
        	'nivel1' => 3,
        	'nivel2' => 2,
        	'nivel3' => 3
    	]);

    	Modulo::create([
        	'name' => 'prioridades',
        	'display_name' => 'Prioridades',
        	'nivel1' => 3,
        	'nivel2' => 2,
        	'nivel3' => 4
    	]);

    	Modulo::create([
        	'name' => 'zonas',
        	'display_name' => 'Zonas',
        	'nivel1' => 3,
        	'nivel2' => 2,
        	'nivel3' => 5
    	]);
    }
}
