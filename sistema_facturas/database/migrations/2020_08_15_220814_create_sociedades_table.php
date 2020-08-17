<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sociedades', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('rfc_emisor');
            $table->string('contacto');
            $table->string('email');
            $table->timestamps();
        });

        DB::insert('insert into sociedades (id, nombre, direccion, rfc_emisor, contacto, email) values (?, ?, ?, ?, ?, ?)', [1, 'Plantas Jessica Inc.', 'Cd. Victoria', 'CUPU800825569' ,'5698741230', 'hola@plantas-jessica.mx']);
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sociedades');
    }
}
