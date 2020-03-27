<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstructorCourse extends Model
{
    protected $fillable = [
        'instructor_id','course_id',
    ];
    public function course()
        {
            return $this->belongsTo('App/Course');
        }
    public function instructor()
        {
            return $this->belongsTo('App/Instuctor');
        }
}
