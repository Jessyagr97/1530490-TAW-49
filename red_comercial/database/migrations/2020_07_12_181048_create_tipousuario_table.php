<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipousuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipousuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rol', 50);
            $table->string('descripcion', 150);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });

        DB::table('tipousuario')->insert(array('id'=>'1','rol'=>'Administrador','descripcion'=>'Administradores generales.'));
        DB::table('tipousuario')->insert(array('id'=>'2','rol'=>'Vendedor','descripcion'=>'Ofresco servicios o productos al público en general.'));
        DB::table('tipousuario')->insert(array('id'=>'3','rol'=>'Cliente','descripcion'=>'Estoy buscando servicios, productos o cualquier articulo de valor.'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipousuario');
    }
}
