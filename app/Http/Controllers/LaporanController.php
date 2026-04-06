<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Laporan; // Jika Anda ingin simpan ke database

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'topik' => 'required',
            'pesan' => 'required',
        ]);

        // Logika simpan data (Contoh simpan ke DB)
        // Laporan::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil terkirim!'
        ]);
    }
}