<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table        = 'students';
    protected $primaryKey   = 'student_id';
    protected $fillable     = ['student_number', 'user_id', 'birth_place', 'birth_date', 'gender', 'address', 'school_name', 'profile_image_url'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function exam()
    {
        return $this->hasMany('App\Models\Exam', 'student_id');
    }
}
