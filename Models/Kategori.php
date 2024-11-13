<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model {
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = ['kode', 'jenis_brg', 'harga'];

    public function transaksi() {
        return $this->hasMany(Transaksi::class);
    }
}


