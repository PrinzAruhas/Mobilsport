<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobil_units', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel mobils
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');
            
            $table->string('no_polisi')->unique();
            $table->string('warna')->nullable(); // Tambahan biar makin detail buat sport car
            
            // Pindahkan status ke sini (per unit)
            $table->enum('status', ['tersedia', 'disewa', 'servis', 'rusak'])->default('tersedia');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobil_units');
    }
};