<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $fillable = [
        'name',
    ];
    public function hallsAvailable()
    {
        return $this->hasMany('App\HallsAvailable');
    }
    public function courseHalls()
    {
        return $this->hasManyThrough('App\CourseHalls', 'App\HallsAvailable');
    }
    public function courses()
    {
        return $this->hasManyThrough('App\Course','App\CourseHalls');
    }
}
