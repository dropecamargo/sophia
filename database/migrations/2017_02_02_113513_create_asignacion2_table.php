<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacion2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion2', function (Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->integer('asignacion2_asignacion1')->unsigned()->nullable();
            $table->integer('asignacion2_producto')->unsigned()->nullable();
            $table->integer('asignacion2_deproducto')->unsigned()->nullable();
            
            $table->foreign('asignacion2_asignacion1')->references('id')->on('asignacion1')->onDelete('restrict');
            $table->foreign('asignacion2_producto')->references('id')->on('producto')->onDelete('restrict');
            $table->foreign('asignacion2_deproducto')->references('id')->on('producto')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion2');
    }
}
