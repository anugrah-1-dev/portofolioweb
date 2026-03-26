<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->default('📄');
            $table->string('title');
            $table->string('authors');
            $table->string('journal_name');
            $table->string('year', 4);
            $table->string('indexed_by')->default('Sinta'); // Sinta, Scopus, IEEE, dll
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
