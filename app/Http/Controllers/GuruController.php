<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamToken;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function listDataSiswa()
    {
        $students = Student::all();
        return view('guru.siswa.index', ["students" => $students]);
    }

    public function tambahDataSiswa()
    {
        return view('guru.siswa.create');
    }

    public function simpanDataSiswa(Request $request)
    {
        $student_number = $this->generateStudentNumber();

        try {
            $user = User::create([
                'full_name' => $request->full_name,
                'username'  => $request->username,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => 'Siswa'
            ]);

            try {
                Student::create([
                    'student_number'    => $student_number,
                    'user_id'           => $user->user_id,
                    'birth_place'       => $request->birth_place,
                    'birth_date'        => $request->birth_date,
                    'gender'            => $request->gender
                ]);

                return redirect('guru/list-data-siswa')->with('success', 'Data siswa dan akun siswa berhasil ditambahkan.');
            }catch (\Exception $e) {
                return redirect('guru/list-data-siswa')->with('error', 'Terjadi kesalahan saat menambahkan data siswa.');
            }
        } catch (\Exception $e) {
            return redirect('guru/list-data-siswa')->with('error', 'Terjadi kesalahan saat menambahkan data akun siswa.');
        }
    }

    public function detailDataSiswa($student_id)
    {
        $student = Student::findOrFail($student_id);
        return view('guru.siswa.detail', ["student" => $student]);
    }

    public function deleteDataSiswa($student_id)
    {
        $student    = Student::findOrFail($student_id);
        $user_id    = $student->user_id;

        try{
            Student::destroy($student_id);
            try{
                User::destroy($user_id);
                return redirect('guru/list-data-siswa')->with('success', 'Data siswa dan akun siswa berhasil dihapus.');
            } catch (\Exception $e) {
                return redirect('guru/list-data-siswa')->with('error', 'Terjadi kesalahan saat menghapus data akun siswa.');
            }
        } catch (\Exception $e) {
            return redirect('guru/list-data-siswa')->with('error', 'Terjadi kesalahan saat menghapus data siswa.');
        }
    }

    function generateStudentNumber() {
        // Mendapatkan tahun sekarang
        $year = date("Y");

        // Mendapatkan timestamp saat ini
        $timestamp = time();

        // Menggabungkan prefix, tahun, dan timestamp untuk membentuk nomor peserta/siswa
        $student_number = $year . $timestamp;

        return $student_number;
    }

    public function recapDataSiswa() {
        $exams  = Exam::with('exam_answer')->get();

        return view('guru.rekap', ["exams" => $exams]);
    }

    public function generateToken($length = 6) {
        //Gete user_id from auth session
        $user_id = auth()->user()->user_id;

        // Karakter yang diizinkan untuk digunakan dalam token
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Mengacak karakter dan memilih panjang token yang diinginkan
        $token = '';
        $maxIndex = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[mt_rand(0, $maxIndex)];
        }

        $currentToken = ExamToken::where('user_id', $user_id)->WHERE('status', 'Simulasi')->first();

        if(!empty($currentToken)){
            ExamToken::destroy($currentToken->exam_token_id);
        }

        ExamToken::create([
            'token'     => $token,
            'user_id'   => $user_id,
            'status'    => 'Simulasi'
        ]);

        return response()->json([
            'status'  => "Success",
            'message' => 'Data token',
            'data'    => $token
        ], 201);
    }

    public function getToken() {
        //Gete user_id from auth session
        $user_id = auth()->user()->user_id;

        $currentToken = ExamToken::where('user_id', $user_id)->WHERE('status', 'Simulasi')->first();

        if(empty($currentToken)){
            $token = '-';
        }else{
            $token = $currentToken->token;
        }

        return response()->json([
            'status'  => "Success",
            'message' => 'Data token',
            'data'    => $token
        ], 200);
    }

    public function dataStatistik() {
        $tkpLulus       = 0;
        $tkpTidakLulus  = 0;
        $tiuLulus       = 0;
        $tiuTidakLulus  = 0;
        $twkLulus       = 0;
        $twkTidakLulus  = 0;

        $token_data     = ExamToken::WHERE('status', 'Simulasi')->first();

        if (!$token_data) {
            // Meneruskan ke halaman tujuan dengan nilai default
            return view('guru.statistik', compact('tkpLulus', 'tkpTidakLulus', 'tiuLulus', 'tiuTidakLulus', 'twkLulus', 'twkTidakLulus'));
        }

        $topExams = Exam::where('exam_type', 'Test') // Filter exam_type = 'Test'
                ->WHERE('token', $token_data->token)
                ->orderBy('exam_score', 'desc') // Urutkan berdasarkan exam_score secara descending
                ->take(5) // Ambil 5 nilai tertinggi
                ->get(); // Ambil hasil

        $examData = Exam::where('exam_type', 'Test')
                    ->with('exam_answer')
                    ->with('exam_answer.question')
                    ->WHERE('token', $token_data->token)
                    ->get();

        foreach($examData as $data){
            // dd($data);
            $exam_answers = ExamAnswer::with(['answer', 'question'])
                ->where('exam_id', $data->exam_id)
                ->get();

            $tkpScore = 0;
            $tiuScore = 0;
            $twkScore = 0;

            foreach ($exam_answers as $exam_answer) {
                $category = $exam_answer->question->category;

                // if (!$exam_answer->is_false) {
                //     $categories[$category]['Jawaban_Benar']++;
                // }

                if ($category == "TKP") {
                    if ($exam_answer->answer_id !== null) {
                        $tkpScore += $exam_answer->answer->answer_score;
                    }
                }else if ($category == "TIU") {
                    if ($exam_answer->answer_id !== null) {
                        $tiuScore += $exam_answer->answer->answer_score;
                    }
                }else if ($category == "TKP") {
                    if ($exam_answer->answer_id !== null) {
                        $twkScore += $exam_answer->answer->answer_score;
                    }
                }
            }

            if ($tkpScore >= 166) {
                $tkpLulus += 1;
            }else if ($tkpScore < 166) {
                $tkpTidakLulus += 1;
            }

            if ($twkScore >= 65) {
                $twkLulus += 1;
            }else if ($twkScore < 65) {
                $twkTidakLulus += 1;
            }

            if ($tiuScore >= 80) {
                $tiuLulus += 1;
            }else if ($tiuScore < 80) {
                $tiuTidakLulus += 1;
            }
        }

        return view('guru.statistik', compact('topExams', 'tkpLulus', 'tkpTidakLulus', 'tiuLulus', 'tiuTidakLulus', 'twkLulus', 'twkTidakLulus'));
    }

    public function printStatistik() {
        $tkpLulus       = 0;
        $tkpTidakLulus  = 0;
        $tiuLulus       = 0;
        $tiuTidakLulus  = 0;
        $twkLulus       = 0;
        $twkTidakLulus  = 0;

        $topExams = Exam::where('exam_type', 'Test') // Filter exam_type = 'Test'
                ->orderBy('exam_score', 'desc') // Urutkan berdasarkan exam_score secara descending
                ->take(5) // Ambil 5 nilai tertinggi
                ->get(); // Ambil hasil

        $examData = Exam::where('exam_type', 'Test')
                    ->with('exam_answer')
                    ->with('exam_answer.question')
                    ->get();

        foreach($examData as $data){
            // dd($data);
            $exam_answers = ExamAnswer::with(['answer', 'question'])
                ->where('exam_id', $data->exam_id)
                ->get();

            $tkpScore = 0;
            $tiuScore = 0;
            $twkScore = 0;

            foreach ($exam_answers as $exam_answer) {
                $category = $exam_answer->question->category;

                // if (!$exam_answer->is_false) {
                //     $categories[$category]['Jawaban_Benar']++;
                // }

                if ($category == "TKP") {
                    if ($exam_answer->answer_id !== null) {
                        $tkpScore += $exam_answer->answer->answer_score;
                    }
                }else if ($category == "TIU") {
                    if ($exam_answer->answer_id !== null) {
                        $tiuScore += $exam_answer->answer->answer_score;
                    }
                }else if ($category == "TKP") {
                    if ($exam_answer->answer_id !== null) {
                        $twkScore += $exam_answer->answer->answer_score;
                    }
                }
            }

            if ($tkpScore >= 100) {
                $tkpLulus += 1;
            }else if ($tkpScore <= 100) {
                $tkpTidakLulus += 1;
            }

            if ($twkScore >= 100) {
                $twkLulus += 1;
            }else if ($twkScore <= 100) {
                $twkTidakLulus += 1;
            }

            if ($tiuScore >= 100) {
                $tiuLulus += 1;
            }else if ($tiuScore <= 100) {
                $tiuTidakLulus += 1;
            }
        }

        // Memuat tampilan untuk pencetakan data
        return view('guru.print-statistik', compact('topExams', 'tkpLulus', 'tkpTidakLulus', 'tiuLulus', 'tiuTidakLulus', 'twkLulus', 'twkTidakLulus'));

        // Menginisialisasi objek Dompdf
        $dompdf = new Dompdf();

        // Memuat HTML ke Dompdf
        // $dompdf->loadHtml($html);

        // Mengatur opsi jika diperlukan, seperti nama file hasil cetakan
        $dompdf->setPaper('A4', 'portrait');

        // Rendering dan menghasilkan output PDF
        $dompdf->render();

        // Menyimpan atau menawarkan file PDF untuk diunduh oleh pengguna
        return $dompdf->stream('data_cetak.pdf');
    }
}
