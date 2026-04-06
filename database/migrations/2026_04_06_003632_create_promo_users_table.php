<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('promo_users', function (Blueprint $table) {
        $table->id();
        // Foreign key ke tabel promos
        $table->foreignId('promo_id')->constrained('promos')->onDelete('cascade');
        // Foreign key ke tabel users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_users');
    }
};
