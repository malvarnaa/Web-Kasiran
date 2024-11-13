<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index() {
        $petugas = Petugas::all();
        $header = 'Data Petugas';
        return view('petugas.index', compact('header'), [
            'petugas' => $petugas
        ]);
    }

    public function create() {
        return view('petugas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nik' => 'required|string|unique:petugas,nik',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        Petugas::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Data Petugas berhasil ditambahkan');
    }

    public function edit(Petugas $petugas, $id){
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nik' => 'required|string|unique:petugas,nik',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $petugas = Petugas::findOrfail($id);

        $petugas->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Petugas $petugas, $id) {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();
        return redirect()->route('petugas.index')->with('success', 'Data berhasil dihapus');
    }
}
