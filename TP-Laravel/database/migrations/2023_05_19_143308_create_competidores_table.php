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
            $table->string('graduacion');
            $table->string('email');
            $table->string('genero');
            $table->unsignedBigInteger('idEstado');
            $table->unsignedBigInteger('idPais');
            $table->timestamps();

            $table->foreign('idEstado')->references('idEstado')->on('estados');
            $table->foreign('idPais')->references('idPais')->on('paises');
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
        });
        Schema::dropIfExists('competidores');
    }
};