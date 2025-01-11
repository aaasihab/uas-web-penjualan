<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = ['kategori_id', 'judul', 'deskripsi', 'penulis', 'penerbit', 'cover','status'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_buku', 'buku_id');
    }

}
