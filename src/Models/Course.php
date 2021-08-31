<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    /**
     *list of sections
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Models\Section
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
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
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        });
    }
}
