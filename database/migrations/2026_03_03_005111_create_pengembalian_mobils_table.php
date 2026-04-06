<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('pengembalian_mobils', function (Blueprint $table) {
        $table->id();
        $table->foreignId('sewa_id')->constrained('sewas')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('mobil_id')->constrained('mobils');
        $table->string('bukti_kartu'); // Nama file foto kartu digital
        $table->enum('kondisi', ['baik', 'rusak']);
        $table->text('laporan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_mobils');
    }
};
