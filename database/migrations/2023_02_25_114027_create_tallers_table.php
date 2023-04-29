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
        Schema::create('tallers', function (Blueprint $table) {
            $table->id();
            $table->string("taller");
            $table->string("responsable");
            $table->string("ajudant")->nullable();
            $table->string("descripcio")->nullable();
            $table->string("adrecatA");
            $table->integer("nAlumnes");
            $table->string("material")->nullable();
            $table->string("aula")->nullable();
            $table->string("observacions")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tallers');
    }
};
