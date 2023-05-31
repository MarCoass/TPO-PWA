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
            $table->boolean('estado');
            $table->timestamps();

            $table->foreign('idCompetidor')->references('idCompetidor')->on('competidores');
            $table->foreign('idCompetencia')->references('idCompetencia')->on('competencias');
            $table->foreign('idCategoria')->references('idCategoria')->on('categrias');

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
        Schema::table('categrias', function (Blueprint $table) {
            $table->dropForeign(['idCategoria']);
        });
        Schema::dropIfExists('competenciacompetidor');
    }
};
