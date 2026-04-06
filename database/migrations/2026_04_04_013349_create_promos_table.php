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
        Schema::create('promos', function (Blueprint $table) {
    $table->id();
    $table->string('code')->unique(); // Contoh: PROMOICE2026
    $table->integer('discount_percent'); 
    $table->enum('type', ['all', 'category', 'unit']); // Jenis promo
    $table->unsignedBigInteger('target_id')->nullable(); // ID Kategori atau ID Mobil
    $table->date('expired_at');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
