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
        Schema::create('competencias', function (Blueprint $table) {
            $table->id('idCompetencia');
            $table->string('nombre');
            $table->date('fecha');
            $table->string('flyer')->nullable();
            $table->string('bases')->nullable();
            $table->string('invitacion')->nullable();
            $table->integer('cantidadJueces');
            $table->boolean('estadoJueces')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competencias');
    }
};
