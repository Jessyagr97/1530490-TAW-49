<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('idrol');
            $table->foreign('idrol')->references('id')->on('tipousuario')->onDelete('cascade');

            $table->string('nombre');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('condicion')->default(1);
            $table->rememberToken();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}