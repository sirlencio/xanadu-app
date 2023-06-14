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
        Schema::create('serie-watchlist', function (Blueprint $table) {
            $table->unsignedBigInteger('id_watchlist');
            $table->unsignedBigInteger('id_serie');

            $table->foreign('id_watchlist')->references('id')->on('watchlists');
            $table->foreign('id_serie')->references('id')->on('series');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serie-favorita');
    }
};
