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
        Schema::create('categoriaGraduacion', function (Blueprint $table) {
            $table->id('idCategoriaGraduacion');
            $table->unsignedBigInteger('idCategoria');
            $table->unsignedBigInteger('idGraduacion');
            $table->timestamps();

            $table->foreign('idCategoria')->references('idCategoria')->on('categorias');
            $table->foreign('idGraduacion')->references('idGraduacion')->on('graduaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['idCategoria']);
        });
        Schema::table('graduaciones', function (Blueprint $table) {
            $table->dropForeign(['idGraduacion']);
        });

        Schema::dropIfExists('categoriaGraduacion');
    }
};
