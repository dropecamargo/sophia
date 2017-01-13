<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo', function (Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->string('tipo_codigo', 2)->unique();
            $table->string('tipo_nombre', 200);
            $table->boolean('tipo_activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo');
    }
}
