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
        Schema::create('pelicula-genero', function (Blueprint $table) {
            $table->unsignedBigInteger('id_genero');
            $table->unsignedBigInteger('id_pelicula');

            $table->foreign('id_genero')->references('id')->on('generos');
            $table->foreign('id_pelicula')->references('id')->on('peliculas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelicula-_generos');
    }
};
