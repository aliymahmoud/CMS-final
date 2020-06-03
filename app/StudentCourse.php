<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $fillable = [
        'student_id','course_id',
    ];
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
    public function course()
    {
        return $this->belongsTo('App/Course');
    }
}
