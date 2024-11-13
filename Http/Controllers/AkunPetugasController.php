<?php

namespace App\Http\Controllers;

use App\Models\AkunPetugas;
use App\Models\Petugas;
use App\Models\User; // Tambahkan model User untuk menyimpan akun petugas
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AkunPetugasController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Pastikan hanya user yang sudah login yang bisa mengakses
    //     $this->middleware('role:admin'); // Pastikan hanya admin yang bisa mengakses
    // }

    public function index()
    {
        // Menampilkan semua akun petugas yang ada
        $akunPetugas = User::where('role', 'petugas')->get();
        return view('akunPetugas.index', compact('akunPetugas'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat akun petugas baru
        $petugas = Petugas::all(); // Menampilkan semua data petugas untuk dipilih
        return view('akunPetugas.create', compact('petugas'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'petugas_id' => 'required|exists:petugas,id', // Pastikan petugas_id ada di tabel petugas
            'email' => 'required|string|unique:users,username', // Username harus unik di tabel users
            'password' => 'required|string|min:8|confirmed', // Password harus diisi dan minimal 8 karakter
        ]);

        // Buat akun untuk petugas
        $petugas = Petugas::findOrFail($request->petugas_id);

        // Membuat data akun petugas di tabel users
        User::create([
            'nama' => $petugas->nama, // Nama petugas yang akan ditambahkan ke user
            'username' => $request->username, // Username petugas yang akan digunakan untuk login
            'password' => Hash::make($request->password), // Password yang di-hash untuk keamanan
            'role' => 'petugas', // role petugas
        ]);

        return redirect()->route('akunPetugas.index')->with('success', 'Akun petugas berhasil dibuat!');
    }
}
