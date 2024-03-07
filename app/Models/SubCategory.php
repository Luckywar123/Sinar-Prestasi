<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table        = 'sub_categories';
    protected $primaryKey   = 'sub_category_id';
    protected $fillable     = ['title', 'category'];

    public function question()
    {
        return $this->hasMany('App\Models\Question', 'sub_category_id');
    }
}