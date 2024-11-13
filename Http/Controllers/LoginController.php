<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function admin() {
        return view('page.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
    
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } elseif (Auth::user()->role === 'petugas') {
                return redirect()->route('dashboard.petugas');
            } elseif (Auth::user()->role == 'pimpinan') {
                return redirect()->route('dashboard.pimpinan');
            }
        } else {
            return redirect()->back()->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }
    

    public function logout() {
        Auth::logout();
        return redirect()->route('page.login'); // or use the route you want to redirect to
    }
    
    
    
}
