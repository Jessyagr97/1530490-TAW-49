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
            $table->foreign('idrol')->references('id')->on('roles')->onDelete('cascade');

            $table->unsignedBigInteger('idsociedad');
            $table->foreign('idsociedad')->references('id')->on('sociedades')->onDelete('cascade');

            $table->string('nombre');
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('image_profile')->nullable();
            $table->boolean('condicion')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        /*CREAR DIRECTORIO DE USUARIO*/
        $path = 'public/Jessica/img/';
        Storage::makeDirectory($path);
        $path = 'public/Jessica/docs/';
        Storage::makeDirectory($path);
        /*==============================*/

        DB::insert('insert into users (id, idrol, idsociedad, nombre, usuario, password, image_profile, condicion) values (?, ?, ?, ?, ?, ?, ?, ?)', [1, '1', '1', 'Jessica Aguirre' ,'Jessica', '$2y$10$qdAJGqB6DS5oZrtbOUxKpOzCzBXVauGEGX2kxElkjwFjr3RjAuhB2', '/storage/1530490@upv.edu.mx/img/avatar-1.png', '1']);
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
