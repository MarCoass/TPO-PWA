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
        Schema::create('categrias', function (Blueprint $table) {
            $table->id('idCategoria');
            $table->string('nombre');
            $table->integer('edadMax');
            $table->integer('edadMin');
            $table->integer('genero');
            $table->integer('esElite');
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
        Schema::dropIfExists('categrias');
    }
};
