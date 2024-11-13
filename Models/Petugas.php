<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'jenis_kelamin',
        'no_telp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'email');
    }
}
