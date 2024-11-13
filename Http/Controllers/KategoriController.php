<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index() {
        $kategori = Kategori::all();

        return view('kategori.index', [
            'kategori' => $kategori,
        ]);
    }

    public function create()
    {
        return view('kategori.create'); // Pastikan Anda memiliki view kategori.create
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_brg' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);
    
        $singkat = strtoupper(substr($request->jenis_brg, 0, 3));
        $count = Kategori::where('kode', 'like', $singkat . '%')->count();
 
        do {
            $kodeBaru = $singkat . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
            $count++;
        } while (Kategori::where('kode', $kodeBaru)->exists());
        
        Kategori::create([
            'kode' => $kodeBaru,
            'jenis_brg' => $request->jenis_brg,
            'harga' => $request->harga,
        ]);
    
        return redirect()->route('kategori.index')->with('success', 'Kategori barang berhasil ditambahkan');
    }
    
    

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori')); // Pastikan Anda memiliki view kategori.edit
    }

    public function show($kode)
    {
        //
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_brg' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);
    
        $kategori = Kategori::findOrFail($id);
    
        if ($kategori->jenis_brg !== $request->jenis_brg) {
            $singkat = strtoupper(substr($request->jenis_brg, 0, 3));
            $count = Kategori::where('kode', 'like', $singkat . '%')->count();
            $newKode = $singkat . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
            $kategori->kode = $newKode;
        }
    
        $kategori->jenis_brg = $request->jenis_brg;
        $kategori->harga = $request->harga;
        $kategori->save();
    
        return redirect()->route('kategori.index')->with('success', 'Kategori barang berhasil diperbarui');
    }

    // Hapus data kategori dari database
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori barang berhasil dihapus');
    }
}
