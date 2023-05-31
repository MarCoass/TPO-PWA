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
        Schema::create('categoriaPoomsae', function (Blueprint $table) {
            $table->id('idCategoriaPoomsae');
            $table->unsignedBigInteger('idCategoria');
            $table->unsignedBigInteger('idPoomsae');
            $table->timestamps();

            $table->foreign('idCategoria')->references('idCategoria')->on('categorias');
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
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropForeign(['idCategoria']);
        });
        Schema::table('poomsae', function (Blueprint $table) {
            $table->dropForeign(['idPoomsae']);
        });

        Schema::dropIfExists('categoriaPoomsae');
    }
};
