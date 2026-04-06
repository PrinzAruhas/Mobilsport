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
    Schema::create('sewas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('mobil_id')->constrained()->onDelete('cascade');
        $table->date('tgl_mulai');
        $table->date('tgl_selesai');
        $table->integer('total_harga');
        $table->string('metode_pembayaran');
        $table->string('foto_ktp');
        $table->string('foto_sim');
        $table->string('struk_pembayaran')->nullable();
        $table->enum('status', ['menunggu_verifikasi', 'disetujui', 'aktif', 'selesai', 'ditolak', 'kembali'])
              ->default('menunggu_verifikasi');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewas');
    }
};
