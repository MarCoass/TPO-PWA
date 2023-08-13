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
        Schema::create('reloj', function (Blueprint $table) {
            $table->id('idReloj');
            $table->unsignedBigInteger('idCompetencia');
            $table->unsignedBigInteger('idCategoria');
            $table->unsignedBigInteger('idCompetenciaCompetidor');
            $table->integer('cantJueces');
            $table->integer('overtime');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('idCompetencia')->references('idCompetencia')->on('competencias');
            $table->foreign('idCategoria')->references('idCategoria')->on('categorias');
            $table->foreign('idCompetenciaCompetidor')->references('idCompetenciaCompetidor')->on('competenciacompetidor');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competencias', function (Blueprint $table) {
            $table->dropForeign(['idCompetencia']);
        });
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['idCategoria']);
        });
        Schema::dropIfExists('reloj');
    }
};
