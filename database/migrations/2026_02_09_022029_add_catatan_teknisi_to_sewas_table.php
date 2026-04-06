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
    Schema::table('sewas', function (Blueprint $table) {
        // Tambahkan kolom catatan_teknisi setelah kolom status
        $table->text('catatan_teknisi')->nullable()->after('status');
    });
}

public function down(): void
{
    Schema::table('sewas', function (Blueprint $table) {
        $table->dropColumn('catatan_teknisi');
    });
}
};
