<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projek_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projek_id');
            $table->string('nama');
            $table->string('email');
            $table->unsignedBigInteger('harga');
            $table->string('token', 64)->unique();
            $table->string('invoice_id')->nullable();
            $table->text('invoice_url')->nullable();
            $table->string('status', 20)->default('pending'); // pending, paid, expired
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('projek_id')->references('id')->on('projek')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projek_orders');
    }
};
