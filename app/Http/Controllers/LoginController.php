<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Validasi apakah pengguna dengan username yang diberikan ada dalam database
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return back()->with('error', 'Username tidak terdaftar.');
        }

        // Jika pengguna ditemukan, lakukan otentikasi
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Memeriksa nilai field 'role' dari pengguna
            if ($user->role === 'Admin Soal') {
                return redirect()->intended('/admin/list-data-guru');
            } elseif ($user->role === 'Guru') {
                return redirect()->intended('/guru/recap-data-siswa');
            } elseif ($user->role === 'Siswa') {
                return redirect()->intended('/siswa/dashboard');
            } else {
                return back()->with('error', 'Role pengguna tidak valid!');
            }
        }

        // Jika otentikasi gagal, kembalikan dengan pesan kesalahan yang sesuai
        return back()->with('error', 'Password tidak sesuai.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
