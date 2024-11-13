<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function adminDashboard()
    {
        $totalKategori = Kategori::count();
        $totalPetugas = Petugas::count();
        $header = 'Beranda';
        return view('page.dashboard', compact('header', 'totalPetugas', 'totalKategori'));
    }

    public function petugasDashboard()
    {
        $header = 'Beranda';
        return view('page.dashboard', compact('header'));
    }

    public function pimpinanDashboard()
    {
        $header = 'Beranda';
        return view('page.dashboard', compact('header'));
    }

    // public function admin() {
    //     return view('page.dashboard', [
    //         'title' => 'Halaman Admin'  
    //     ]);

    //     if(Auth::user()->role != 'admin') {
    //         return redirect()->route('page.login')->with('error', 'Anda tidak memiliki akses ke halaman ini');
    //     }
    // }

    // public function contoh () {
    //     $header = Auth::user()->role == 'admin' ? 'Hallo Admin' : 'Hallo User';
    //     return view('page.dashboard', compact('header'));
    // }


    
}
