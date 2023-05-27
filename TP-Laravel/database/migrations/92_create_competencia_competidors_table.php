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
        Schema::create('competencia_competidors', function (Blueprint $table) {
            $table->id('idCompetenciaCompetidor');
            $table->unsignedBigInteger('idCompetidor');
            $table->unsignedBigInteger('idCompetencia');
            $table->unsignedBigInteger('idPoomsae');
            $table->float('puntaje');
            $table->integer('contadorPasadas');
            $table->string('estado');
            $table->timestamps();

            $table->foreign('idCompetidor')->references('idCompetidor')->on('competidores');
            $table->foreign('idCompetencia')->references('idCompetencia')->on('competencias');
            $table->foreign('idPoomsae')->references('idPoomsae')->on('poomsae');

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
        Schema::table('poomsae', function (Blueprint $table) {
            $table->dropForeign(['idPoomsae']);
        });
        Schema::dropIfExists('competencia_competidors');
    }
};
