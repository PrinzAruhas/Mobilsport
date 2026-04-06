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
    Schema::table('mobils', function (Blueprint $table) {
        $table->integer('kapasitas')->nullable()->after('model'); // Contoh: 5 atau 7
        $table->string('transmisi')->nullable()->after('kapasitas'); // Contoh: Manual atau Matic
        $table->string('bahan_bakarnya')->nullable()->after('transmisi'); // Contoh: Bensin atau Diesel
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            //
        });
    }
};
