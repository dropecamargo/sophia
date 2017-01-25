<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratodanoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratodano', function(Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->integer('contratodano_contrato')->unsigned()->unique();
            $table->integer('contratodano_dano')->unsigned()->unique();
            $table->integer('contratodano_tiempo')->unsigned();

            $table->foreign('contratodano_contrato')->references('id')->on('contrato')->onDelete('restrict');
            $table->foreign('contratodano_dano')->references('id')->on('dano')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('contratodano');
    }
}
