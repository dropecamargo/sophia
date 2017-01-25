<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSirveaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sirvea', function (Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->integer('sirvea_maquina')->unsigned()->nullable();
            $table->integer('sirvea_codigo')->unsigned()->nullable();

            $table->foreign('sirvea_maquina')->references('id')->on('producto')->onDelete('restrict');
            $table->foreign('sirvea_codigo')->references('id')->on('producto')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sirvea');
    }
}
