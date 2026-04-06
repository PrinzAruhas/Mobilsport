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
    Schema::table('mobils', function (Blueprint $table) {
        // Tambahkan kolom status jika sebelumnya belum ada/error
        if (!Schema::hasColumn('mobils', 'status')) {
            $table->enum('status', ['tersedia', 'tidak tersedia', 'disewa', 'servis', 'disetujui', 'rusak', 'perbaikan'])->default('tersedia')->after('harga_sewa');
        }

        // Tambahkan kolom warna untuk pilihan dinamis
        if (!Schema::hasColumn('mobils', 'warna')) {
            $table->string('warna')->nullable()->after('harga_sewa');
        }

        // Tambahkan kolom video untuk fitur video review
        if (!Schema::hasColumn('mobils', 'video')) {
            $table->string('video')->nullable()->after('gambar');
        }
    });
}

public function down(): void
{
    Schema::table('mobils', function (Blueprint $table) {
        $table->dropColumn(['status', 'warna', 'video']);
    });
}
};
