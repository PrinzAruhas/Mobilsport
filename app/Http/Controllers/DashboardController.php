<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Sewa;
use App\Models\Menu;
use App\Models\User;
use App\Models\LaporanAdmin;
use App\Models\PengembalianMobil;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
{
    $userData = session('user_data');
    $menuNames = session('user_data.menus', []);
    
    // Logika Menu
    $menus = Menu::whereIn('name', $menuNames)
        ->orderBy('parent_id')
        ->orderBy('order')
        ->get()
        ->groupBy('parent_id');

    // --- DATA MOBIL & SEWA ---
    $allMobils = Mobil::with(['category', 'units'])->get(); 

    $rekomendasiMobil = Mobil::whereHas('units', function($query) {
        $query->where('status', 'tersedia');
    })
    ->inRandomOrder()
    ->limit(2)
    ->get();

    $sewaAktif = Sewa::with('mobil')
        ->where('user_id', auth()->id())
        ->where('status', 'disetujui') 
        ->latest()
        ->first();

    // --- LOGIKA REVENUE ---
    $target = 60000000; 
    $revenueMonth = Sewa::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->whereIn('status', ['selesai', 'aktif', 'kembali']) 
        ->sum('total_harga');

    $percentage = ($target > 0) ? ($revenueMonth / $target) * 100 : 0;
    $displayPercentage = round($percentage, 1);
    $barPercentage = min($percentage, 100);

    // --- TAMBAHAN: TRANSAKSI KEMBALI HARI INI ---
    // Kita cek berdasarkan status 'kembali' yang diupdate hari ini
    $transaksiHariIni = Sewa::where('status', 'kembali')
        ->whereDate('updated_at', \Carbon\Carbon::today()) 
        ->count();

    // --- STATS UNTUK BLADE ---
    $stats = [
        'total_mobil'       => Mobil::count(),
        'mobil_tersedia'    => \App\Models\MobilUnit::where('status', 'tersedia')->count(),
        'mobil_disewa'      => \App\Models\MobilUnit::where('status', 'disewa')->count(),
        'mobil_servis'      => \App\Models\MobilUnit::where('status', 'servis')->count(),
        
        'total_sewa_anda'   => Sewa::where('user_id', auth()->id())->count(),
        'total_user'        => User::count(),
        'transaksi_pending' => Sewa::where('status', 'menunggu_verifikasi')->count(),
        'kyc_pending'       => User::whereNull('email_verified_at')->count(), 
        
        'revenue_month'     => $revenueMonth,
        'target'            => $target,
        'display_percentage'=> $displayPercentage,
        'bar_percentage'    => $barPercentage,
        
        // Stats baru untuk Card "Transaksi/Unit Kembali"
        'transaksi_hari_ini' => $transaksiHariIni, 
    ];

    // --- LAPORAN ADMIN ---
    $allLaporan = LaporanAdmin::with('user')->orderBy('created_at', 'desc')->get();
    $lastReport = LaporanAdmin::latest()->first();

    // --- DATA CHART (Occupancy 7 Hari Terakhir) ---
    $labels = [];
    $dataSewa = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $labels[] = $date->translatedFormat('d M'); 
        
        // Agar Chart sinkron, kita hitung jumlah unit yang statusnya 'kembali' di tanggal tersebut
        $count = Sewa::where('status', 'kembali')
            ->whereDate('updated_at', $date)
            ->count();
            
        $dataSewa[] = $count;
    }

    return view('dashboard.index', compact(
        'userData', 'menus', 'rekomendasiMobil', 'stats', 'allLaporan', 
        'lastReport', 'allMobils', 'sewaAktif', 'revenueMonth', 'target', 
        'displayPercentage', 'barPercentage', 'labels', 'dataSewa'
    ));
}
    public function storeLaporan(Request $request) 
    {
        $request->validate([
            'topik' => 'required|string',
            'pesan' => 'required|string',
        ]);

        $laporan = LaporanAdmin::create([
            'topik'     => $request->topik,
            'pesan'     => $request->pesan,
            'user_id'   => auth()->id(),
            'is_urgent' => $request->has('urgent'),
            'status'    => 'pending'
        ]);

        return response()->json([
            'status' => 'success',
            'pesan'  => 'Laporan terkirim!',
            'data'   => [
                'pesan' => $laporan->pesan,
                'waktu' => $laporan->created_at->format('H:i')
            ]
        ]);
    }

    public function replyLaporan(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporan_admins,id',
            'balasan'    => 'required|string',
        ]);

        $lp = LaporanAdmin::findOrFail($request->laporan_id);
        $lp->update([
            'balasan_admin' => $request->balasan,
            'status'        => 'selesai'
        ]);

        return response()->json(['status' => 'success', 'message' => 'Balasan terkirim']);
    }
}