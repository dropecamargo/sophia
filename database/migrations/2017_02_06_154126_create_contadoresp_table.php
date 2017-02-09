<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContadorespTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('contadoresp', function(Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            
            $table->string('contadoresp_documento',2);
            $table->integer('contadoresp_genero');   
            $table->dateTime('contadoresp_fh');   
            $table->integer('contadoresp_producto_contador')->unsigned();   
            $table->integer('contadoresp_valor');  

            $table->foreign('contadoresp_producto_contador')->references('id')->on('productocontador')->onDelete('restrict'); 

        });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('contadoresp');

    }
}
