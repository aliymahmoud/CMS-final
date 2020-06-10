<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name','short_name',
    ];
    public function students()
    {
        return $this->hasMany('App/Students');
    }
    public function courses()
    {
        return $this->hasMany('App/Courses');
    }
    public function instructors()
    {
        return $this->hasMany('App/Instructor');
    }
}
