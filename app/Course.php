<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name','code','min_students_number','department_id','semester','credit_hours',
    ];
    public function studentCourses()
    {
        return $this->hasMany('App\StudentCourse');
    }
    public function students()
    {
        return $this->hasManyThrough('App\Student','App\StudentCourse');
    }
    public function studentGrades()
    {
        return $this->hasMany('App\StudentGrade');
    }
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    public function courseHalls()
    {
        return $this->hasMany('App\CourseHall');
    }
    public function halls() 
    {
        return $this->hasManyThrough('App\Hall','App\CourseHall');
    }
    

}
