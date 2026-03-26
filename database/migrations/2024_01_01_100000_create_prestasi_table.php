<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->default('🏆');
            $table->string('year', 4);
            $table->string('title');
            $table->text('description');
            $table->string('badge')->default('Prestasi');
            $table->enum('kategori', ['akademik', 'non_akademik'])->default('akademik');
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
