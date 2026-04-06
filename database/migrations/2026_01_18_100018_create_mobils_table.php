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
    Schema::create('mobils', function (Blueprint $table) {
        $table->id();
        $table->string('merek');
        $table->string('model');
        $table->string('no_polisi')->unique();
        $table->integer('harga_sewa');
        $table->text('deskripsi')->nullable();
        $table->string('gambar');
  $table->enum('status', ['tersedia', 'tidak tersedia', 'disewa', 'servis', 'disetujui', 'rusak', 'perbaikan'])->default('tersedia');
        
        // Relasi ke kategori
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
