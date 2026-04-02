<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hki', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pencatatan')->nullable();
            $table->string('title');
            $table->string('authors');
            $table->string('jenis_hki')->default('Hak Cipta');
            $table->string('year', 4);
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hki');
    }
};
