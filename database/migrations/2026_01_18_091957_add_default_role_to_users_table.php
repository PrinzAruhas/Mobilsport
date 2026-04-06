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
    Schema::table('users', function (Blueprint $table) {
        // 1. Hapus foreign key-nya dulu
        $table->dropForeign(['role_id']); 

        // 2. Ubah kolomnya (tambahkan default 4)
        $table->unsignedBigInteger('role_id')->default(4)->change();

        // 3. Pasang kembali foreign key-nya
        $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
