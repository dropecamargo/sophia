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
            
            //$table->integer('producto_tipo')->unsigned();
            $table->integer('producto_marca')->unsigned()->nullable();
            /*$table->integer('producto_modelo')->unsigned();
            $table->integer('producto_estado')->unsigned();*/

            $table->string('producto_parte', 20);
            $table->integer('producto_vida_util');
            //$table->integer('producto_proovedor')->unsigned();
            $table->float('producto_costo_promedio');
            $table->float('producto_ultimo_costo');

            //$table->foreign('producto_tipo')->references('id')->on('tipo')->onDelete('restrict');
            $table->foreign('producto_marca')->references('id')->on('marca')->onDelete('restrict');
            /*$table->foreign('producto_modelo')->references('id')->on('modelo')->onDelete('restrict');
            $table->foreign('producto_estado')->references('id')->on('estado')->onDelete('restrict');
            $table->foreign('producto_proovedor')->references('id')->on('tercero')->onDelete('restrict');*/
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
