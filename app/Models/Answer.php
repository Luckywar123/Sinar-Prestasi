<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table        = 'answers';
    protected $primaryKey   = 'answer_id';
    protected $fillable     = ['question_id', 'answer_text', 'answer_image_url', 'answer_score'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }

    public function exam_answer()
    {
        return $this->hasMany('App\Models\ExamAnswer', 'answer_id');
    }
}
