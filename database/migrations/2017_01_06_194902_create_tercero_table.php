<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerceroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tercero', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('tercero_nit', 15)->unique();
            $table->integer('tercero_digito')->default(0);
            $table->string('tercero_tipo', 2)->nullable();
            $table->integer('tercero_regimen')->nullable();
            $table->string('tercero_persona', 1)->nullable();

            $table->string('tercero_nombre1', 100)->nullable();
            $table->string('tercero_nombre2', 100)->nullable();
            $table->string('tercero_apellido1', 100)->nullable();
            $table->string('tercero_apellido2', 100)->nullable();
            $table->string('tercero_razonsocial', 200)->nullable();
            $table->string('tercero_direccion', 200)->nullable();

            $table->string('username')->unique()->nullable();
            $table->string('password', 60);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tercero');
    }
}
