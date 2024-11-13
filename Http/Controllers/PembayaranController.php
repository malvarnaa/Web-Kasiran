<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index() {
        $header = 'Jenis Pembayaran';
        $pembayaran = Pembayaran::all();
        return view('pembayaran.index', compact('pembayaran'));
    }

    public function create(){
        return view('pembayaran.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_pembayaran' => 'required|string|max:255',
            'jenis_pembayaran' => 'required|string|max:100',
        ]);

        Pembayaran::create(attributes: [
            'nama_pembayaran' => $request->nama_pembayaran,
            'jenis_pembayaran' => $request->jenis_pembayaran,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Jenis Pembayaran berhasil ditambahkan');
    }

    public function edit(Pembayaran $pembayaran, $id) {
        $pembayaran = Pembayaran::find($id); // Ambil satu data konsumen berdasarkan ID
        return view('pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_pembayaran' => 'required|string|max:255',
            'jenis_pembayaran' => 'required|string|max:100', // Exclude the current email from the unique validation
        ]);

        // Ambil data konsumen yang akan diupdate
        $pembayaran = Pembayaran::findOrFail($id);

        // Update data konsumen
        $pembayaran->update([
            'nama_pembayaran' => $request->nama_pembayaran,
            'jenis_pembayaran' => $request->jenis_pembayaran,
        ]);

        // Redirect ke halaman sebelumnya atau halaman lain dengan pesan sukses
        return redirect()->route('pembayaran.index')->with('success', 'Jenis Pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect('/pembayaran')->with('success', 'Data berhasil dihapus!');
    }
}
