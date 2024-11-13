<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Konsumen;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ProsesTransaksiController extends Controller
{
    public function index()
    {
        // Ambil data transaksi dengan relasi ke konsumen dan kategori
        $transaksi = Transaksi::with(['konsumen', 'kategori'])->get();
        return view('proses.index', compact('transaksi'));
    }

    public function create()
    {
        // Ambil data kategori dan pembayaran
        $kategori = Kategori::all();
        $pembayaran = Pembayaran::all();
        return view('proses.create', compact('kategori', 'pembayaran'));
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'konsumen_id' => 'required|exists:konsumen,id',
            'bayar' => 'required|numeric|min:1',
            'barang' => 'required|array',
            'barang.*.id' => 'required|exists:kategori,id',
            'barang.*.jumlah' => 'required|numeric|min:1',
        ]);
    
        // Hitung total harga berdasarkan barang yang dibeli
        $total_harga = 0;
        foreach ($request->barang as $item) {
            $total_harga += $item['harga'] * $item['jumlah'];
        }
    
        // Simpan transaksi
        $transaksi = new Transaksi();
        $transaksi->konsumen_id = $request->konsumen_id;
        $transaksi->kode_transaksi = 'TRX' . str_pad(Transaksi::count() + 1, 4, '0', STR_PAD_LEFT) . 'M';
        $transaksi->total_harga = $total_harga;
        $transaksi->bayar = $request->bayar;
        $transaksi->kembalian = $request->bayar - $total_harga;
        $transaksi->tanggal_bayar = now();
        $transaksi->save();
    
        // Menyimpan barang yang dibeli dalam tabel transaksi_detail
        foreach ($request->barang as $item) {
            $transaksi->detail()->create([
                'kategori_id' => $item['id'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
                'total_harga' => $item['harga'] * $item['jumlah'],
            ]);
        }
    
        // Kembali ke halaman transaksi dengan status sukses
        return redirect()->route('proses.index')->with('success', 'Transaksi berhasil disimpan.');
    }
    

    public function searchBarang(Request $request)
    {
        $query = $request->get('q');
        $barang = Kategori::where('kode', 'like', "%{$query}%")
                        ->orWhere('jenis_brg', 'like', "%{$query}%")
                        ->get();
        return response()->json($barang);
    }

}
