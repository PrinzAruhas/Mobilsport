<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class MobilController extends Controller
{
   public function index()
{
    // 1. Ambil data mobil (tambahkan 'units' agar tidak error saat hitung stok)
    $mobils = Mobil::with(['category', 'units'])->latest()->get();
    
    // 2. Ambil semua kategori
    $categories = Category::all();

    // 3. DEFINISIKAN VARIABEL $disewa
    // Kita hitung jumlah total unit yang sedang berstatus 'disewa'
    $disewa = \App\Models\Unit::where('status', 'disewa')->count();

    // 4. Sekarang baru bisa dimasukkan ke compact
    return view('mobil.index', compact('mobils', 'categories', 'disewa'));
}

    public function create()
    {
        $categories = Category::all();
        return view('mobil.create', compact('categories'));
    }

 
    /**
     * Menampilkan form untuk mengedit armada.
     */
    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        $categories = Category::all();
        return view('mobil.edit', compact('mobil', 'categories'));
    }

    /**
     * Memperbarui data armada di database.
     */
public function store(Request $request)
    {
        $request->validate([
            'merek' => 'required',
            'model' => 'required',
            'harga_sewa' => 'required|numeric',
            'category_id' => 'required',
            'kapasitas' => 'required',
            'transmisi' => 'required',
            'bahan_bakarnya' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'units' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            $namaFile = $request->file('gambar')->store('mobil', 'public');
            $namaVideo = $request->hasFile('video') ? $request->file('video')->store('videos', 'public') : null;

            // Hapus 'stock' dari sini, karena sekarang dihitung otomatis via Accessor
            $mobil = Mobil::create([
                'merek'          => $request->merek,
                'model'          => $request->model,
                'harga_sewa'     => $request->harga_sewa,
                'category_id'    => $request->category_id,
                'deskripsi'      => $request->deskripsi,
                'kapasitas'      => $request->kapasitas,
                'transmisi'      => $request->transmisi,
                'bahan_bakarnya' => $request->bahan_bakarnya,
                'gambar'         => $namaFile,
                'video'          => $namaVideo,
            ]);

            foreach ($request->units as $index => $unit) {
                $namaFotoUnit = $request->hasFile("units.$index.foto_unit") 
                                ? $request->file("units.$index.foto_unit")->store('units', 'public') 
                                : null;

                $mobil->units()->create([
                    'no_polisi' => $unit['no_polisi'],
                    'warna'     => $unit['warna'],
                    'foto_unit' => $namaFotoUnit,
                    'status'    => 'tersedia',
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Armada berhasil disimpan! ❄️'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

   public function update(Request $request, $id)
{
    $mobil = Mobil::findOrFail($id);

    $request->validate([
        'merek' => 'required',
        'model' => 'required',
        'harga_sewa' => 'required|numeric',
        'category_id' => 'required',
        'units' => 'required|array|min:1',
    ]);

    try {
        DB::beginTransaction();

        // 1. Update File Utama (Gambar & Video)
        if ($request->hasFile('gambar')) {
            if ($mobil->gambar) { Storage::disk('public')->delete($mobil->gambar); }
            $mobil->gambar = $request->file('gambar')->store('mobil', 'public');
        }

        if ($request->hasFile('video')) {
            if ($mobil->video) { Storage::disk('public')->delete($mobil->video); }
            $mobil->video = $request->file('video')->store('videos', 'public');
        }

        // 2. Update Data Mobil
        $mobil->update($request->only([
            'merek', 'model', 'harga_sewa', 'category_id', 
            'deskripsi', 'kapasitas', 'transmisi', 'bahan_bakarnya'
        ]));

        // 3. Sinkronisasi Unit (Menggunakan ID untuk keamanan data)
        $submittedIds = collect($request->units)->pluck('id')->filter()->toArray();
        
        // Hapus unit yang tidak ada di form (unit yang dihapus user)
        $mobil->units()->whereNotIn('id', $submittedIds)->delete();

        foreach ($request->units as $index => $unitData) {
            $unitId = $unitData['id'] ?? null;
            
            // Siapkan data dasar
            $updateData = [
                'no_polisi' => $unitData['no_polisi'],
                'warna'     => $unitData['warna'],
                'status'    => $unitData['status'] ?? 'tersedia',
            ];

            // Proses upload foto unit jika ada file baru
            if ($request->hasFile("units.$index.foto_unit")) {
                $existingUnit = $mobil->units()->find($unitId);
                if ($existingUnit && $existingUnit->foto_unit) { 
                    Storage::disk('public')->delete($existingUnit->foto_unit); 
                }
                $updateData['foto_unit'] = $request->file("units.$index.foto_unit")->store('units', 'public');
            }

            // Update atau buat baru
            $mobil->units()->updateOrCreate(['id' => $unitId], $updateData);
        }

        DB::commit();

        // KEMBALIKAN JSON UNTUK AJAX
        return response()->json(['message' => 'Data armada berhasil diperbarui! ✨'], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        // KEMBALIKAN JSON ERROR UNTUK AJAX
        return response()->json(['message' => 'Gagal memperbarui: ' . $e->getMessage()], 500);
    }
}

/**
     * Menampilkan katalog mobil untuk Peminjam (Customer).
     */
   public function katalog()
{
    // 1. Ambil semua kategori untuk filter dropdown
    $categories = Category::all();

    // 2. Ambil data mobil beserta relasi category dan units yang tersedia
    $mobils = Mobil::with(['category', 'units' => function($query) {
        $query->where('status', 'tersedia');
    }])
    ->get()
    ->map(function ($mobil) {
        // Logika hitung harga akhir (diskon)
        $potongan = ($mobil->diskon / 100) * $mobil->harga_sewa;
        $mobil->harga_akhir = $mobil->harga_sewa - $potongan;
        
        // Hitung total ready untuk badge
        $mobil->total_ready = $mobil->units->where('status', 'tersedia')->count();
        
        return $mobil;
    });

    // 3. Pastikan 'categories' dimasukkan ke dalam compact()
    return view('mobil.katalog', compact('mobils', 'categories'));
}
    /**
     * Menampilkan detail mobil sebelum disewa.
     */
   /**
     * Menghapus armada beserta file gambar/videonya.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $mobil = Mobil::with('units')->findOrFail($id);

            // 1. Hapus Foto Utama & Video dari Storage
            if ($mobil->gambar) { Storage::disk('public')->delete($mobil->gambar); }
            if ($mobil->video) { Storage::disk('public')->delete($mobil->video); }

            // 2. Hapus Foto-foto Unit dari Storage
            foreach ($mobil->units as $unit) {
                if ($unit->foto_unit) {
                    Storage::disk('public')->delete($unit->foto_unit);
                }
            }

            // 3. Hapus data dari Database (Unit akan ikut terhapus jika pakai Cascade Delete)
            $mobil->delete();

            DB::commit();
            return response()->json(['message' => 'Armada berhasil dihapus! ❄️'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menghapus: ' . $e->getMessage()], 500);
        }
    }

public function cekStatus(Request $request)
{
    // Validasi input dulu biar gak kosong
    if (!$request->nopol) {
        return response()->json(['success' => false, 'message' => 'Masukkan plat nomor!']);
    }

    // Ambil input dan bersihkan spasi
    $input = str_replace(' ', '', $request->nopol);

    try {
        // Cari di tabel mobil_units berdasarkan kolom 'no_polisi'
        $unit = \App\Models\MobilUnit::with('mobil')
                ->whereRaw("REPLACE(no_polisi, ' ', '') = ?", [$input])
                ->first();

        if ($unit) {
            return response()->json([
                'success' => true,
                'data' => [
                    'no_polisi' => $unit->no_polisi,
                    'warna'     => $unit->warna,
                    'status'    => $unit->status,
                    'merek'     => $unit->mobil->merek ?? 'Unit',
                    'model'     => $unit->mobil->model ?? '',
                    // Gunakan optional() agar tidak error jika updated_at null
                    'updated_at' => optional($unit->updated_at)->format('d M Y, H:i') ?? '-'
                ]
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Unit tidak ditemukan']);

    } catch (\Exception $e) {
        // Jika ada error database, tidak langsung nampil error kasar ke user
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem.']);
    }
}
    // Fungsi lain (index, create, edit, show) tetap seperti kode awal kamu karena sudah cukup baik
}
