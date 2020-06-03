<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseHall extends Model
{
    //
    protected $fillable = [
        'course_id','course_id','halls_availability_id'
    ];
    public function course()
    {
        return $this->belongsTo('App/course');
    }
    public function halls_availablity()
    {
        return $this->belongsTo('App/HallAvailability');
    }
}
