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
    Schema::table('sewas', function (Blueprint $table) {
        // Menyimpan kondisi (baik/rusak)
        $table->string('kondisi')->nullable()->after('status'); 
        // Menyimpan catatan user
        $table->text('laporan')->nullable()->after('kondisi');
        // Jam/Tanggal mobil benar-benar balik
        $table->timestamp('tgl_kembali_aktual')->nullable()->after('laporan');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewas', function (Blueprint $table) {
            //
        });
    }
};
