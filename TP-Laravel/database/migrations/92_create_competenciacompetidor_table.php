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
        Schema::create('competenciacompetidor', function (Blueprint $table) {
            $table->id('idCompetenciaCompetidor');
            $table->unsignedBigInteger('idCompetidor');
            $table->unsignedBigInteger('idCompetencia');
            $table->unsignedBigInteger('idCategoria');
            $table->float('puntaje');
            $table->integer('contadorPasadas');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('idCompetidor')->references('idCompetidor')->on('competidores');
            $table->foreign('idCompetencia')->references('idCompetencia')->on('competencias');
            $table->foreign('idCategoria')->references('idCategoria')->on('categorias');

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
            $table->dropForeign(['idCompetidor']);
        });
        Schema::table('competencias', function (Blueprint $table) {
            $table->dropForeign(['idCompetencia']);
        });
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['idCategoria']);
        });
        Schema::dropIfExists('competenciacompetidor');
    }
};
