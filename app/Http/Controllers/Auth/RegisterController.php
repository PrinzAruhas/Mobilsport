<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // Tambahkan Use Hash di atas jika belum ada
public function store(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // 2. Simpan User ke Database dengan role_id otomatis 4
    $user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),

    // ⬇️ WAJIB LENGKAP
    
    'role_id' => 3,
]);


    // 3. Langsung Login (Opsional)
    auth()->login($user);

    // 4. Redirect ke Dashboard atau Login dengan pesan sukses
    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan masuk.');
}
}
