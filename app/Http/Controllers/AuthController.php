<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user()->load('role.menus');

            $role = $user->role;
            $menus = $role ? $role->menus : collect(); // ambil menu dari role tunggal

            session([
                'user_data' => [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'role'  => $role?->name ?? '-',
                    'menus' => $menus->pluck('name')->toArray(),
                ]
            ]);

            return redirect()->intended('/dashboard'); // ganti sesuai dashboard kamu
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function register()
    {
        return view('auth.register'); // Pastikan file view-nya ada di resources/views/auth/register.blade.php
    }

    // Memproses data pendaftaran (Store)
    public function storeRegister(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Simpan user ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        // 3. Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silahkan login.');
    }
}
