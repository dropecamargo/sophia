<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->dateTime('orden_fecha');
            $table->integer('orden_tercero')->unsigned();
            $table->integer('orden_placa')->unsigned(); 
            $table->integer('orden_tipoorden')->unsigned();
            $table->integer('orden_solicitante')->unsigned();
            //contadores deben ser foraneos  
            $table->integer('orden_contador_general')->unsigned();
            $table->integer('orden_contador1')->unsigned();
            $table->integer('orden_contador2')->unsigned();
            $table->integer('orden_contador3')->unsigned();
            $table->integer('orden_contador4')->unsigned();
            $table->integer('orden_contador5')->unsigned();
            $table->string('orden_persona',100);
            $table->integer('orden_dano')->unsigned();
            $table->integer('orden_prioridad')->unsigned();
            $table->text('orden_problema');
            $table->boolean('orden_abierta');

            $table->foreign('orden_placa')->references('id')->on('producto')->onDelete('restrict');
            $table->foreign('orden_tipoorden')->references('id')->on('tipoorden')->onDelete('restrict');
            $table->foreign('orden_solicitante')->references('id')->on('solicitante')->onDelete('restrict');
            $table->foreign('orden_tercero')->references('id')->on('tercero')->onDelete('restrict');
            $table->foreign('orden_dano')->references('id')->on('dano')->onDelete('restrict');
            $table->foreign('orden_prioridad')->references('id')->on('prioridad')->onDelete('restrict');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden');
    }
}
