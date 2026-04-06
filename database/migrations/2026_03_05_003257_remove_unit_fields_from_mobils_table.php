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
        $table->dropColumn(['no_polisi', 'status']);
    });
}

public function down(): void
{
    Schema::table('mobils', function (Blueprint $table) {
        $table->string('no_polisi')->unique();
        $table->string('status')->default('tersedia');
    });
}
};
