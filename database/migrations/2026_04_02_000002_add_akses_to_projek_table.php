<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projek', function (Blueprint $table) {
            $table->string('tipe_akses', 20)->default('gratis')->after('github_url');
            $table->unsignedBigInteger('harga')->nullable()->after('tipe_akses');
        });
    }

    public function down(): void
    {
        Schema::table('projek', function (Blueprint $table) {
            $table->dropColumn(['tipe_akses', 'harga']);
        });
    }
};
