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
    // Gunakan hasColumn untuk pengecekan aman
    if (!Schema::hasColumn('mobils', 'no_polisi')) {
        Schema::table('mobils', function (Blueprint $table) {
            $table->string('no_polisi')->nullable()->after('model');
        });
    }
}

public function down()
{
    Schema::table('mobils', function (Blueprint $table) {
        $table->dropColumn('no_polisi');
    });
}
};
