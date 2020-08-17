<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rol', 50);
            $table->string('descripcion', 150);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });

        DB::table('roles')->insert(array('id'=>'1','rol'=>'Administrador','descripcion'=>'Administradores generales.'));
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
