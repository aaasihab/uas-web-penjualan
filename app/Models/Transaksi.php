<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'pelanggan_id',
        'produk_id',
        'tanggal_transaksi',
        'jumlah',
        'total_harga',
        'status'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'pelanggan_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'transaksi_id', 'id_transaksi');
    }

}
