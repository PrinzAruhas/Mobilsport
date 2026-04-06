<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengembalian_mobils', function (Blueprint $table) {
            // Menambahkan total_bayar untuk mencatat nominal utama
            $table->decimal('total_bayar', 15, 2)->default(0)->after('laporan');
        });
    }

    public function down(): void
    {
        Schema::table('pengembalian_mobils', function (Blueprint $table) {
            $table->dropColumn('total_bayar');
        });
    }
};