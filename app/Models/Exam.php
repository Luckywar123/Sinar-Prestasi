<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table        = 'exams';
    protected $primaryKey   = 'exam_id';
    protected $fillable     = ['exam_type', 'exam_score', 'student_id', 'exam_start', 'exam_finish'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function exam_answer()
    {
        return $this->hasMany('App\Models\ExamAnswer', 'exam_id');
    }
}
