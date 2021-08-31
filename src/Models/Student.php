<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'phone',
        'student_level',
        'email',


    ];
    /**
     * list of  sections
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Models\Section
     */
 public function sections()
    {
        return $this->belongsToMany(Section::class,'section_students')

        ->select(['student_id' ,'section_id','first_mark','mid_mark','final_mark']);
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
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y, H:i:s');
    }


     /**
     * search about courses
     *@param $query tha input query
     *@param $filters array of the input
     *@author Hedaya Alkhaldy <hedaya.alkhaldy@gmail.com>
     *@return array of result
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('student_level', 'like', '%' . $search . '%');
            });
        });
    }
    /**
     *  user
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Models\User
     */
    public function users()
    {
        return $this->hasOne(User::class,'email','email');
    }

}
