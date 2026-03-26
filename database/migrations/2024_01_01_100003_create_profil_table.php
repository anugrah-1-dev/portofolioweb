<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->default('Anugrah');
            $table->text('bio1')->nullable();
            $table->text('bio2')->nullable();
            $table->string('status')->default('Tersedia');
            $table->string('lokasi')->default('Indonesia');
            $table->string('bahasa')->default('ID / EN');
            $table->json('keahlian')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil');
    }
};
