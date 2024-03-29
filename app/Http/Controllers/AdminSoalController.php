<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
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

    public function tambahDataSoal()
    {
        return view('admin.soal.data_soal');
    }

    public function simpanDataSoal(Request $request)
    {
        $user = auth()->user()->user_id;

        try {
            $question = Question::create([
                'category'      => $request->category,
                'sub_category'  => $request->sub_category,
                'exam_type'     => $request->exam_type,
                'user_id'       => $user
            ]);

            $question_id = $question->question_id;
            // $question_id = 1;
            return redirect()->route('tambahDetailSoal', ['question_id' => $question_id]);
        } catch (\Exception $e) {
            return redirect('admin/tambah-data-soal')->with('error', 'Terjadi kesalahan saat menyimpan data soal.');
        }
    }

    public function tambahDetailSoal($question_id)
    {
        $question       = Question::findOrFail($question_id);
        $question_id    = $question->question_id;
        return view('admin.soal.detail_soal', ["question_id" => $question_id]);
    }

    public function simpanDetailSoal($question_id, Request $request)
    {
        try {
            $question = Question::findOrFail($question_id);

            // Update data lainnya
            $question->question_text = $request->question_text;

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->storeAs(
                    'public/question_image', $request->file('gambar')->getClientOriginalName()
                );

                $path = str_replace('public/', '', $path);
                $question->question_image_url = $path;
            }

            $question->save();

            try{

                if($request->selectedOption == "text"){
                    $jawabanKeys = preg_grep('/^textJawaban\d+$/', array_keys($request->all()));
                }else if($request->selectedOption == "image"){
                    $jawabanKeys = preg_grep('/^imageJawaban\d+$/', array_keys($request->all()));
                }

                // dd($jawabanKeys);
                // $scoresKeys = preg_grep('/^score\d+$/', array_keys($request->all()));

                if (!empty($jawabanKeys)) {
                    foreach ($jawabanKeys as $key) {
                        if($request->selectedOption == "text"){
                            $index = substr($key, strlen('textJawaban'));
                            $textJawaban = $request->input($key);
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
                    return redirect('admin/tambah-data-soal')->with('success', 'Data soal, detail soal, dan jawaban berhasil disimpan.');
                }
            } catch (\Exception $e) {
                return redirect('admin/tambah-data-soal')->with('error', 'Terjadi kesalahan saat menyimpan jawaban soal.');

            }
        } catch (\Exception $e) {
            return redirect('admin/tambah-data-soal')->with('error', 'Terjadi kesalahan saat menyimpan detail soal.');
        }
    }
}
