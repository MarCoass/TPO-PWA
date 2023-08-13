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
        Schema::create('relojcompjuez', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idReloj');
            $table->unsignedBigInteger('idCompetenciaJuez');
            $table->timestamps();
     
            $table->foreign('idReloj')->references('idReloj')->on('reloj');
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
        Schema::table('relojcompjuez', function (Blueprint $table) {
            $table->dropForeign(['idReloj']);
            $table->dropForeign(['idCompetenciaJuez']);
        });
        Schema::dropIfExists('relojcompjuez');
    }
};
