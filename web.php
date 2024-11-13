<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkunPetugasController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProsesTransaksiController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function() {
    return redirect('/login');
});


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'admin'])->name('page.login');
Route::post('/login', [LoginCOntroller::class, 'login'])->name('page.login');

Route::middleware(['guest'])->group(function () {

});


Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'adminDashboard'])->name('dashboard.admin');

    Route::get('/data/konsumen', [KonsumenController::class, 'index'])->name('konsumen.index');
    Route::post('/data/konsumen', [KonsumenController::class, 'store'])->name('konsumen.store');
    Route::get('/konsumen/create', [KonsumenController::class, 'create'])->name('konsumen.create');
    Route::get('/konsumen/edit{id}', [KonsumenController::class, 'edit'])->name('konsumen.edit');
    Route::put('/konsumen/update/{id}', [KonsumenController::class, 'update'])->name('konsumen.update');
    Route::delete('/konsumen/destroy{id}', [KonsumenController::class, 'destroy'])->name('konsumen.destroy');

    Route::get('/data/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::post('/data/petugas', [PetugasController::class, 'store'])->name('petugas.store');
    Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
    Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('petugas.edit');
    Route::put('/petugas/{id}', [PetugasController::class, 'update'])->name('petugas.update');    
    Route::delete('/petugas/destroy{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::get('/kategori/show/{id}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::get('/pembayaran/edit{id}', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
    Route::put('/pembayaran/update{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
    Route::delete('/pembayaran/destroy{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

    // Route::get('/transaksi', [ProsesTransaksiController::class, 'index'])->name('transaksi.index');
    // Route::post('/transaksi/store', [ProsesTransaksiController::class, 'store'])->name('transaksi.store');
    // Route::get('/transaksi/create', [ProsesTransaksiController::class, 'create'])->name('transaksi.create');
    // Route::get('/search/barang', [ProsesTransaksiController::class, 'searchBarang'])->name('transaksi.searchBarang');  

    // Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    // Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    // Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    // Route::get('/transaksi/edit{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    // Route::get('/transaksi/cari-item', [TransaksiController::class, 'cariItem'])->name('transaksi.cariItem');
    // Route::get('/transaksi/tambahItem{id}', [TransaksiController::class, 'tambahItem'])->name('transaksi.tambahItem');
    // Route::get('/transaksi/get-harga/{id}', [TransaksiController::class, 'getHarga']);
    // Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');
    // Route::get('/transaksi/cari-pembayaran', [TransaksiController::class, 'cariPembayaran']);
    // Route::get('/transaksi/cari-item', [TransaksiController::class, 'cariItem']);

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::delete('/transaksi/destroy{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    
});

Route::middleware(['auth', 'userAkses:petugas'])->group(function () {
    Route::get('/dashboard/petugas', [AdminController::class, 'petugasDashboard'])->name('dashboard.petugas');
});

Route::middleware(['auth', 'userAkses:pimpinan'])->group(function () {
    Route::get('/dashboard/pimpinan', [AdminController::class, 'pimpinanDashboard'])->name('dashboard.pimpinan');
});
     


