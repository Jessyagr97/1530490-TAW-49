<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_empresa');
            $table->string('descripcion_empresa');
            $table->string('telefono_empresa');
            $table->string('email_empresa')->unique();
            $table->string('longitud');
            $table->string('latitud');

            $table->unsignedBigInteger('idgiro');
            $table->foreign('idgiro')->references('id')->on('giro')->onDelete('cascade');

            $table->unsignedBigInteger('iduser');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');

            $table->string('imagen_empresa');

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
        Schema::dropIfExists('empresas');
    }
}
