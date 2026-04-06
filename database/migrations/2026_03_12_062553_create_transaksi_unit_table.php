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
    Schema::create('transaksi_unit', function (Blueprint $table) {
        $table->id();
        $table->foreignId('transaksi_id')->constrained('sewas'); // Sesuaikan nama tabel referensi
        $table->foreignId('unit_id')->constrained('mobil_units');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_unit');
    }
};
