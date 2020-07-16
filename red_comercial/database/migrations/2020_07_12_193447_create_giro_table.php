<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_giro', 50);
            $table->string('descripcion_giro', 200);
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });

        DB::table('giro')->insert(array('id'=>'1','nombre_giro'=>'Industrial','descripcion_giro'=>'Fabricación de bienes o productos en general.'));
        DB::table('giro')->insert(array('id'=>'2','nombre_giro'=>'Comercial','descripcion_giro'=>'Facilitar que los clientes puedan acceder a los productos sin importar el lugar donde estos hayan sido fabricados por minoria o mayoreo.'));
        DB::table('giro')->insert(array('id'=>'3','nombre_giro'=>'Servicios','descripcion_giro'=>'Ofrecer al público en general un servicio privado o público, ya sea Transporte, Educación, Salubridad, Finanzas, Técnicos, Diseño, Tecnología, etc.'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giro');
    }
}
