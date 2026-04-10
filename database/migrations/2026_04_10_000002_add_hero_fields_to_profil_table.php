<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->string('hero_role1')->nullable()->default('Full-Stack Developer')->after('foto2');
            $table->string('hero_role2')->nullable()->default('IT Student')->after('hero_role1');
            $table->string('hero_status')->nullable()->default('Available for work')->after('hero_role2');
        });
    }

    public function down(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->dropColumn(['hero_role1', 'hero_role2', 'hero_status']);
        });
    }
};
