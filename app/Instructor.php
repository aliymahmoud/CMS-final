<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'user_id','department_id',
    ];
    public function instructorCourse()
    {
        return $this->hasMany('App\InstructorCourse');
    }
    public function courses()
    {
        return $this->hasManyThrough('App\Course', 'App\InstructorCourse');
    }
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
