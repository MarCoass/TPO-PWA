<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id('idSolicitud');
            $table->integer('estadoSolicitud');
            $table->string('tipo');
            $table->integer('dato');
            $table->unsignedBigInteger('idUser');
            $table->timestamps();


            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['idUser']);
        });
        Schema::dropIfExists('solicitudes');
    }
};
