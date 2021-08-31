<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_id',
        'student_id',
        'course_id',
        'first_mark',
        'mid_mark',
        'final_mark',

    ];

}
