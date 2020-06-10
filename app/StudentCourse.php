<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
   
    protected $guarded = [];
    protected $table = 'student_courses';
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
