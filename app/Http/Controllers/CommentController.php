<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'isi_komentar' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        // Proteksi Role (Hanya Peminjam/Role 3)
        if (Auth::user()->role_id != 3) {
            return back()->with('error', 'Hanya peminjam yang bisa berkomentar.');
        }

        Comment::create([
            'user_id' => Auth::id(),
            'mobil_id' => $request->mobil_id,
            'parent_id' => $request->parent_id, 
            'isi_komentar' => $request->isi_komentar
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
