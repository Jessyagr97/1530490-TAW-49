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
            $table->timestamps();
        });

        DB::insert('insert into users (id, idrol, nombre, apellido_p, apellido_m, telefono, email, password, condicion) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [1, '1', 'Jessica Anahí' ,'Duque', 'Hernandez', '4494516887','1530490@upv.edu.mx','$2y$10$qdAJGqB6DS5oZrtbOUxKpOzCzBXVauGEGX2kxElkjwFjr3RjAuhB2','1']);
        DB::insert('insert into users (id, idrol, nombre, apellido_p, apellido_m, telefono, email, password, condicion) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [2, '2', 'Pepe' ,'Le', 'Pew', '1234567890','pepelepew@correo.com','$2y$10$7x049T8xvuji01kpqapqDeXZNJV0ykkRLXfidanwhwqZGlCHE3PYG','1']);
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
