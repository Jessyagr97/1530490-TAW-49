<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarteraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartera', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('iduser');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');

            $table->float('dinero', 8,2);
            $table->timestamps();
        });

        DB::insert('insert into cartera(id, iduser, dinero) values (?, ?, ?)',[1, '1', '0']);
        DB::insert('insert into cartera(id, iduser, dinero) values (?, ?, ?)',[2, '2', '0']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartera');
    }
}
