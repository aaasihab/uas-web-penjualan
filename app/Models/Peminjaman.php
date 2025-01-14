<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'peminjaman';

    // Primary key tabel
    protected $primaryKey = 'id_peminjaman';

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    // Aktifkan timestamps untuk otomatis mengelola created_at dan updated_at
    public $timestamps = true;

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id_buku');
    }
}
