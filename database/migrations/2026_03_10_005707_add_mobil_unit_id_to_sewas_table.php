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
        // Menambahkan kolom mobil_unit_id setelah kolom mobil_id
        $table->unsignedBigInteger('mobil_unit_id')->nullable()->after('mobil_id');
        
        // Opsional: Jika ingin membuat foreign key (agar data lebih aman/konsisten)
        $table->foreign('mobil_unit_id')->references('id')->on('mobil_units')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('sewas', function (Blueprint $table) {
        $table->dropForeign(['mobil_unit_id']);
        $table->dropColumn('mobil_unit_id');
    });
}
};
