<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSoalController extends Controller
{
    public function listDataGuru()
    {
        $users = User::where('role', 'Guru')->get();
        return view('admin.guru.index', ["users" => $users]);
    }

    public function tambahDataGuru()
    {
        return view('admin.guru.create');
    }

    public function simpanDataGuru(Request $request)
    {
        try {
            User::create([
                'full_name' => $request->full_name,
                'username'  => $request->username,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => 'Guru'
            ]);
            return redirect('admin/list-data-guru')->with('success', 'Data guru berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect('admin/list-data-guru')->with('error', 'Terjadi kesalahan saat menambahkan data guru.');
        }
    }

    public function ubahDataGuru($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.guru.edit', ["user" => $user]);
    }

    public function updateDataGuru($user_id, Request $request)
    {
        try {
            $user = User::findOrFail($user_id);

            // Update data lainnya
            $user->full_name    = $request->full_name;
            $user->username     = $request->username;
            $user->email        = $request->email;

            // Jika password baru diisi, enkripsi dan simpan
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect('admin/list-data-guru')->with('success', 'Data guru berhasil diubah.');
        } catch (\Exception $e) {
            return redirect('admin/list-data-guru')->with('error', 'Terjadi kesalahan saat mengubah data guru.');
        }
    }

    public function deleteDataGuru($user_id)
    {
        try{
            User::destroy($user_id);
            return redirect('admin/list-data-guru')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('admin/list-data-guru')->with('error', 'Terjadi kesalahan saat menghapus data guru.');
        }
    }
}
