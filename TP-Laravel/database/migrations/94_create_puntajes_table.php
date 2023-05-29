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
        Schema::create('puntajes', function (Blueprint $table) {
            $table->id('idPuntaje');
            $table->unsignedBigInteger('idCompetenciaCompetidor');
            $table->unsignedBigInteger('idCompetenciaJuez');
            $table->float('puntajePresentacion');
            $table->float('puntajeExactitud');
            $table->integer('pasada');
            $table->time('overtime');
            $table->timestamps();

            $table->foreign('idCompetenciaCompetidor')->references('idCompetenciaCompetidor')->on('competenciacompetidor');
            $table->foreign('idCompetenciaJuez')->references('idCompetenciaJuez')->on('competenciajueces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competenciacompetidor', function (Blueprint $table) {
            $table->dropForeign(['idCompetenciaCompetidor']);
        });
        Schema::table('competenciaJueces', function (Blueprint $table) {
            $table->dropForeign(['idCompetenciaJuez']);
        });
        Schema::dropIfExists('puntajes');
    }
};
