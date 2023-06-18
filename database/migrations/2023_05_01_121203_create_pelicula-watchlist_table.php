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
        Schema::create('pelicula-watchlist', function (Blueprint $table) {
            $table->unsignedBigInteger('id_watchlist');
            $table->unsignedBigInteger('id_pelicula');

            $table->foreign('id_watchlist')->references('id')->on('watchlists')->onDelete('cascade');            
            $table->foreign('id_pelicula')->references('id')->on('peliculas')->onDelete('cascade');            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelicula-favorita');
    }
};
