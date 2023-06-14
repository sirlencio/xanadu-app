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
        Schema::create('serie-elenco', function (Blueprint $table) {
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_serie');
            $table->unsignedBigInteger('id_rol');

            $table->foreign('id_persona')->references('id')->on('personas');
            $table->foreign('id_serie')->references('id')->on('series');
            $table->foreign('id_rol')->references('id')->on('roles');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serie-elenco');
    }
};
