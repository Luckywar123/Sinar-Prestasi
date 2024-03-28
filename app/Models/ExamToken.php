<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamToken extends Model
{
    use HasFactory;

    protected $table        = 'exam_tokens';
    protected $primaryKey   = 'exam_token_id';
    protected $fillable     = ['date_start', 'date_finish', 'token', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
