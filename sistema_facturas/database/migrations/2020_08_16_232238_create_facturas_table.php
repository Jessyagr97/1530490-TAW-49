<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idsociedad');
            $table->foreign('idsociedad')->references('id')->on('sociedades')->onDelete('cascade');

            $table->string('razon');
            $table->string('rfc_receptor');
            $table->string('folio');
            $table->string('doc_pdf');
            $table->string('doc_xml')->nullable();
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
        Schema::dropIfExists('facturas');
    }
}
