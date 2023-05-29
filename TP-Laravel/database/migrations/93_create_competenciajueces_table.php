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
        Schema::create('competenciajueces', function (Blueprint $table) {
            $table->id('idCompetenciaJuez');
            $table->unsignedBigInteger('idCompetencia');
            $table->tinyInteger('estado');
            $table->unsignedBigInteger('idJuez');
            $table->timestamps();

            $table->foreign('idCompetencia')->references('idCompetencia')->on('competencias');
            $table->foreign('idJuez')->references('id')->on('users');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['idJuez']);
        });
        Schema::dropIfExists('competenciajueces');
    }
};
