<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function tambahDataSoal()
    {
        return view('admin.soal.data_soal');
    }

    public function simpanDataSoal(Request $request)
    {
        $user = auth()->user()->user_id;

        try {
            // Membuat instansi objek pertanyaan tanpa menyimpannya ke database
            $question = new Question();
            $question->category = $request->category;
            $question->sub_category = $request->sub_category;
            $question->exam_type = $request->exam_type;

            // Simpan objek pertanyaan ke dalam session
            $request->session()->put('question', $question);

            return redirect()->route('tambahDetailSoal');
        } catch (\Exception $e) {
            return redirect('admin/tambah-data-soal')->with('error', 'Terjadi kesalahan saat menyimpan data kategori dan subkategori.');
        }
    }

    public function tambahDetailSoal(Request $request)
    {
        return view('admin.soal.detail_soal');
    }

    public function simpanDetailSoal(Request $request)
    {
        try {
            // Validasi input menggunakan Validator
            $question_validation = Validator::make($request->all(), [
                'question_text' => 'required|string|max:7500',
            ]);

            // Cek jika validasi gagal
            if ($question_validation->fails()) {
                return redirect('admin/tambah-data-soal')->with('error', 'Gagal menyimpan soal. Soal yang Anda masukkan melebihi 7500 karakter.');
            }

            $question_session = $request->session()->get('question');
            $user_id = auth()->user()->user_id;
            // $question = Question::findOrFail($question_id);

            // Update data lainnya
            $question = Question::create([
                'category'      => $question_session->category,
                'sub_category'  => $question_session->sub_category,
                'exam_type'     => $question_session->exam_type,
                'user_id'       => $user_id,
                'question_text' => $request->question_text
            ]);

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->storeAs(
                    'public/question_image', $request->file('gambar')->getClientOriginalName()
                );

                $path = str_replace('public/', '', $path);
                $question->question_image_url = $path;
            }

            $question->save();

            $question_id = $question->question_id;

            try{

                if($request->selectedOption == "text"){
                    $jawabanKeys = preg_grep('/^textJawaban\d+$/', array_keys($request->all()));
                }else if($request->selectedOption == "image"){
                    $jawabanKeys = preg_grep('/^imageJawaban\d+$/', array_keys($request->all()));
                }

                if (!empty($jawabanKeys)) {
                    foreach ($jawabanKeys as $key) {
                        if($request->selectedOption == "text"){
                            $index = substr($key, strlen('textJawaban'));
                            $textJawaban = $request->input($key);

                            // Validasi input menggunakan Validator
                            $answer_validation = Validator::make(['textJawaban' => $textJawaban], [
                                'textJawaban' => 'required|string|max:7500',
                            ]);

                            // Cek jika validasi gagal
                            if ($answer_validation->fails()) {
                                Question::destroy($question_id);
                                Answer::destroy($question_id);
                                return redirect('admin/tambah-data-soal')->with('error', 'Gagal menyimpan jawaban. Jawaban yang Anda masukkan melebihi 7500 karakter.');
                            }

                        }else if($request->selectedOption == "image"){
                            $index = substr($key, strlen('imageJawaban'));
                            $imageJawaban = $request->file($key);

                            $path = $request->file($key)->storeAs(
                                'public/answer_image', $request->file($key)->getClientOriginalName()
                            );

                            $path = str_replace('public/', '', $path);
                            $answer_image_url = $path;
                        }

                        $score = $request->input('score' . $index);

                        if($request->selectedOption == "text"){
                            Answer::create([
                                'question_id'   => $question->question_id,
                                'answer_text'   => $textJawaban,
                                'answer_score'  => $score
                            ]);
                        }else if($request->selectedOption == "image"){
                            Answer::create([
                                'question_id'       => $question->question_id,
                                'answer_image_url'  => $answer_image_url,
                                'answer_score'      => $score
                            ]);
                        }
                    }
                    return redirect('admin/tambah-detail-soal')->with('success', 'Data soal, detail soal, dan jawaban berhasil disimpan.');
                }
            } catch (\Exception $e) {
                return redirect('admin/tambah-detail-soal')->with('error', 'Terjadi kesalahan saat menyimpan jawaban soal.');

            }
        } catch (\Exception $e) {
            return redirect('admin/tambah-detail-soal')->with('error', 'Terjadi kesalahan saat menyimpan data soal.');
        }
    }
}
