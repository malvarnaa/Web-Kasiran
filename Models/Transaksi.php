<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model {
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'kode_transaksi',
        'kategori_id',
        'nama_konsumen',
        'jumlah',
        'total_harga',
        'uang_pembeli',
        'kembalian',
        'pembayaran_id'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function pembayaran() {
        return $this->belongsTo(Pembayaran::class);
    }
}

