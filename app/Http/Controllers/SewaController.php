<?php

namespace App\Http\Controllers;

use App\Models\MobilUnit;
use App\Models\Mobil;
use App\Models\Promo; // tambahin di atas
use App\Models\PengembalianMobil; // Hanya menggunakan MobilUnit
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SewaController extends Controller
{
    public function show($id)
{
    $mobil = Mobil::findOrFail($id);

    // Ambil promo dari session
    $promo = session('promo');

    $diskonPromo = $promo['discount_percent'] ?? 0;

    return view('mobil.show', compact('mobil', 'diskonPromo', 'promo'));
}
   // Di dalam SewaController, method create:
public function create(Request $request)
    {
        $unitIds = (array) $request->input('unit_ids');
        
        // 1. Ambil data unit beserta data mobil induknya
        $units = MobilUnit::with('mobil')->whereIn('id', $unitIds)->get();

        if ($units->isEmpty()) {
            return redirect()->back()->with('error', 'Silakan pilih unit mobil terlebih dahulu.');
        }

        // Ambil data mobil induk pertama sebagai referensi info
        $mobil = $units->first()->mobil; 

        $durasi = (int) $request->input('durasi', 1);
        $biaya_admin = 2500;
        
        // 2. LOGIKA PROMO DARI SESSION
        $promo = session('applied_promo'); // Konsisten dengan nama session promo kita
        $diskonRedeemPersen = 0;

        if ($promo) {
            $pType = $promo['type'] ?? 'all';
            $pTargetId = $promo['target_id'] ?? null;

            // Validasi apakah promo berlaku untuk unit/kategori ini
            if ($pType == 'all' || 
               ($pType == 'category' && (int)$mobil->category_id === (int)$pTargetId) || 
               ($pType == 'unit' && (int)$mobil->id === (int)$pTargetId)) {
                $diskonRedeemPersen = (int)$promo['discount'];
            }
        }

        // 3. HITUNG TOTAL HARGA (LOOPING PER UNIT)
        $total_sewa_clean = $units->sum(function ($unit) use ($durasi, $diskonRedeemPersen) {
            $harga_asli = $unit->mobil->harga_sewa;
            $persen_diskon_unit = $unit->mobil->diskon ?? 0;
            
            // Step 1: Potong Diskon Unit (Flash Sale)
            $harga_setelah_unit = $harga_asli - ($harga_asli * ($persen_diskon_unit / 100));
            
            // Step 2: Potong Diskon Redeem Promo (Dihitung dari harga sisa Step 1)
            $harga_final_per_hari = $harga_setelah_unit - ($harga_setelah_unit * ($diskonRedeemPersen / 100));
            
            return $harga_final_per_hari * $durasi;
        });

        $total_final = $total_sewa_clean + $biaya_admin;
        $tgl_mulai = $request->input('tgl_mulai');

        return view('mobil.sewa', [
            'mobils' => $units,
            'mobil' => $mobil,
            'tgl_mulai' => $tgl_mulai,
            'durasi' => $durasi,
            'unit_ids' => $unitIds,
            'total_final' => $total_final,
            'biaya_admin' => $biaya_admin,
            'promo' => $promo,
            'diskonPromo' => $diskonRedeemPersen // Nilai persen untuk tampilan
        ]);
    }

    /**
     * Simpan Transaksi ke Database
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_ids' => 'required|array',
            'tgl_mulai' => 'required|date|after_or_equal:today',
            'durasi' => 'required|integer|min:1',
            'payment_method' => 'required|in:transfer_bank,ewallet,cod',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_sim' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $sewa = DB::transaction(function () use ($request) {
                // 1. Upload File
                $ktpPath = $request->file('foto_ktp')->store('identitas', 'public');
                $simPath = $request->file('foto_sim')->store('identitas', 'public');
                $strukPath = $request->hasFile('struk_pembayaran') 
                             ? $request->file('struk_pembayaran')->store('struk', 'public') 
                             : null;

                // 2. Hitung Ulang Harga di Server (KEAMANAN)
                $units = MobilUnit::with('mobil')->whereIn('id', $request->unit_ids)->get();
                $durasi = (int)$request->durasi;
                
                $promo = session('applied_promo');
                $diskonRedeem = 0;

                $total_bayar_server = $units->sum(function ($unit) use ($durasi, $promo) {
                    $harga = $unit->mobil->harga_sewa;
                    // Potong diskon unit
                    $harga = $harga - ($harga * (($unit->mobil->diskon ?? 0) / 100));
                    // Potong diskon promo session jika ada
                    if ($promo) {
                        $harga = $harga - ($harga * ($promo['discount'] / 100));
                    }
                    return $harga * $durasi;
                }) + 2500; // + Admin Fee

                // 3. Update Status Unit
                foreach ($units as $unit) {
                    if ($unit->status !== 'tersedia') {
                        throw new \Exception("Unit {$unit->no_polisi} sudah tidak tersedia.");
                    }
                    $unit->update(['status' => 'tidak tersedia']);
                }

                // 4. Buat Record Sewa
                $newSewa = Sewa::create([
                    'user_id' => Auth::id(),
                    'mobil_id' => $units->first()->mobil_id,
                    'unit_ids' => json_encode($request->unit_ids), // Simpan sebagai JSON
                    'tgl_mulai' => $request->tgl_mulai,
                    'tgl_selesai' => Carbon::parse($request->tgl_mulai)->addDays($durasi),
                    'total_harga' => $total_bayar_server, // Gunakan hitungan server
                    'metode_pembayaran' => $request->payment_method,
                    'foto_ktp' => $ktpPath,
                    'foto_sim' => $simPath,
                    'struk_pembayaran' => $strukPath,
                    'status' => ($request->payment_method === 'cod') ? 'pending' : 'menunggu_verifikasi',
                    'promo_id' => $promo['id'] ?? null,
                ]);

                // Hapus promo dari session agar tidak bisa dipakai lagi
                session()->forget('applied_promo');

                return $newSewa;
            });

            return response()->json([
                'success' => true,
                'message' => 'Booking Berhasil!',
                'data' => $sewa
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

   public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:disetujui,ditolak',
        'catatan' => 'nullable|string'
    ]);

    $sewa = Sewa::findOrFail($id);

    $sewa->update([
        'status' => $request->status,
        'catatan' => $request->catatan
    ]);

    $unitIds = json_decode($sewa->unit_ids, true);

    foreach ($unitIds as $unitId) {
        $unit = MobilUnit::find($unitId);
        if (!$unit) continue;

        if ($request->status == 'disetujui') {
            $unit->status = 'disewa';
        }

        if ($request->status == 'ditolak') {
            $unit->status = 'tersedia';
        }

        $unit->save();
    }

    return back()->with('success', 'Status berhasil diperbarui!');
}

  public function kembalikanMobil(Request $request, $id)
{
    $sewa = Sewa::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    $request->validate(['kondisi' => 'required', 'laporan' => 'nullable|string']);

    DB::transaction(function () use ($sewa, $request) {
        // 1. Update status sewa menjadi selesai
        $sewa->update([
            'status' => 'selesai',
            'tgl_kembali_aktual' => now(),
            'kondisi' => $request->kondisi, 
            'laporan' => $request->laporan 
        ]);

        // 2. Update status unit kembali ke 'tersedia'
        $unitIds = json_decode($sewa->unit_ids, true);
        
        // Cukup update status saja, JANGAN panggil increment('stock')
        MobilUnit::whereIn('id', $unitIds)->update(['status' => 'tersedia']);
        
        // 3. (Opsional) Jika perlu update status di tabel 'mobils' juga
        $mobil = Mobil::find($sewa->mobil_id);
        if ($mobil) {
            $mobil->update(['status' => 'tersedia']);
        }
    });

    return back()->with('success', 'Laporan pengembalian telah dikirim! ❄️');
}
    // Tambahkan ini di MobilUnit.php
public function scopeTersedia($query)
{
    return $query->where('status', 'tersedia');
}
public function laporanTeknisi()
{
    // 1. Ambil data dengan nama variabel $daftarKerusakan
 $daftarKerusakan = Sewa::with(['user', 'mobil_units.mobil'])
        ->where('kondisi', 'rusak')
        ->where('status', 'kembali') // Biasanya hanya yang sudah kembali yang dicek teknisi
        ->orderBy('tgl_kembali_aktual', 'desc')
        ->get();
    // 2. Sekarang compact() akan menemukan variabel tersebut
    return view('teknisi.lapor-kerusakan', compact('daftarKerusakan'));
}
public function statistik()
{
    // Hitung pendapatan bulan ini saja
    $revenueMonth = Sewa::where('status', 'selesai')
        ->whereMonth('tgl_mulai', date('m'))
        ->whereYear('tgl_mulai', date('Y'))
        ->sum('total_harga');

    // Data lainnya (tetap diperlukan untuk grafik dan tabel)
    $totalSelesai = Sewa::where('status', 'selesai')->count();
    $totalKeuntungan = Sewa::where('status', 'selesai')->sum('total_harga'); // Total keseluruhan
    $mobilTerlaris = Sewa::select('mobil_id', DB::raw('count(*) as total'))
        ->with('mobil')
        ->groupBy('mobil_id')
        ->orderBy('total', 'desc')
        ->take(5)
        ->get();
        
    $grafikKeuntungan = Sewa::where('status', 'selesai')
        ->select(
            DB::raw('SUM(total_harga) as sum'),
            DB::raw("DATE_FORMAT(tgl_mulai, '%M') as month")
        )
        ->groupBy('month')
        ->orderBy('tgl_mulai', 'asc')
        ->get();

    return view('admin.statistik', compact(
        'revenueMonth', // Variabel ini sekarang ada dan bisa dipakai
        'totalSelesai', 
        'totalKeuntungan', 
        'mobilTerlaris', 
        'grafikKeuntungan'
    ));
}
}