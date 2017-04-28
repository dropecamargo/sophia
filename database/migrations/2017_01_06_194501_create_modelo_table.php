<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModeloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('modelo', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('modelo_nombre', 200);
            $table->boolean('modelo_activo')->default(false);
            $table->string('producto_referencia', 20)->nullable();
            $table->string('producto_nombre', 100)->nullable();
            $table->integer('producto_marca')->unsigned()->nullable();

            $table->foreign('producto_marca')->references('id')->on('marca')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('modelo');
    }

}
