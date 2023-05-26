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
            $table->string('estado');
            $table->timestamps();

            $table->foreign('idCompetidor')->references('idCompetidor')->on('competidores');
            $table->foreign('idCompetencia')->references('idCompetencia')->on('competencias');

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
        Schema::dropIfExists('competencia_competidors');
    }
};
