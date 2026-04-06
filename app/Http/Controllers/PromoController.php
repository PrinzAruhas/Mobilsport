<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Category;
use App\Models\Promo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class PromoController extends Controller
{
    public function index()
    {
        $mobils = Mobil::with('category')->get();
        $categories = Category::all();
        $activePromos = Promo::latest()->get();

        return view('admin.promo', compact('mobils', 'categories', 'activePromos'));
    }

    public function update(Request $request, $id = null)
{
    // 1. Logic untuk Update Per Unit Mobil (Dari Tabel)
    if ($request->has('mobil_id')) {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'diskon_mobil' => 'required|numeric|min:0|max:100',
            'expired_at' => 'nullable|date'
        ]);
// SESUDAH (Hanya update diskon)
Mobil::where('id', $request->mobil_id)->update([
    'diskon' => $request->diskon_mobil,
]);

        return redirect()->back()->with('success', 'Diskon unit berhasil diperbarui!');
    }

    // 2. Logic untuk Update Per Kategori (Bulk Diskon)
    if ($request->has('category_id') && $request->has('diskon_kategori')) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'diskon_kategori' => 'required|numeric|min:0|max:100'
        ]);

        Mobil::where('category_id', $request->category_id)
             ->update(['diskon' => $request->diskon_kategori]);

        return redirect()->back()->with('success', 'Diskon kategori berhasil diterapkan!');
    }

    // 3. Logic untuk Update Kode Voucher (Jika ada ID dari route)
    if ($id) {
        $request->validate([
            'code' => 'required|string|unique:promos,code,' . $id,
            'discount' => 'required|numeric|min:1|max:100',
        ]);

        $promo = Promo::findOrFail($id);
        $promo->update([
            'code' => strtoupper($request->code),
            'discount_percent' => $request->discount,
            'type' => $request->type,
            'expired_at' => $request->expiry_date
        ]);

        return redirect()->back()->with('success', 'Voucher berhasil diupdate!');
    }

    return redirect()->back()->with('error', 'Gagal memproses data.');
}

    public function updateDiskon(Request $request)
    {
        if ($request->has('category_id') && $request->has('diskon_kategori')) {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'diskon_kategori' => 'required|numeric|min:0|max:100'
            ]);

            Mobil::where('category_id', $request->category_id)
                 ->update(['diskon' => $request->diskon_kategori]);

            return redirect()->back()->with('success', 'Diskon kategori berhasil diterapkan!');
        }

        if ($request->has('mobil_id')) {
            $request->validate([
                'mobil_id' => 'required|exists:mobils,id',
                'diskon_mobil' => 'required|numeric|min:0|max:100'
            ]);

            Mobil::where('id', $request->mobil_id)
                 ->update(['diskon' => $request->diskon_mobil]);

            return redirect()->back()->with('success', "Diskon unit berhasil diperbarui!");
        }

        return redirect()->back()->with('error', 'Data tidak lengkap.');
    }

    public function storeCode(Request $request) 
    {
        $request->validate([
            'code' => 'required|string|unique:promos,code',
            'type' => 'required|in:all,category,unit',
            'discount' => 'required|numeric|min:1|max:100',
            'target_id' => 'nullable|integer',
            'expiry_date' => 'nullable|date'
        ]);

        Promo::create([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'target_id' => ($request->type == 'all') ? null : $request->target_id,
            'discount_percent' => $request->discount,
            'expired_at' => $request->expiry_date ?? now()->addDays(30),
        ]);

        return back()->with('success', 'Kode Promo ' . strtoupper($request->code) . ' berhasil dirilis!');
    }

    public function destroyCode($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();
        return back()->with('success', 'Kode promo berhasil dihapus!');
    }

    public function showRedeem()
    {
        $latestPromo = Promo::where(function($query) {
                                $query->where('expired_at', '>=', now())
                                      ->orWhereNull('expired_at');
                            })
                            ->latest()
                            ->first();

        return view('booking.redeem', compact('latestPromo'));
    }

   public function applyPromo(Request $request)
{
    $request->validate([
        'promo_code' => 'required|string',
    ]);

    $code = strtoupper($request->promo_code);
    
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu.');
    }

    $user = Auth::user();
    $promo = Promo::where('code', $code)->first();

    if (!$promo) {
        return redirect()->back()->with('error', 'Kode promo tidak ditemukan.');
    }

    if ($promo->expired_at && $promo->expired_at < now()) {
        return redirect()->back()->with('error', 'Yah, kode promo ini sudah kadaluarsa.');
    }

    // 5. Cek apakah user sudah pernah memakai kode ini
    $alreadyUsed = $promo->users()->where('user_id', $user->id)->exists();

    if ($alreadyUsed) {
        return redirect()->back()->with('error', 'Maaf, Anda sudah pernah menggunakan kode promo ini.');
    }

    // 6. Simpan ke Session untuk kalkulasi harga di view
    $request->session()->put('applied_promo', [
        'id'        => $promo->id,
        'code'      => $promo->code,
        'discount'  => $promo->discount_percent,
        'type'      => $promo->type,
        'target_id' => $promo->target_id,
    ]);

    // --- BAGIAN YANG HILANG ---
    // 7. Simpan riwayat ke tabel pivot (promo_users) 
    // Ini yang bikin user tidak bisa redeem 2x karena datanya "terkunci" di DB
    $promo->users()->attach($user->id); 
    // --------------------------

    return redirect()->back()->with('success', 'Promo ' . $promo->code . ' berhasil dipasang!');
}
}