<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Sewa;
use App\Models\Mobil;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar riwayat booking user di halaman peminjam
     */
    public function index()
{
    $bookings = Sewa::join('mobils', 'sewas.mobil_id', '=', 'mobils.id')
        ->select(
            'sewas.*', 
            'mobils.gambar as mobil_gambar', // Beri alias agar tidak bentrok
            'mobils.no_polisi as mobil_nopol', // Beri alias
            DB::raw("CONCAT(mobils.merek, ' ', mobils.model) as nama_mobil")
        )
        ->where('sewas.user_id', Auth::id())
        ->orderBy('sewas.created_at', 'desc')
        ->get();

    return view('booking.index', compact('bookings'));
}

    /**
     * Menampilkan detail spesifik dari satu booking
     */
    public function show($id)
    {
        $sewa = Sewa::join('mobils', 'sewas.mobil_id', '=', 'mobils.id')
            ->select(
                'sewas.*',
                'mobils.gambar',
                'mobils.no_polisi',
                'mobils.harga_sewa',
                DB::raw("CONCAT(mobils.merek, ' ', mobils.model) as nama_mobil")
            )
            ->where('sewas.id', $id)
            ->where('sewas.user_id', Auth::id()) 
            ->firstOrFail();

        return view('peminjam.show', compact('sewa'));
    }

    /**
     * Upload bukti bayar
     */
    public function uploadBayar(Request $request, $id)
    {
        $request->validate([
            'struk_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $sewa = Sewa::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('struk_pembayaran')) {
            $path = $request->file('struk_pembayaran')->store('uploads/struk', 'public');
            
            $sewa->update([
                'struk_pembayaran' => $path,
                'status' => 'menunggu_verifikasi'
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah! Admin akan segera memverifikasi.');
    }

    
  public function returnIndex()
{
    $bookings = Sewa::with(['mobil', 'mobil_units'])
        ->where('user_id', Auth::id())
        // Kita gunakan 'disetujui' karena di gambar DB kamu statusnya itu, bukan 'aktif'
        ->where('status', 'disetujui') 
        ->get();

    return view('peminjam.booking', compact('bookings'));
}
   
}