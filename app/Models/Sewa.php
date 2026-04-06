<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Mobil;
use App\Models\MobilUnit;

class Sewa extends Model
{
    use HasFactory;

    protected $table = 'sewas';

    protected $fillable = [
        'user_id', 
        'mobil_id', 
        'unit_ids', 
        'tgl_mulai', 
        'tgl_selesai', 
        'total_harga', 
        'metode_pembayaran', 
        'foto_ktp', 
        'foto_sim', 
        'struk_pembayaran', 
        'status',
        'catatan_teknisi',
        'kondisi', 
        'laporan', 
        'tgl_kembali_aktual'
    ];

    protected $casts = [
        'unit_ids' => 'array',
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke mobil
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    // Accessor untuk mengambil unit dari unit_ids
  // Hapus atau komentari dulu fungsi 'public function mobil_units()' yang belongsToMany 
// agar tidak bentrok, lalu gunakan ini:

// app/Models/Sewa.php

public function getMobilUnitsAttribute()
{
    // Mengambil nilai dari kolom 'unit_ids'
    $unitIds = $this->unit_ids;

    // Jika disimpan sebagai JSON string, decode dulu
    if (is_string($unitIds)) {
        $unitIds = json_decode($unitIds, true);
    }

    // Jika data tidak valid atau kosong, kembalikan koleksi kosong
    if (empty($unitIds) || !is_array($unitIds)) {
        return collect(); 
    }

    // Query data unit berdasarkan array ID
    return MobilUnit::whereIn('id', $unitIds)->get();
}
public function mobil_units() {
    return $this->belongsToMany(MobilUnit::class, 'transaksi_unit', 'transaksi_id', 'unit_id');
    // Sesuaikan nama tabel pivot dan foreign key sesuai punyamu
}
}