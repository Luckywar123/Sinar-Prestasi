<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\Student;
use App\Models\Answer;
use App\Models\ExamToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class SiswaController extends Controller
{
    public function goToDashboard()
    {
        return view('siswa.dashboard');
    }

    public function goToSimulasi()
    {
        return view('siswa.simulasi');
    }

    public function startSimulasi($category)
    {
        $user_id        = auth()->user()->user_id;
        $student        = Student::where('user_id', $user_id)->first();
        $current_time   = now();
        $current_status = 'Ongoing';
        $exam_type      = 'Simulasi';

        $current_simulation   = Exam::where('student_id', $student->student_id)
            ->where('exam_type', 'Test')
            ->where('exam_status', $current_status)
            ->get();

        if ($current_simulation->isNotEmpty()) {
            return redirect('siswa/simulasi')->with('error', 'Simulasi CAT sedang berlangsung. Silahkan selesaikan test yang sedan berjalan terlebih dahulu.');
        }

        $current_exam   = Exam::where('student_id', $student->student_id)
            ->where('exam_type', $exam_type)
            ->where('exam_status', $current_status)
            ->get();

        if ($current_exam->isEmpty()) {
            try {
                if ($category == "TKP") {
                    $limit = 45;
                } else if ($category == "TIU") {
                    $limit = 35;
                } else if ($category == "TWK") {
                    $limit = 30;
                }

                $questions = Question::inRandomOrder()
                    ->where('exam_type', $exam_type)
                    ->where('category', $category)
                    ->limit($limit)
                    ->get();

                if ($questions->isEmpty()) {
                    return redirect('siswa/simulasi')->with('warning', 'Tidak ada soal tersedia. Harap hubungi admin untuk konfirmasi lebih lanjut.');
                }

                if ($questions->count() < $limit) {
                    return redirect('siswa/dashboard')->with('warning', 'Jumlah soal yang tersedia kurang dari jumlah yang dibutuhkan. Harap hubungi admin untuk konfirmasi lebih lanjut.');
                }

                $exam = Exam::create([
                    'exam_type'     => "Simulasi",
                    'student_id'    => $student->student_id,
                    'exam_start'    => $current_time,
                    'exam_status'   => $current_status
                ]);

                foreach ($questions as $question) {
                    try {
                        $exam_answers = ExamAnswer::create([
                            'exam_id'       => $exam->exam_id,
                            'question_id'   => $question->question_id,
                        ]);
                    } catch (\Exception $e) {
                        return redirect('siswa/simulasi')->with('error', 'Terjadi kesalahan saat menyimpan data soal pada exam.');
                    }
                }

                $questions  = ExamAnswer::with('question.answer')->where('exam_id', $exam->exam_id)->get();

                // Ambil waktu mulai ujian dari tabel exam
                $examStart = $exam->exam_start;

                // Tambahkan 100 menit ke waktu mulai ujian
                $examEnd = Carbon::parse($examStart)->addMinutes(100);

                // Hitung sisa waktu yang tersisa
                $currentTime = Carbon::now();
                $remainingTime = $examEnd->diffInSeconds($currentTime);

                return view('siswa.latihan', compact('questions', 'remainingTime'));
            } catch (\Exception $e) {
                return redirect('siswa/simulasi')->with('error', 'Terjadi kesalahan saat menyimpan data exam.');
            }
        } else {
            if ($current_exam->count() > 0) {
                $exam_data   = Exam::where('student_id', $student->student_id)
                    ->where('exam_type', $exam_type)
                    ->where('exam_status', $current_status)
                    ->first();

                $exam               = Exam::findOrFail($exam_data->exam_id);
                $exam_answer        = ExamAnswer::with('answer')->where('exam_id', $exam->exam_id)->first();
                $ongoing_category   = $exam_answer->question->category;

                if ($ongoing_category != $category) {
                    return redirect('siswa/simulasi')->with('error', 'Latihan SKD dengan kategori ' . $ongoing_category . ' sedang berlangsung. Silahkan selesaikan test yang sedan berjalan terlebih dahulu.');
                }
            }

            $exam       = Exam::where('student_id', $student->student_id)->where('exam_status', $current_status)->first();
            $questions  = ExamAnswer::with('question.answer')->where('exam_id', $exam->exam_id)->get();

            // Ambil waktu mulai ujian dari tabel exam
            $examStart = $exam->exam_start;

            // Tambahkan 100 menit ke waktu mulai ujian
            $examEnd = Carbon::parse($examStart)->addMinutes(100);

            // Hitung sisa waktu yang tersisa
            $currentTime = Carbon::now();

            if ($currentTime > $examEnd) {
                $exam_scores    = 0;
                foreach ($questions as $exam_answer) {
                    if ($exam_answer->answer_id == NULL) {
                        $exam_answer_data = ExamAnswer::findOrFail($exam_answer->exam_answer_id);
                        $exam_answer_data->is_false = 1;
                        $exam_answer_data->save();
                        continue;
                    }
                    $exam_scores += $exam_answer->answer->answer_score;
                }

                $exam->exam_score   = $exam_scores;
                $exam->exam_finish  = $examEnd;
                $exam->exam_status  = 'Finish';
                $exam->save();

                return redirect('/siswa/after-test/' . $exam->exam_id);
                // return redirect()->back()->with('error', 'Waktu test Anda sebelumnya telah berakhir.')->withInput();
            } else if ($currentTime < $examEnd) {
                $remainingTime = $examEnd->diffInSeconds($currentTime);
                return view('siswa.latihan', compact('questions', 'remainingTime'));
            } else {
                return redirect('siswa/simulasi')->with('error', 'Status waktu test tidak dapat ditentukan.');
            }
        }
    }

    public function simpanJawabanSimulasi($exam_answer_id, Request $request)
    {

        try {
            $exam_answer = ExamAnswer::with('question.answer')->where('exam_answer_id', $exam_answer_id)->first();

            // Variabel untuk menyimpan skor terendah
            $lowestScore = null;

            // Loop melalui semua jawaban pada pertanyaan yang sama
            foreach ($exam_answer->question->answer as $answer) {
                // Simpan skor jawaban saat ini ke dalam array
                $scores[] = $answer->answer_score;
            }

            // Temukan skor terendah dalam array menggunakan fungsi min()
            $lowestScore = min($scores);

            $answer = Answer::findOrFail($request->answerId);

            // Bandingkan skor jawaban tertentu dengan skor terendah
            if ($answer->answer_score == $lowestScore) {
                // Jika skor jawaban tertentu sama dengan skor terendah, maka jawaban tersebut memiliki skor terendah
                $is_false = 1;
            } else {
                // Jika tidak, maka jawaban tersebut tidak memiliki skor terendah
                $is_false = 0;
            }

            // Update data lainnya
            $exam_answer->answer_id = $request->answerId;
            $exam_answer->is_false   = $is_false;

            $exam_answer->save();

            return response()->json([
                'status'  => "Success",
                'message' => 'Data jawaban simulasi telah berhasil disimpan.',
                'message' => $lowestScore
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan jawaban simulasi',
                'data'    => $e
            ], 500);
        }
    }

    public function selesaiSimulasi(Request $request)
    {
        $user_id        = auth()->user()->user_id;
        $student        = Student::where('user_id', $user_id)->first();
        $current_time   = now();
        $current_status = 'Ongoing';
        $new_status     = 'Finish';
        $exam_scores    = 0;

        $exam           = Exam::where('student_id', $student->student_id)->where('exam_status', $current_status)->first();

        $exam_answers   = ExamAnswer::with('answer')->where('exam_id', $exam->exam_id)->get();

        foreach ($exam_answers as $exam_answer) {
            if ($exam_answer->answer_id == NULL) {

                $exam_answer_data = ExamAnswer::findOrFail($exam_answer->exam_answer_id);
                $exam_answer_data->is_false = 1;
                $exam_answer_data->save();

                continue;
            }

            if ($exam_answer->is_false == 0) {
                $exam_scores += $exam_answer->answer->answer_score;
            }
        }

        $exam->exam_score   = $exam_scores;
        $exam->exam_finish  = $current_time;
        $exam->exam_status  = $new_status;
        $exam->save();

        return redirect('/siswa/after-test/' . $exam->exam_id);
    }

    public function afterTest($exam_id)
    {
        $exam           = Exam::findOrFail($exam_id);
        $exam_answer    = ExamAnswer::with('answer')->where('exam_id', $exam->exam_id)->first();
        $category = $exam_answer->question->category;

        return view('siswa.after_test', ["exam" => $exam, "category" => $category]);
    }

    public function scoreTest($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);

        $data = [];
        $overall_score = 0;
        $category = "";

        if ($exam->exam_type == "Simulasi") {
            $exam_answers = ExamAnswer::with(['answer'])
                ->where('exam_id', $exam_id)
                ->get();

            $is_false_count = $exam_answers->where('is_false', true)->count();

            $question_category_data = ExamAnswer::with(['answer'])
                ->where('exam_id', $exam_id)
                ->first();

            $category_data = $question_category_data->question->category;

            if ($category_data == "TKP") {
                $category = "Tes Karakteristik Pribadi (TKP)";
                $limit = 45;
            } else if ($category_data == "TIU") {
                $category = "Tes Intelegensi Umum (TIU)";
                $limit = 35;
            } else if ($category_data == "TWK") {
                $category = "Tes Wawasan Kebangsaan (TWK)";
                $limit = 30;
            }

            $is_true = $limit - $is_false_count;

            $exam_scores = $exam_answers->sum(function ($exam_answer) {
                return $exam_answer->answer->answer_score ?? 0;
            });

            $overall_score = $exam_scores;

            $data = (object) [
                'Category'   => $category,
                'Total_Soal'  => $limit,
                'Jawaban_Benar' => $is_true,
                'Nilai' => $exam_scores,
                'Type' => $category_data
            ];
        } else if ($exam->exam_type == "Test") {
            $exam_answers = ExamAnswer::with(['answer', 'question'])
                ->where('exam_id', $exam_id)
                ->get();

            $categories = [];

            foreach ($exam_answers as $exam_answer) {
                $category = $exam_answer->question->category;

                if (!isset($categories[$category])) {
                    $categories[$category] = [
                        'Category' => $category,
                        'Total_Soal' => 0,
                        'Jawaban_Benar' => 0,
                        'Nilai' => 0
                    ];
                }

                $categories[$category]['Total_Soal']++;

                if (!$exam_answer->is_false) {
                    $categories[$category]['Jawaban_Benar']++;
                }

                if ($exam_answer->answer_id !== null && $exam_answer->is_false == 0) {
                    $categories[$category]['Nilai'] += $exam_answer->answer->answer_score;
                }
            }

            foreach ($categories as $category) {
                $overall_score += $category['Nilai'];
            }

            // Mengirimkan data
            $data = $categories;
            $data["Type"] = "Test";
        }

        // Kirim data ke view
        return view('siswa.nilai', ['data' => $data, 'overall_score' => $overall_score]);
    }

    public function hasilTest($exam_id)
    {
        $questions = ExamAnswer::with('question.answer')->where('exam_id', $exam_id)->get();

        // Inisialisasi array untuk menyimpan nilai minimum dan maksimum setiap pertanyaan
        $minScores = [];
        $maxScores = [];

        // Iterasi untuk setiap pertanyaan
        foreach ($questions as $question) {
            // Inisialisasi nilai minimum dan maksimum untuk pertanyaan saat ini
            $minScore = null;
            $maxScore = null;

            // Iterasi untuk setiap jawaban pada pertanyaan saat ini
            foreach ($question->question->answer as $answer) {
                // Jika nilai minimum belum diatur atau skor jawaban saat ini lebih kecil dari nilai minimum saat ini
                if ($minScore === null || $answer->answer_score < $minScore) {
                    // Perbarui nilai minimum
                    $minScoreId = $answer->answer_id;
                    $minScore = $answer->answer_score;
                }
                // Jika nilai maksimum belum diatur atau skor jawaban saat ini lebih besar dari nilai maksimum saat ini
                if ($maxScore === null || $answer->answer_score > $maxScore) {
                    // Perbarui nilai maksimum
                    $maxScoreId = $answer->answer_id;
                    $maxScore = $answer->answer_score;
                }
            }

            // Simpan nilai minimum dan maksimum untuk pertanyaan saat ini ke dalam array minScores dan maxScores
            $minScores[$question->question_id] = $minScoreId;
            $maxScores[$question->question_id] = $maxScoreId;
        }

        return view('siswa.hasil', compact('questions', 'minScores', 'maxScores'));
    }

    public function startTest(Request $request)
    {
        $token          = $request->token;
        $token_data     = ExamToken::where('token', $token)->WHERE('status', 'Simulasi')->first();


        if (empty($token_data)) {
            return redirect()->back()->with('error', 'Token yang Anda masukkan tidak valid')->withInput();
        } else {
            $user_id        = auth()->user()->user_id;
            $student        = Student::where('user_id', $user_id)->first();
            $current_time   = now();
            $current_status = 'Ongoing';
            $categories     = ['TWK', 'TIU', 'TKP'];
            $exam_type      = "Test";
            $questions = collect(); // Inisialisasi koleksi untuk menyimpan semua pertanyaan

            $exam_status    = Exam::where('student_id', $student->student_id)
                ->where('exam_type', 'Test')
                ->where('exam_status', 'Finish')
                ->where('token', $token)
                ->get();

            if ($exam_status->isNotEmpty()) {
                return redirect()->back()->with('error', 'Token yang Anda masukkan telah digunakan sebelumnya.')->withInput();
            }

            $current_simulation   = Exam::where('student_id', $student->student_id)
                ->where('exam_type', 'Simulasi')
                ->where('exam_status', $current_status)
                ->get();

            if ($current_simulation->isNotEmpty()) {
                return redirect('siswa/simulasi')->with('error', 'Latihan SKD sedang berlangsung. Silahkan selesaikan latihan yang sedan berjalan terlebih dahulu.');
            }

            $current_exam   = Exam::where('student_id', $student->student_id)
                ->where('exam_type', 'Test')
                ->where('exam_status', $current_status)
                ->get();

            if ($current_exam->isEmpty()) {
                try {
                    foreach ($categories as $category) {

                        if ($category == "TKP") {
                            $limit = 45;
                        } else if ($category == "TIU") {
                            $limit = 35;
                        } else if ($category == "TWK") {
                            $limit = 30;
                        }

                        // Ambil daftar ID ujian yang pernah dikerjakan oleh siswa
                        $examIdsByStudent = Exam::where('student_id', $student->student_id)->pluck('exam_id');

                        // Ambil daftar ID pertanyaan yang pernah dikerjakan oleh siswa
                        $answeredQuestionIds = ExamAnswer::whereIn('exam_id', $examIdsByStudent)->pluck('question_id');

                        // Mengambil pertanyaan untuk setiap kategori
                        $questionsPerCategory = Question::inRandomOrder()
                            ->where('exam_type', $exam_type)
                            ->where('category', $category)
                            // ->whereNotIn('question_id', $answeredQuestionIds)
                            ->limit($limit)
                            ->get();

                        // Menggabungkan pertanyaan dari setiap kategori ke dalam koleksi utama
                        $questions = $questions->merge($questionsPerCategory);

                        if ($questions->isEmpty()) {
                            return redirect('siswa/dashboard')->with('warning', 'Tidak ada soal tersedia untuk kategori ' . $category . '. Harap hubungi admin untuk konfirmasi lebih lanjut.');
                        }
                    }

                    if ($questions->count() < 110) {
                        return redirect('siswa/dashboard')->with('warning', 'Jumlah soal yang tersedia kurang dari jumlah yang dibutuhkan. Harap hubungi admin untuk konfirmasi lebih lanjut.');
                    }

                    $exam = Exam::create([
                        'exam_type'     => $exam_type,
                        'student_id'    => $student->student_id,
                        'exam_start'    => $current_time,
                        'exam_status'   => $current_status,
                        'token'         => $token
                    ]);

                    foreach ($questions as $question) {
                        try {
                            $exam_answers = ExamAnswer::create([
                                'exam_id'       => $exam->exam_id,
                                'question_id'   => $question->question_id,
                            ]);
                        } catch (\Exception $e) {
                            return redirect('siswa/simulasi')->with('error', 'Terjadi kesalahan saat menyimpan data soal pada exam.');
                        }
                    }

                    $questions  = ExamAnswer::with('question.answer')->where('exam_id', $exam->exam_id)->get();

                    // Ambil waktu mulai ujian dari tabel exam
                    $examStart = $exam->exam_start;

                    // Tambahkan 100 menit ke waktu mulai ujian
                    $examEnd = Carbon::parse($examStart)->addMinutes(100);

                    // Hitung sisa waktu yang tersisa
                    $currentTime = Carbon::now();
                    $remainingTime = $examEnd->diffInSeconds($currentTime);

                    return view('siswa.latihan', compact('questions', 'remainingTime'));
                } catch (\Exception $e) {
                    return redirect('siswa/simulasi')->with('error', 'Terjadi kesalahan saat menyimpan data exam.');
                }
            } else {
                $exam       = Exam::where('student_id', $student->student_id)->where('exam_status', $current_status)->first();
                $questions  = ExamAnswer::with('question.answer')->where('exam_id', $exam->exam_id)->get();

                // Ambil waktu mulai ujian dari tabel exam
                $examStart = $exam->exam_start;

                // Tambahkan 100 menit ke waktu mulai ujian
                $examEnd = Carbon::parse($examStart)->addMinutes(100);

                // Hitung sisa waktu yang tersisa
                $currentTime = Carbon::now();

                if ($currentTime > $examEnd) {
                    $exam_scores    = 0;
                    foreach ($questions as $exam_answer) {
                        if ($exam_answer->answer_id == NULL) {
                            $exam_answer_data = ExamAnswer::findOrFail($exam_answer->exam_answer_id);
                            $exam_answer_data->is_false = 1;
                            $exam_answer_data->save();
                            continue;
                        }
                        $exam_scores += $exam_answer->answer->answer_score;
                    }

                    $exam->exam_score   = $exam_scores;
                    $exam->exam_finish  = $examEnd;
                    $exam->exam_status  = 'Finish';
                    $exam->save();

                    return redirect('/siswa/after-test/' . $exam->exam_id);
                    // return redirect()->back()->with('error', 'Waktu test Anda sebelumnya telah berakhir.')->withInput();
                } else if ($currentTime < $examEnd) {
                    $remainingTime = $examEnd->diffInSeconds($currentTime);
                    return view('siswa.latihan', compact('questions', 'remainingTime'));
                } else {
                    return redirect()->back()->with('error', 'Status waktu test tidak dapat ditentukan.')->withInput();
                }
            }
        }
    }

    public function ubahProfil($user_id)
    {
        $student_data = User::with('student')->findOrFail($user_id);
        return view('siswa.ubah_profil', ["student_data" => $student_data]);
    }

    public function updateProfil($student_id, Request $request)
    {
        try {
            $auth = Auth::user();

            $user = User::findOrFail($auth->user_id);

            // Update data lainnya
            $user->full_name    = $request->full_name;
            $user->username     = $request->username;
            $user->email        = $request->email;

            // Jika password baru diisi, enkripsi dan simpan
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            try {
                $student = Student::findOrFail($student_id);

                // Update data lainnya
                $student->birth_place   = $request->birth_place;
                $student->birth_date    = $request->birth_date;
                $student->gender        = $request->gender;
                $student->address       = $request->address;
                $student->school_name   = $request->school_name;

                if ($request->hasFile('profile_image')) {
                    $path = $request->file('profile_image')->storeAs(
                        'public/profile_image',
                        $request->file('profile_image')->getClientOriginalName()
                    );

                    $path = str_replace('public/', '', $path);
                    $student->profile_image_url = $path;
                }

                $student->save();

                $request->session()->flash('success', 'Profil berhasil diperbarui.');
                return redirect()->route('ubahProfil', ['user_id' => $user->user_id]);
            } catch (\Exception $e) {
                $request->session()->flash('error', 'Terjadi kesalahan saat memperbaharaui data siswa.');
                return redirect()->route('ubahProfil', ['user_id' => $user->user_id]);
            }
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Terjadi kesalahan saat memperbaharaui akun siswa.');
            return redirect()->route('ubahProfil', ['user_id' => $user->user_id]);
        }
    }

    // public function riwayatTest()
    // {
    //     $auth       = Auth::user();
    //     $user_id    = $auth->user_id;
    //     $student    = Student::WHERE('user_id', $user_id)->first();
    //     $exams      = Exam::WHERE('student_id', $student->student_id)->ORDERBY('created_at', 'DESC')->LIMIT(10)->get();
    //     return view('siswa.riwayat', ['exams' => $exams]);
    // }

    public function riwayatTest()
    {
        $auth       = Auth::user();
        $user_id    = $auth->user_id;
        $student    = Student::WHERE('user_id', $user_id)->first();
        $student_id = $student->student_id;

        $examData = Exam::with('exam_answer')
            ->WHERE('student_id', $student_id)
            ->ORDERBY('created_at', 'DESC')
            ->LIMIT(10)
            ->get();

        foreach ($examData as $data) {
            $tkpScore = 0;
            $tiuScore = 0;
            $twkScore = 0;

            foreach ($data->exam_answer as $exam_answer) {
                $category = $exam_answer->question->category;

                if ($category == "TKP") {
                    if ($exam_answer->answer_id !== null && $exam_answer->is_false == 0) {
                        $tkpScore += $exam_answer->answer->answer_score;
                    }
                } else if ($category == "TIU") {
                    if ($exam_answer->answer_id !== null && $exam_answer->is_false == 0) {
                        $tiuScore += $exam_answer->answer->answer_score;
                    }
                } else if ($category == "TWK") {
                    if ($exam_answer->answer_id !== null && $exam_answer->is_false == 0) {
                        $twkScore += $exam_answer->answer->answer_score;
                    }
                }
            }

            $data->tkpScore = $tkpScore;
            $data->tiuScore = $tiuScore;
            $data->twkScore = $twkScore;

        }

        return view('siswa.riwayat', ['exams' => $examData]);
    }

    public function downloadSoal(Request $request)
    {
        $token = $request->token;
        $exam_id = $request->exam_id;

        $token_data = ExamToken::where('token', $token)->where('status', 'Download')->first();

        if (empty($token_data)) {
            return redirect()->back()->with('error', 'Token yang Anda masukkan tidak valid')->withInput();
        } else {
            $auth = Auth::user();
            $student = Student::where('user_id', $auth->user_id)->first();

            $exam = Exam::where('student_id', $student->student_id)->where('exam_id', $exam_id)->first();
            $questions = ExamAnswer::with('question.answer')->where('exam_id', $exam->exam_id)->get();

            // Redirect to printSoal route with questions data
            return view('siswa.print-soal', compact('questions'));
        }
    }

    public function printSoal($questions)
    {
        // Here, $questions will be an array of ExamAnswer objects with nested question and answer relations
        // You can further process this data or pass it to a view as needed
        return view('siswa.print-soal', compact('questions'));
    }
}
