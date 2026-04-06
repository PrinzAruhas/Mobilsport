<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAdmin extends Model
{
    use HasFactory;

    // Tambahkan 'user_id' agar bisa diisi saat create laporan
    protected $fillable = [
        'user_id', 
        'topik', 
        'pesan', 
        'is_urgent', 
        'balasan_admin', 
        'status'
    ];

    /**
     * Relasi ke model User
     * Menghubungkan laporan dengan staf/kru yang mengirim
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}