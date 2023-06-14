<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelicula-elenco', function (Blueprint $table) {
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_pelicula');
            $table->unsignedBigInteger('id_rol');

            $table->foreign('id_persona')->references('id')->on('personas');
            $table->foreign('id_pelicula')->references('id')->on('peliculas');
            $table->foreign('id_rol')->references('id')->on('roles');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelicula-elenco');
    }
};
