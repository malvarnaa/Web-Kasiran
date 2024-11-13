<?php

// TransaksiController.php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index() {
        $transaksis = Transaksi::with(['kategori', 'pembayaran'])->get();
        return view('transaksi.index', compact('transaksis'));
    }
    public function create(Request $request) {
        $kategoris = Kategori::all();
        $pembayarans = Pembayaran::all();
        
        // Ambil data rekapan dari request jika ada
        $request->session()->forget('rekapan');
    
        return view('transaksi.create', compact('kategoris', 'pembayarans'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah' => 'required|integer|min:1',
            'uang_pembeli' => 'required|integer|min:0',
        ]);
    
        $kategori = Kategori::find($request->kategori_id);
        $total_harga = $kategori->harga * $request->jumlah;
        $kembalian = $request->uang_pembeli - $total_harga;
    
        if ($kembalian < 0) {
            return redirect()->back()->withErrors(['uang_pembeli' => 'Uang tidak cukup']);
        }
    
        // Menghasilkan kode transaksi yang unik
        do {
            $kode_transaksi = 'TRX' . str_pad((Transaksi::count() + 1), 4, '0', STR_PAD_LEFT) . 'M';
        } while (Transaksi::where('kode_transaksi', $kode_transaksi)->exists());
    
        Transaksi::create([
            'kode_transaksi' => $kode_transaksi,
            'kategori_id' => $request->kategori_id,
            'nama_konsumen' => $request->nama_konsumen,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'uang_pembeli' => $request->uang_pembeli,
            'kembalian' => $kembalian,
            'pembayaran_id' => $request->pembayaran_id,
        ]);
    
        // Simpan data rekapan ke session menggunakan put
        $rekapan = [
            'jenis_brg' => $kategori->jenis_brg,
            'harga' => $kategori->harga,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'uang_pembeli' => $request->uang_pembeli,
            'kembalian' => $kembalian,
        ];
    
        $request->session()->put('rekapan', $rekapan); // Menggunakan put
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan');
    }


    public function destroy(Transaksi $petugas, $id) {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Data berhasil dihapus');
    }
    
}


    // public function create()
    // {
    //     $kategori = Kategori::find('kategori_id');
    //     $pembayaran = Pembayaran::all();
    //     return view('transaksi.create', compact('pembayaran', 'kategori'));
    // }

    // public function store(Request $request)
    // {
    //     // Validasi data yang diterima dari form
    //     $request->validate([
    //         'konsumen_id' => 'required|string',
    //         'kategori_id' => 'required|exists:kategori,id', 
    //         'jumlah_barang' => 'required|integer',
    //         'total_harga' => 'required|string',
    //         'bayar' => 'required|string',
    //         'kembalian' => 'required|string',
    //         'pembayaran_id' => 'required|exists:pembayarans,id', 
    //     ]);

    //     try {
    //         // Simpan transaksi baru ke database
    //         Transaksi::create([
    //             'kode_transaksi' => 'TRX-' . strtoupper(uniqid()), 
    //             'konsumen_id' => $request->konsumen_id,
    //             'kategori_id' => $request->kategori_id,
    //             'jumlah_barang' => $request->jumlah_barang,
    //             'total_harga' => $request->total_harga,
    //             'bayar' => $request->bayar,
    //             'kembalian' => $request->kembalian,
    //             'pembayaran_id' => $request->pembayaran_id,
    //         ]);

    //         return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    //     } catch (\Exception $e) {
    //         Log::error("Error menyimpan transaksi: " . $e->getMessage());
    //         return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan transaksi');
    //     }
    // }

    // public function index()
    // {
    //     $transaksis = Transaksi::with(['kategori', 'pembayaran'])->get();
    //     return view('transaksi.index', compact('transaksis'));
    // }

    // private function generateTransactionCode()
    // {
    //     $lastTransaction = Transaksi::latest()->first();
    //     $number = $lastTransaction ? ((int) substr($lastTransaction->kode_transaksi, 3, -1)) + 1 : 1;
    //     return 'TRX' . str_pad($number, 4, '0', STR_PAD_LEFT) . 'M';
    // }

    // public function update(Request $request, Transaksi $transaksi)
    // {
    //     $request->validate([
    //         'konsumen_id' => 'required|string',
    //         'kategori_id' => 'required|exists:kategori,id',
    //         'jumlah_barang' => 'required|integer',
    //         'bayar' => 'required|numeric',
    //         'tanggal_bayar' => 'required|date',
    //     ]);

    //     try {
    //         $transaksi->update($request->only('konsumen_id', 'kategori_id', 'jumlah_barang', 'bayar', 'tanggal_bayar'));
    //         return redirect()->route('transaksi.index')->with('success', 'Data berhasil diupdate');
    //     } catch (\Exception $e) {
    //         Log::error("Error mengupdate transaksi: " . $e->getMessage());
    //         return redirect()->back()->withErrors('Terjadi kesalahan saat mengupdate transaksi');
    //     }
    // }

    // public function destroy($id)
    // {
    //     try {
    //         Transaksi::findOrFail($id)->delete();
    //         return redirect()->route('transaksi.index')->with('success', 'Data berhasil dihapus');
    //     } catch (\Exception $e) {
    //         Log::error("Error menghapus transaksi: " . $e->getMessage());
    //         return redirect()->back()->withErrors('Terjadi kesalahan saat menghapus transaksi');
    //     }
    // }

    // public function cariItem(Request $request)
    // {
    //     $items = Kategori::where('kode', 'like', "%{$request->cari}%")
    //         ->orWhere('jenis_brg', 'like', "%{$request->cari}%")
    //         ->get();
    //     return response()->json($items);
    // }

    // public function cariPembayaran(Request $request)
    // {
    //     $pembayarans = Pembayaran::where('nama_pembayaran', 'like', "%{$request->cari}%")
    //         ->get(['id', 'nama_pembayaran', 'jenis_pembayaran']);
    //     return response()->json($pembayarans);
    // }

    // public function getHarga($id)
    // {
    //     $barang = Kategori::find($id);
    //     return $barang ? response()->json([
    //         'kode' => $barang->kode,
    //         'nama' => $barang->jenis_brg,
    //         'harga' => $barang->harga,
    //     ]) : response()->json(['error' => 'Barang tidak ditemukan'], 404);
    // }

