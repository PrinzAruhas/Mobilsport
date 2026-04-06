<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'mobil_id', 'parent_id', 'isi_komentar'];

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi untuk mengambil balasan dari komentar ini
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
