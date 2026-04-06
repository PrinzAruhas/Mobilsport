<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mobil_units', function (Blueprint $table) {
            // Menambahkan kolom foto_unit setelah kolom warna
            $table->string('foto_unit')->nullable()->after('warna');
        });
    }

    public function down(): void
    {
        Schema::table('mobil_units', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn('foto_unit');
        });
    }
};