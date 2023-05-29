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
        Schema::create('competidores', function (Blueprint $table) {
            $table->id('idCompetidor');
            $table->string('gal')->unique();
            $table->string('apellido');
            $table->string('nombre');
            $table->integer('du')->unique();
            $table->date('fechaNacimiento');
            $table->float('ranking');
            $table->unsignedBigInteger('idGraduacion');
            $table->string('email');
            $table->string('genero');
            $table->unsignedBigInteger('idEstado')->nullable();
            $table->unsignedBigInteger('idPais');
            $table->unsignedBigInteger('idUser');
            $table->boolean('estado');
            $table->timestamps();

            $table->foreign('idGraduacion')->references('idGraduacion')->on('graduaciones');
            $table->foreign('idEstado')->references('idEstado')->on('estados');
            $table->foreign('idPais')->references('idPais')->on('paises');
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
        Schema::table('competidores', function (Blueprint $table) {
            $table->dropForeign(['idEstado']);
            $table->dropForeign(['idPais']);
            $table->dropForeign(['idUser']);
        });
        Schema::dropIfExists('competidores');
    }
};
