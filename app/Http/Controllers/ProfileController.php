<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        return view('profile.profile'); // Pastikan file blade kamu bernama profile.blade.php
    }

    /**
     * Memperbarui data profil dan foto.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        // Proses Upload Foto Profil
        if ($request->hasFile('avatar')) {
            // 1. Hapus foto lama jika ada di storage (kecuali default)
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // 2. Simpan foto baru ke folder 'avatars' di storage/app/public
            $path = $request->file('avatar')->store('avatars', 'public');
            
            // 3. Update path di database
            $user->avatar = $path;
        }

        // Update Nama
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Profil kamu berhasil diperbarui! ❄️');
    }
}