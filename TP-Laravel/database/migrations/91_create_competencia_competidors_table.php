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
        Schema::create('competenciaCompetidor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCompetidor');
            $table->unsignedBigInteger('idCompetencia');
            $table->unsignedBigInteger('idPoomsae');
            $table->decimal('puntaje');
            $table->int('contadorPasadas');
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
