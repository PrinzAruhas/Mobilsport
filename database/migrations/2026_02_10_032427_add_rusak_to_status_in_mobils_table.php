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
        // Tambahkan 'rusak' ke dalam list enum
        $table->enum('status', ['tersedia', 'disewa', 'servis', 'rusak'])->default('tersedia')->change();
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
