<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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
            $table->string('image_profile')->nullable();
            $table->boolean('condicion')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        /*CREAR DIRECTORIO DE USUARIO*/
        $path = 'public/1530490@upv.edu.mx/img/';
        Storage::makeDirectory($path);
        $path = 'public/pepelepew@correo.com/img/';
        Storage::makeDirectory($path);
        
        $path = 'public/1530490@upv.edu.mx/docs/';
        Storage::makeDirectory($path);
        $path = 'public/pepelepew@correo.com/docs/';
        Storage::makeDirectory($path);
        /*==============================*/

        DB::insert('insert into users (id, idrol, nombre, apellido_p, apellido_m, telefono, email, password, image_profile, condicion) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [1, '1', 'Jessica Anahí' ,'Aguirre', 'Rosales', '4494516887','1530490@upv.edu.mx','$2y$10$qdAJGqB6DS5oZrtbOUxKpOzCzBXVauGEGX2kxElkjwFjr3RjAuhB2', '/storage/1530490@upv.edu.mx/img/avatar-1.png', '1']);
        DB::insert('insert into users (id, idrol, nombre, apellido_p, apellido_m, telefono, email, password, image_profile, condicion) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [2, '2', 'Pepe' ,'Le', 'Pew', '1234567890','pepelepew@correo.com','$2y$10$7x049T8xvuji01kpqapqDeXZNJV0ykkRLXfidanwhwqZGlCHE3PYG', '/storage/pepelepew@correo.com/img/avatar-1.png', '1']);
    
        
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
