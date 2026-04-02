<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hki', function (Blueprint $table) {
            $table->string('sertifikat_file')->nullable()->after('url');
        });
    }

    public function down(): void
    {
        Schema::table('hki', function (Blueprint $table) {
            $table->dropColumn('sertifikat_file');
        });
    }
};
