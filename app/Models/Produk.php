<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['kategori_produk_id', 'nama', 'deskripsi', 'harga', 'stok', 'gambar', 'status'];

    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id', 'id_kategori_produk');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'produk_id', 'id_produk');
    }
}
