<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengalaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_organisasi');
            $table->string('peran');
            $table->text('deskripsi')->nullable();
            $table->string('tahun_mulai', 20);
            $table->string('tahun_selesai', 20)->nullable();
            $table->string('jenis', 50)->default('organisasi');
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengalaman');
    }
};
