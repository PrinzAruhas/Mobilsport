<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User; // Tambahkan ini
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userData = session('user_data');
        $menuNames = session('user_data.menus', []);
        $requestedMenu = 'User Management';

        if (!in_array($requestedMenu, $menuNames)) {
            return redirect()->route('pageDashboard');
        }

        // Ambil data menu untuk sidebar (tetap pakai logic kamu)
        $menus = Menu::whereIn('name', $menuNames)
            ->orderBy('parent_id')
            ->orderBy('order')
            ->get()
            ->groupBy('parent_id');

        // AMBIL DATA USER DARI DATABASE
        $users = User::latest()->paginate(10); 

        return view('users.index', compact('userData', 'menus', 'users'));
    }

    /**
     * Update the specified resource in storage (Untuk Ubah Role).
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'role_id' => 'required|exists:roles,id', // asumsikan tabelnya bernama roles
    ]);

    $user = User::findOrFail($id);
    $user->role_id = $request->role_id;
    $user->save();

    return redirect()->back()->with('success', 'Akses user ' . $user->name . ' berhasil diperbarui! ❄️');
}
    /**
     * Remove the specified resource from storage (Hapus User).
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Jangan biarkan user menghapus dirinya sendiri
        if (session('user_data.id') == $id) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus dari sistem.');
    }

    // Kamu bisa isi create/store nanti jika butuh fitur tambah user manual
}