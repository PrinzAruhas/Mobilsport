<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use App\Models\MobilUnit;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
   public function index()
{
    // Mengambil jumlah record di tabel sewas yang kondisinya 'rusak'
    $mobilRusak = \App\Models\Sewa::where('kondisi', 'rusak')->count();

    // Data lainnya
    $totalTransaksi = \App\Models\Sewa::count();
    $mobilTersedia = \App\Models\MobilUnit::where('status', 'tersedia')->count();
    
    $laporanSewa = \App\Models\Sewa::with(['user', 'mobil_units.mobil'])
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('admin.statistik', compact(
        'mobilRusak', 
        'totalTransaksi', 
        'mobilTersedia', 
        'laporanSewa'
    ));
}
}