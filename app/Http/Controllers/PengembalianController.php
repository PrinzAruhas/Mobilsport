<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sewa;
use App\Models\MobilUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'sewa_id'      => 'required|exists:sewas,id',
            'unit_id'      => 'required|exists:mobil_units,id',
            'kondisi'      => 'required|in:bagus,rusak',
            'bukti_kartu'  => 'required|image|max:2048', // Maks 2MB
            'alasan_rusak' => 'required_if:kondisi,rusak'
        ]);

        // 2. Ambil data sewa milik user yang sedang login
        $sewa = Sewa::where('id', $request->sewa_id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        try {
            DB::transaction(function () use ($sewa, $request) {
                
                // 3. Simpan file bukti kartu
                $path = $request->file('bukti_kartu')->store('bukti_kembali', 'public');

                // 4. Update Tabel Sewa (Status jadi 'kembali')
                $sewa->update([
                    'status'             => 'kembali', 
                    'tgl_kembali_aktual' => now(),
                    'kondisi'            => $request->kondisi,
                    // Karena di screenshot lama laporan isinya path gambar, kita simpan gambar ke sini.
                    // Jika ada kolom khusus bukti gambar, pindahkan $path ke kolom tersebut.
                    'laporan'            => $path, 
                    
                    // TIPS: Jika Anda punya kolom 'alasan_rusak' di DB sewas, simpan alasannya di sana.
                    // Jangan taruh di catatan_teknisi, biarkan catatan teknisi NULL dulu sampai diperbaiki teknisi.
                    // 'alasan_user'     => $request->kondisi == 'rusak' ? $request->alasan_rusak : 'Bagus',
                ]);

                // 5. KOREKSI: Update Tabel MobilUnit sesuai kondisi!
                // Jika kondisi rusak, maka status unit 'rusak'. Jika bagus, 'tersedia'.
                $statusUnit = ($request->kondisi == 'rusak') ? 'rusak' : 'tersedia';

                MobilUnit::where('id', $request->unit_id)->update([
                    'status' => $statusUnit
                ]);
                
                // 6. (Opsional) Update stok atau status di tabel 'mobils' induk jika diperlukan
                // $sewa->mobil->update(['status' => 'tersedia']);
            });

            return back()->with('success', 'Berhasil! Armada telah dikembalikan dan kartu dinonaktifkan. ❄️');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pengembalian: ' . $e->getMessage());
        }
    }
}