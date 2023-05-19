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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('usuario')->unique();
            $table->string('correo')->unique();
            $table->string('clave');
            $table->unsignedBigInteger('idRol');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('idRol')->references('idRol')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['idRol']);
        });
        Schema::dropIfExists('usuarios');
    }
};
