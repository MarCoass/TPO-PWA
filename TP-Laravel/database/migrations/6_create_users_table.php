<?php
/* 

SE CREO LA TABLA CON EL NOMBRE USER PARA QUE SEA MAS 
COMPRENSIBLE PARA AUTH DE LARAVEL JUNTO
CON EL CAMPO PASSWORD COMO CONTRASEÑA

*/
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
        Schema::create('users', function (Blueprint $table) {
            /* A ID LO DEJE SIN NOMBRAR PARA NO GENERAR CONFLICTOS CON SU CONFIGURACION YA ESTABLECIDA */
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('correo')->unique();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->unsignedBigInteger('idRol')->nullable();
            $table->boolean('estado')->default(false);
            /* $table->unsignedBigInteger('idRol'); */
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('idRol')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['idRol']);
        });
        Schema::dropIfExists('users');
    }
};
