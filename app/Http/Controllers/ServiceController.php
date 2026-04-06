<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobilUnit; // Pastikan model ini sudah ada

class ServiceController extends Controller
{
    /**
     * Menampilkan daftar unit yang statusnya 'rusak' atau 'servis'
     */
    public function index()
    {
        // Ambil unit yang butuh perhatian mekanik
        $units = MobilUnit::with('mobil')
            ->whereIn('status', ['rusak', 'servis'])
            ->get();

        return view('teknisi.servis', compact('units'));
    }

    /**
     * Update status unit (Misal: dari 'rusak' ke 'servis', atau 'servis' ke 'tersedia')
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:tersedia,servis,rusak'
        ]);

        $unit = MobilUnit::findOrFail($id);
        $unit->status = $request->status;
        $unit->save();

        // Kirim notifikasi sukses ala Ice Theme
        return back()->with('success', 'Status armada ' . $unit->no_polisi . ' berhasil diperbarui! ❄️');
    }
}