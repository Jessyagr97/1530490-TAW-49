<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('idsociedad');
            $table->foreign('idsociedad')->references('id')->on('sociedades')->onDelete('cascade');

            $table->unsignedBigInteger('idfactura');
            $table->foreign('idfactura')->references('id')->on('facturas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
