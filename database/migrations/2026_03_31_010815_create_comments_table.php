<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // User yang buat komentar (Role 3)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Mobil mana yang dikomentari
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');
            
            // Kalau ini balasan, dia merujuk ke ID komentar utama
            $table->unsignedBigInteger('parent_id')->nullable();
            
            $table->text('isi_komentar');
            $table->timestamps();

            // Indexing untuk performa saat load balasan
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};