<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoMarcaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productomarca', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('productomarca_producto')->unsigned();
            $table->integer('productomarca_marca')->unsigned();

            $table->foreign('productomarca_producto')->references('id')->on('producto')->onDelete('restrict');
            $table->foreign('productomarca_marca')->references('id')->on('marca')->onDelete('restrict');
            $table->unique(['productomarca_producto', 'productomarca_marca']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productomarca');
    }
}
