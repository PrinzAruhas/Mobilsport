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
    Schema::create('laporan_admins', function (Blueprint $table) {
        $table->id();
        $table->string('topik');
        $table->text('pesan');
        $table->boolean('is_urgent')->default(false);
        $table->text('balasan_admin')->nullable(); // Kolom buat admin bales
        $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_admins');
    }
};
