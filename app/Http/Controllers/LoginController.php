<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Mengambil data pengguna yang berhasil diautentikasi
            $user = Auth::user();

            // Memeriksa nilai field 'role' dari pengguna
            if($user->role === 'Admin Soal') {
                return redirect()->intended('/admin/list-data-guru');
            } elseif ($user->role === 'Guru') {
                return redirect()->intended('/guru/rekap');
            } elseif ($user->role === 'Siswa') {
                return redirect()->intended('/siswa/dashboard');
            } else {
                return back()->with('loginError', 'Role pengguna tidak valid!');
            }
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
