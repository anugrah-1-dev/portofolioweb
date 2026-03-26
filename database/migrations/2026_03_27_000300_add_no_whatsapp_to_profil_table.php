<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->string('no_whatsapp')->nullable()->after('kata_penyemangat');
        });
    }

    public function down(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->dropColumn('no_whatsapp');
        });
    }
};
