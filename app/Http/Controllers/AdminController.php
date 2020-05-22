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
}
