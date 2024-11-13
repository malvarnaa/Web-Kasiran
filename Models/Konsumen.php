<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'konsumen';

    protected $fillable = [
        'nama',
        'email',
        'jenis_kelamin',
        'no_telp',
        'alamat',
    ];

    // public function transaksi()
    // {
    //     return $this->hasMany(Transaksi::class);
    // }
    
}
