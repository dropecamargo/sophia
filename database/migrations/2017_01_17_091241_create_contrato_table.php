<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato', function (Blueprint $table){
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->string('contratoo_numero',10);
            $table->integer('contrato_tercero')->unsigned();
            $table->date('contrato_fecha');
            $table->date('contrato_vencimiento');
            $table->boolean('contrato_activo')->default(false);
            $table->text('contrato_condiciones');

            $table->foreign('contrato_tercero')->references('id')->on('tercero')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrato');
    }
}
