<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductocontadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productocontador', function(Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->integer('productocontador_producto')->unsigned()->nullable();
            $table->integer('productocontador_contador')->unsigned()->nullable();

            $table->foreign('productocontador_producto')->references('id')->on('producto')->onDelete('restrict');
            $table->foreign('productocontador_contador')->references('id')->on('contador')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productocontador');
    }
}
