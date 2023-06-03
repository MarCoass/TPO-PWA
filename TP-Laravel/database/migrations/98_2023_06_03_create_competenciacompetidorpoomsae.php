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
        Schema::create('competenciacompetidorpoomsae', function (Blueprint $table) {
            $table->id('idCompetenciaCompetidorPoomsae');
            $table->unsignedBigInteger('idCompetenciaCompetidor');
            $table->unsignedBigInteger('idPoomsae');
            $table->integer('pasadas');
            $table->timestamps();

            $table->foreign('idCompetenciaCompetidor')->references('idCompetenciaCompetidor')->on('competenciacompetidor');
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
        Schema::table('competenciacompetidor', function (Blueprint $table) {
            $table->dropForeign(['idCompetenciaCompetidor']);
        });
        Schema::table('poomsae', function (Blueprint $table) {
            $table->dropForeign(['idPoomsae']);
        });
        Schema::dropIfExists('competenciacompetidorpoomsae');
    }
};
