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
        Schema::create('rolpermiso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idRol');
            $table->unsignedBigInteger('idPermiso');
            $table->timestamps();
     
            $table->foreign('idRol')->references('id')->on('roles');
            $table->foreign('idPermiso')->references('idPermiso')->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rolpermiso', function (Blueprint $table) {
            $table->dropForeign(['idRol']);
            $table->dropForeign(['idPermiso']);
        });
        Schema::dropIfExists('rolpermiso');
    }
};
