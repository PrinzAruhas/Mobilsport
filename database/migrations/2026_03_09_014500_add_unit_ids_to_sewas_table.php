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
        // Tambahkan kolom unit_ids (menggunakan string untuk menyimpan list ID)
        $table->string('unit_ids')->after('mobil_id')->nullable();
    });
}

public function down()
{
    Schema::table('sewas', function (Blueprint $table) {
        $table->dropColumn('unit_ids');
    });
}
};
