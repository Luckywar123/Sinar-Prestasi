<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;

    protected $table        = 'exam_answers';
    protected $primaryKey   = 'exam_answer_id';
    protected $fillable     = ['exam_id', 'question_id', 'answer_id', 'is_false'];

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam', 'exam_id');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }

    public function answer()
    {
        return $this->belongsTo('App\Models\Answer', 'answer_id');
    }
}
