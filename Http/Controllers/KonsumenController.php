<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    public function index() {
        $konsumen = Konsumen::all();

        $header = 'Data Konsumen';
        return view('data_konsumen.index', compact('header'), [
            'konsumens' => $konsumen
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
         $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:konsumen,email',
            'jenis_kelamin' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);
    
        // Gunakan Konsumen::create untuk menyimpan data yang sudah divalidasi ke database
        Konsumen::create(attributes: [
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);
    
        // Redirect ke halaman sebelumnya atau halaman lain dengan pesan sukses
        return redirect()->route('konsumen.index')->with('success', 'Data konsumen berhasil ditambahkan.');
    }
    
    public function create()
    {
        // Tampilkan form untuk menambahkan data konsumen baru
        return view('data_konsumen.create');
    }

    public function edit(Konsumen $konsumens, $id) {
        $konsumens = Konsumen::find($id); // Ambil satu data konsumen berdasarkan ID
        return view('data_konsumen.edit', compact('konsumens'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:konsumen,email,' . $id, // Exclude the current email from the unique validation
            'jenis_kelamin' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Ambil data konsumen yang akan diupdate
        $konsumens = Konsumen::findOrFail($id);

        // Update data konsumen
        $konsumens->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        // Redirect ke halaman sebelumnya atau halaman lain dengan pesan sukses
        return redirect()->route('konsumen.index')->with('success', 'Data konsumen berhasil diperbarui.');
    }

    public function destroy(Konsumen $konsumens, $id)
    {
        $konsumens = Konsumen::findOrFail($id);
        $konsumens->delete();
        return redirect('/konsumen')->with('success', 'Data berhasil dihapus!');
    }

}
