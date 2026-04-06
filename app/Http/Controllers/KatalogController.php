<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Category;
use App\Models\Promo; 
use Illuminate\Http\Request;
use Carbon\Carbon; // Tambahkan ini untuk handle tanggal

class KatalogController extends Controller
{
    /**
     * Menampilkan daftar mobil dengan logika diskon otomatis.
     */
    public function index()
    {
        $mobils = Mobil::with('category')->get();
        $categories = Category::all();

        // Ganti 'is_active' dengan pengecekan 'expired_at'
        $promo = Promo::where(function($query) {
                        $query->where('expired_at', '>=', now())
                              ->orWhereNull('expired_at');
                    })
                    ->latest()
                    ->first();

        return view('mobil.katalog', compact('mobils', 'categories', 'promo'));
    }

    /**
     * Menampilkan detail mobil dengan info diskon.
     */
    public function show($id)
    {
        $mobil = Mobil::with('category')->findOrFail($id);
        
        // Sesuaikan juga di sini agar tidak error
        $promo = Promo::where(function($query) {
                        $query->where('expired_at', '>=', now())
                              ->orWhereNull('expired_at');
                    })
                    ->latest() 
                    ->first();
        
        return view('mobil.show', compact('mobil', 'promo'));
    }
}