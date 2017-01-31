<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacion1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion1', function (Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->dateTime('asignacion1_fecha');
            $table->dateTime('asignacion1_fh_elaboro');
           
            $table->string('asignacion1_tipo', 1);    
            $table->string('asignacion1_direccion', 100);
            $table->string('asignacion1_area', 30);
            $table->string('asignacion1_centrocosto', 30);

            $table->integer('asignacion1_tercero')->unsigned()->nullable();
            $table->integer('asignacion1_municipio')->unsigned()->nullable();
            $table->integer('asignacion1_contrato')->unsigned()->nullable();
            $table->integer('asignacion1_zona')->unsigned()->nullable();
            $table->integer('asignacion1_tecnico')->unsigned()->nullable();
            $table->integer('asignacion1_contacto')->unsigned()->nullable();
            $table->integer('asignacion1_usuario_elaboro')->unsigned();

            $table->foreign('asignacion1_tercero')->references('id')->on('tercero')->onDelete('restrict');
            $table->foreign('asignacion1_municipio')->references('id')->on('municipio')->onDelete('restrict');
            $table->foreign('asignacion1_contrato')->references('id')->on('contrato')->onDelete('restrict');
            $table->foreign('asignacion1_zona')->references('id')->on('zona')->onDelete('restrict');
            $table->foreign('asignacion1_tecnico')->references('id')->on('tercero')->onDelete('restrict');
            $table->foreign('asignacion1_contacto')->references('id')->on('tcontacto')->onDelete('restrict');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExisits('asignacion1');
    }
}
