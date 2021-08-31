<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_number',
        'course_id',
        'teacher_id',
    ];
    /**
     * Course for section
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Models\Teacher
     */
    public function courses()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    /**
     *Teacher for section
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Models\Teacher
     */
    public function teachers()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
/**
     * list of students in section with marks
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Models\Student
     */
    public function students()
    {
        return $this->belongsToMany(Student::class,'section_students', 'student_id' ,'section_id')

        ->select(['student_id' ,'section_id','first_mark','mid_mark','final_mark','full_name','email','student_level','phone']);
    }
     /**
     *  user
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Models\User
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

     /**
     * search about section
     *@param $query tha input query
     *@param $filters array of the input
     *@author Hedaya Alkhaldy <hedaya.alkhaldy@gmail.com>
     *@return array of result
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('section_number', 'like', '%' . $search . '%');
            });
            $query->where(function ($query) use ($search) {
                $query->orWhere('teacher_name', 'like', '%' . $search . '%');
            });

        });
    }


    /**
     *get the time with new formate
     *@param $vale to convert to timezone
     *@author Hedaya Alkhaldy <hedaya.alkhaldy@gmail.com>
     *@return time
     */
    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y, H:i:s');
    }


    /**
     *get the time updated with new formate
     *@param $vale to convert to timezone
     *@author Hedaya Alkhaldy <hedaya.alkhaldy@gmail.com>
     *@return time
     */

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->diffForHumans();
    }

}
