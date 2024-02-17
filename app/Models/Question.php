<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table        = 'questions';
    protected $primaryKey   = 'question_id';
    protected $fillable     = ['category', 'sub_category_id', 'question_image_url', 'question_text', 'user_id', 'exam_type'];

    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Answer', 'question_id');
    }

    public function exam_answer()
    {
        return $this->hasMany('App\Models\ExamAnswer', 'question_id');
    }
}
