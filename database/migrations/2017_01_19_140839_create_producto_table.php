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
            $table->string('producto_codigo', 20)->unique()->nullable();
            $table->string('producto_nombre', 100);

            $table->integer('producto_tipo')->unsigned()->nullable();
            $table->integer('producto_marca')->unsigned()->nullable();
            $table->integer('producto_modelo')->unsigned()->nullable();
            $table->integer('producto_estado')->unsigned()->nullable();
            $table->integer('producto_proveedor')->unsigned()->nullable();
            
            $table->integer('producto_vida_util')->unsigned();
            $table->double('producto_costo_promedio');
            $table->double('producto_ultimo_costo');

            $table->integer('producto_tercero')->unsigned()->nullable();
            $table->integer('producto_contrato')->unsigned()->nullable();
            $table->integer('producto_maquina')->unsigned()->nullable();

            $table->foreign('producto_tipo')->references('id')->on('tipo')->onDelete('restrict');
            $table->foreign('producto_maquina')->references('id')->on('producto')->onDelete('restrict');
            $table->foreign('producto_marca')->references('id')->on('marca')->onDelete('restrict');
            $table->foreign('producto_modelo')->references('id')->on('modelo')->onDelete('restrict');
            $table->foreign('producto_estado')->references('id')->on('estado')->onDelete('restrict');
            $table->foreign('producto_proveedor')->references('id')->on('tercero')->onDelete('restrict');
            $table->foreign('producto_tercero')->references('id')->on('tercero')->onDelete('restrict');
            $table->foreign('producto_contrato')->references('id')->on('contrato')->onDelete('restrict');
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
