<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HallAvailability extends Model
{
    protected $fillable = [
        'hall_id','halls_availability_id',
    ];
    public function course_hall()
    {
        return $this->belongsTo('App\CourseHall');
    }
}
