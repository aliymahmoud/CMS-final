<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'user_name', 'email', 'password','first_name','last_name','gender','role',
    // ];

    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function students()
    {
        return $this->hasMany('App\Student');
    }
    public function instructors()
    {
        return $this->hasMany('App\Instructor');
    }
    public function isAdmin()
    {
        return ($this->role == 0)? true : false;
    }
    public function isStudent()
    {
        return ($this->role == 1)? true : false;
    }
    public function isInstructor()
    {
        return ($this->role == 2)? true : false;
    }
    public function getNameAttribute()
    {
        return $this->first_name;
    }
    public function adminlte_image()
    {
        return asset('images/default.jpg');
    }
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name)." ".ucfirst($this->last_name);
    }
}
