<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function(Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->integer('producto_placa')->unique()->nullable();
            $table->string('producto_serie', 20)->unique()->nullable();
            $table->string('producto_referencia', 20);
            $table->string('producto_codigo', 20);
            $table->string('producto_nombre', 100);
            $table->string('producto_parte', 20);
            $table->integer('producto_vida_util');
            $table->float('producto_costo_promedio');
            $table->float('producto_ultimo_costo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
