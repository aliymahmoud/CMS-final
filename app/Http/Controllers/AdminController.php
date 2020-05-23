<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Department;

class AdminController extends Controller
{
      public function getListStudents(Request $request)
    {
        $level = $request->level;
        $students = Student::where('level',$level)->get();
        return view('admin.student.list',compact('students','level'));
    }
    
     public function getAddStudent(Request $request)
    {
        return view('admin.student.create');
    }
    
    
      public function postAddStudent(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|max:255|required',
            'firstName' => 'max:255|alpha|required',
            'lastName'=> 'max:255|alpha|required',
            'level' =>' integer|lt:4|required',
            'gpa' => 'numeric|lt:4| gt:0',
            'userName' => 'max:255|alpha|required',
            'password' => 'required',
            'gender' => 'required',
            'department_id' => 'required',
        ]);
        $user = User::create([
            'email' => $request->email,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'user_name' => $request->userName,
            'password' => \Hash::make($request->password),
            'gender' => $request->gender,
        ]);
        $student = Student::create([
            'user_id' => $user->id,
            'level' => $request->level,
            'gpa' => $request->gpa,
            'department_id' => $request->department_id,
        ]);
        // $uniqueId = $student->created_at->format('Y');
        // $username = strtolower($request->firstName).strtolower($request->lastName).$uniqueId;
        return redirect()->back();
    }
    
    
    
    
    
}
