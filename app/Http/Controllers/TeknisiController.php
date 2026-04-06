<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use App\Models\Mobil;
use App\Models\MobilUnit;
use App\Models\PengembalianMobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeknisiController extends Controller
{
    /**
     * Menampilkan daftar transaksi yang perlu diverifikasi dokumen & pembayarannya
     */
  public function verifikasiIndex()
{
    $transaksi = Sewa::with(['user', 'mobil'])
                ->where('status', 'menunggu_verifikasi')
                ->orderBy('created_at', 'desc')
                ->get();

    return view('teknisi.verifikasi', compact('transaksi'));
}

    /**
     * Update status sewa berdasarkan hasil pengecekan teknisi
     */
   public function updateVerifikasi(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:disetujui,ditolak',
        'catatan' => 'nullable|string'
    ]);

    $sewa = Sewa::findOrFail($id);

    $sewa->update([
        'status' => $request->status,
        'catatan_teknisi' => $request->catatan
    ]);

    return back()->with('success', 'Status transaksi berhasil diperbarui!');
}

    /**
     * Menampilkan riwayat pengembalian mobil
     */
  public function index()
{
    // Mengambil data dari tabel sewas yang statusnya 'kembali'
    $history = Sewa::with(['user', 'mobil_units.mobil'])
        ->where('status', 'kembali')
        ->orderBy('tgl_kembali_aktual', 'desc')
        ->get();

    return view('teknisi.riwayat-servis', compact('history'));
}
    /**
     * Menyimpan laporan pengembalian mobil dari customer
     */
   public function storePengembalian(Request $request)
{
    $request->validate([
        'sewa_id' => 'required|exists:sewas,id',
        'mobil_id' => 'required|exists:mobils,id',
        'bukti_kartu' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'kondisi' => 'required|in:baik,rusak',
        'laporan' => 'nullable|string'
    ]);

    // Jalankan transaksi
    DB::transaction(function () use ($request) {
        // 1. Proses Upload Foto Kartu
        $nama_file = null;
        if ($request->hasFile('bukti_kartu')) {
            $file = $request->file('bukti_kartu');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('bukti_kartu', $nama_file, 'public');
        }

        // 2. Simpan Laporan Pengembalian
        PengembalianMobil::create([
            'sewa_id' => $request->sewa_id,
            'user_id' => auth()->id(),
            'mobil_id' => $request->mobil_id,
            'bukti_kartu' => $nama_file,
            'kondisi' => $request->kondisi,
            'laporan' => $request->laporan,
        ]);

        // 3. Update Status Sewa
        $sewa = Sewa::find($request->sewa_id);
        if ($sewa) {
            $sewa->update(['status' => 'kembali']);
        }

        // 4. Update Stok & Status Mobil
       // 4. Update Stok & Status Mobil
$mobil = Mobil::find($request->mobil_id);
if ($mobil) {
    // Gunakan increment untuk menambah stok
   
    
    // Simpan status secara manual tanpa memicu update massal pada kolom lain
    $mobil->status = 'tersedia';
    $mobil->save();
}

if ($request->has('unit_id')) {
    $unit = MobilUnit::find($request->unit_id);
    if ($unit) {
        $unit->status = 'tersedia';
        $unit->save();
    }
}
    });

    // Pindahkan redirect keluar dari blok DB::transaction
    return redirect()->back()->with('success', 'Laporan pengembalian berhasil dikirim! ❄️');
}
}