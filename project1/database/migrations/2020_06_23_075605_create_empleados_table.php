<?php
//librerias que necesita el esquema de creacion de la tabla
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('nombres',50);
            $table -> string('apellidos',50);
            $table -> integer('cedula',30);
            $table -> string('email',50)->unique();
            $table -> string('lugar_nacimiento',30);
            $table -> enum('sexo',['masculino','femenino','no definido']);
            $table -> enum('estado_civil',['soltero','casado']);
            $table -> integer('telefono',15);
            $table -> string('departamento');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
