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

        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return view('guru.rekap', ["exams" => $exams, "months" => $months]);
    }

    public function generateToken(Request $request, $length = 6) {
        // Get user_id from auth session
        $user_id = auth()->user()->user_id;

        // Ambil status dari request
        $status = $request->input('status', 'Simulasi');

        // Karakter yang diizinkan untuk digunakan dalam token
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Mengacak karakter dan memilih panjang token yang diinginkan
        $token = '';
        $maxIndex = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[mt_rand(0, $maxIndex)];
        }

        $currentToken = ExamToken::where('user_id', $user_id)->where('status', $status)->first();

        if (!empty($currentToken)) {
            ExamToken::destroy($currentToken->exam_token_id);
        }

        ExamToken::create([
            'token'     => $token,
            'user_id'   => $user_id,
            'status'    => $status
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

        $tokens = ExamToken::where('user_id', $user_id)->get();

        return response()->json([
            'status'  => "Success",
            'message' => 'Data token',
            'data'    => $tokens
        ], 200);
    }

    public function dataStatistik() {
        $tkpLulus       = 0;
        $tkpTidakLulus  = 0;
        $tiuLulus       = 0;
        $tiuTidakLulus  = 0;
        $twkLulus       = 0;
        $twkTidakLulus  = 0;

        try {
            $token_data = ExamToken::where('status', 'Simulasi')->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return view('guru.statistik', compact('tkpLulus', 'tkpTidakLulus', 'tiuLulus', 'tiuTidakLulus', 'twkLulus', 'twkTidakLulus'));
        }


        $examData = Exam::where('exam_type', 'Test')
                    ->with('exam_answer')
                    ->WHERE('token', $token_data->token)
                    ->WHERE('exam_status', 'Finish')
                    ->orderBy('exam_score', 'desc')
                    ->get();

        foreach($examData as $data){
            $tkpScore = 0;
            $tiuScore = 0;
            $twkScore = 0;

            foreach ($data->exam_answer as $exam_answer) {
                $category = $exam_answer->question->category;

                if ($category == "TKP") {
                    if ($exam_answer->answer_id !== null) {
                        $tkpScore += $exam_answer->answer->answer_score;
                    }
                }else if ($category == "TIU") {
                    if ($exam_answer->answer_id !== null) {
                        $tiuScore += $exam_answer->answer->answer_score;
                    }
                }else if ($category == "TWK") {
                    if ($exam_answer->answer_id !== null) {
                        $twkScore += $exam_answer->answer->answer_score;
                    }
                }
            }

            $data->tkpScore = $tkpScore;
            $data->tiuScore = $tiuScore;
            $data->twkScore = $twkScore;

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

        return view('guru.statistik', compact('examData', 'tkpLulus', 'tkpTidakLulus', 'tiuLulus', 'tiuTidakLulus', 'twkLulus', 'twkTidakLulus'));
    }

    public function printStatistik() {
        $tkpLulus       = 0;
        $tkpTidakLulus  = 0;
        $tiuLulus       = 0;
        $tiuTidakLulus  = 0;
        $twkLulus       = 0;
        $twkTidakLulus  = 0;

        try {
            $token_data = ExamToken::where('status', 'Simulasi')->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return view('guru.statistik', compact('tkpLulus', 'tkpTidakLulus', 'tiuLulus', 'tiuTidakLulus', 'twkLulus', 'twkTidakLulus'));
        }

        $examData = Exam::where('exam_type', 'Test')
                    ->with('exam_answer')
                    ->WHERE('token', $token_data->token)
                    ->WHERE('exam_status', 'Finish')
                    ->orderBy('exam_score', 'desc')
                    ->get();

        foreach($examData as $data){
            $exam_answers = ExamAnswer::with(['answer', 'question'])
                ->where('exam_id', $data->exam_id)
                ->get();

            $tkpScore = 0;
            $tiuScore = 0;
            $twkScore = 0;

            foreach ($exam_answers as $exam_answer) {
                $category = $exam_answer->question->category;

                if ($category == "TKP") {
                    if ($exam_answer->answer_id !== null) {
                        $tkpScore += $exam_answer->answer->answer_score;
                    }
                }else if ($category == "TIU") {
                    if ($exam_answer->answer_id !== null) {
                        $tiuScore += $exam_answer->answer->answer_score;
                    }
                }else if ($category == "TWK") {
                    if ($exam_answer->answer_id !== null) {
                        $twkScore += $exam_answer->answer->answer_score;
                    }
                }
            }

            $data->tkpScore = $tkpScore;
            $data->tiuScore = $tiuScore;
            $data->twkScore = $twkScore;

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
        return view('guru.print-statistik', compact('examData', 'tkpLulus', 'tkpTidakLulus', 'tiuLulus', 'tiuTidakLulus', 'twkLulus', 'twkTidakLulus'));
    }

    public function filterRecap(Request$request){
        $exams  = Exam::with('exam_answer')->get();



        $monthFilter = $request->input('month_filter');

        // dd(date('m', strtotime(($monthFilter))));

        $exams = Exam::with('exam_answer')
            ->whereMonth('created_at', $monthFilter)
            ->get();

        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return view('guru.rekap', ["exams" => $exams, "months" => $months]);
    }
}
