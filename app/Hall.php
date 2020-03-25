<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $fillable = [
        'name',
    ];
    public function courseAvailabilites()
    {
        return $this->hasMany('App/CourseAvailabilites');
    }
    public function courseHalls()
    {
        return $this->hasManyThrough('App/CourseHalls', 'App/CourseAvailabilites');
    }
    public function courses()
    {
        return $this->hasManyThrough('App/Course','App/CourseHalls');
    }
}
