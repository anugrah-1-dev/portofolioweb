<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('keahlian');
            $table->json('kata_penyemangat')->nullable()->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->dropColumn(['foto', 'kata_penyemangat']);
        });
    }
};
