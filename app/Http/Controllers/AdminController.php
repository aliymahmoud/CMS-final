<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Department;
use App\Course;
use App\Instructor;
use App\Hall;
use App\InstructorCourse;

class AdminController extends Controller
{
    
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
    
    public function getUpdateStudent($name){
        
        $student = Student::whereHas('user', function($query) use($name){
            $query->where('user_name',$name);
        })->first();

        return view('admin.student.update',compact('student'));
    }

    public function postUpdateStudent(Request $request, $name)
    {
        // return $request;
        $student = Student::whereHas('user', function($query) use($name){
            $query->where('user_name',$name);
        })->first();
        $this->validate($request, [
            'email' => 'email|max:255',
            'firstName' => 'max:255|alpha',
            'lastName'=> 'max:255|alpha',
            'level' =>' integer|lt:5',
            'gpa' => 'numeric|lt:4| gt:0',
            'gender' => 'numeric',
            'department_id' => 'numeric',
        ]);

        $student->user->update([
            'email' => $request->email,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
        ]);
        $student->update([
            'level' => $request->level,
            'gpa' => $request->gpa,
            'department_id' => $request->department_id,

        ]);
        
        return redirect()->back();
    }
        public function getListStudents(Request $request)
    {
        $level = $request->level;
        $students = Student::where('level',$level)->get();
        return view('admin.student.list',compact('students','level'));
    }

    public function getViewStudent($name)
    {
        $student = Student::whereHas('user', function($query) use($name){
            $query->where('user_name',$name);
        })->first();
        return view('admin.student.view', compact($student));
    }
    
    
    public function getAddCourse(Request $request)
    {
        return view('admin.course.create');
    }
    public function postAddCourse(Request $request)
    {
        $this->validate($request, [
           'courseName' => 'max:255|required',
           'courseCode' => 'required|max:255',
           'minStudentsNumber' => 'required|numeric',
           'department_id' => 'required',
           'semester' => 'required',
           'creditHours' => 'numeric|required',
        ]);

        $course = Course::create([
            'name' => $request->courseName,
            'code' => $request->courseCode,
            'min_students_number' => $request->minStudentsNumber,
            'department_id' => $request->department_id,
            'semester' => $request->semester,
            'credit_hours' => $request->creditHours,
        ]);
        return redirect()->back();
    }
    public function getListCourses(Request $request)
    {
        $courses = (new Course)->newQuery();
        if($request->has('department'))
        {
            $courses->where('department_id', $request->department);
        }
        if($request->has('semester'))
        {
            $courses->where('semester', $request->semester);
        }
        $courses = $courses->get();
        return view('admin.course.list', compact('courses'));
    }
    public function getUpdateCourse($code) 
    {
        $course = Course::where('code', $code)->first();
        $departments = Department::all();
        if($course)
            return view('admin.course.update', compact('course','departments'));
        else
            abort('404');
        // return $course->name;
    }

    public function postUpdateCourse(Request $request, $code)   
    {
        // return $request->department_id;
        $course = Course::where('code', $code)->first();
        if($course->code)
        {
            $course->update([
                'name' => $request->courseName,
                'code' => $request->courseCode,
                'min_students_number' => $request->minStudentsNumber,
                'department_id' => $request->department_id,
                'semester' => $request->semester,
                'credit_hours' => $request->creditHours,
                
            ]);
            return redirect(route('edit.course',$course->code));
        }
        else
            abort('404');
    }
    public function createInstructor(Request $request)
    {
        return view('admin.instructor.create');
    }

    public function storeInstructor(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|max:255|required',
            'firstName' => 'max:255|alpha|required',
            'lastName'=> 'max:255|alpha|required',
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
            'role' => '2',

        ]);
        $instructor = Instructor::create([
            'user_id' => $user->id,
            'department_id' => $request->department_id,
        ]);
        return redirect()->back();
    }
    
    public function editInstructor($name){
        
        $instructor = Instructor::whereHas('user', function($query) use($name){
            $query->where('user_name',$name);
        })->first();
        if($instructor)
            return view('admin.instructor.update',compact('instructor'));
        else
            abort('404');
    }

    public function updateInstructor(Request $request, $name)
    {
        // return $request;
        $instructor = Instructor::whereHas('user', function($query) use($name){
            $query->where('user_name',$name);
        })->first();
        $this->validate($request, [
            'email' => 'email|max:255',
            'firstName' => 'max:255|alpha',
            'lastName'=> 'max:255|alpha',
            'gender' => 'numeric',
            'department_id' => 'numeric',
        ]);

        $instructor->user->update([
            'email' => $request->email,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
        ]);
        $instructor->update([
            'department_id' => $request->department_id,
        ]);
        return redirect(route('edit.instructor', $instructor->user->user_name));
    }

    public function listInstructors(Request $request)
    {
        $department_id = $request->department_id;
        $instructors = new Instructor;
        if($request->has('department_id'))
        {
            $instructors = $instructors->where('department_id',$department_id);
        }
        $instructors = $instructors->get();
        return view('admin.instructor.list',compact('instructors','department_id'));
    }

    public function showInstructor($name)
    {
        $instructor = Instructor::whereHas('user', function($query) use($name){
            $query->where('user_name',$name);
        })->first();
        return view('admin.instructor.view', compact('instructor'));
    }
    public function getAssignInstructor($name)
    {
        $instructor = Instructor::whereHas('user', function($query) use($name){
            $query->where('user_name',$name);
        })->first();
        $courses = Course::all();
        $instructor_courses = $instructor->instructorCourses;
        return view('admin.instructor.register_course', compact('instructor_courses', 'courses', 'instructor'));
    }
    public function postAssignCourses($course_id, $user_name)
    {
        $instructor = Instructor::whereHas('user', function($query) use($user_name){
            $query->where('user_name',$user_name);
        })->first();
        if(!$instructor){
            return redirect()->back()->with([
                "message" => "Instructor has not been found successfully",
            ]);
        }
        $instructor_courses = $instructor->instructorCourses;
        if(count($instructor_courses) < 7){
            if($instructor_courses->contains('course_id',$course_id))
            {
                return redirect()->back()->with([
                    "message" => "Instructor already registered",
                ]);
            }
            $instructorCourse = InstructorCourse::create([
                'instructor_id' => $instructor->id,
                'course_id' => $course_id,
                'semester' => '1',
            ]);
            return redirect()->back()->with([
                "message" => "Instructor assigned successfully",
            ]);
        }
        else{
            return redirect()->back()->with([
                "message" => "Instructor already has more than 7 courses",
            ]);
        }    
    }

    public function postUnassignCourses($course_id, $user_name)
    {
        $instructor = Instructor::whereHas('user', function($query) use($user_name){
            $query->where('user_name',$user_name);
        })->first();
        if(!$instructor)
        {
            return redirect()->back()->with([
                "message" => "Instructor has not been found successfully",
            ]);
        }
        $instructorCourses = $instructor->instructorCourses;
        if($instructorCourses->contains('course_id', $course_id))
        {
            InstructorCourse::where('course_id', $course_id)->delete();
            return redirect()->back()->with([
                "message" => "Instructor unassigned successfully",
            ]);
            // return response()->json([
            //     "state" => true,
            //     "message" => "Course has been deleted successfully",
            // ]);
        }
        else
        {
            return redirect()->back()->with([
                "message" => "Instructor not registered",
            ]);
        }
    }

        /////////////////
    //HALLS
    public function createHall(Request $request)
    {
        return view('admin.hall.create');
    }

    public function storeHall(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:50|required',
        ]);
        $hall = Hall::create([
            'name' => $request->name,
        ]);
        return redirect()->back();
    }

    public function editHall($name){
        
        $hall = Hall::where('name', $name)->first();
        if($hall)
            return view('admin.hall.update',compact('hall'));
        else
            abort('404');
    }

    public function updateHall(Request $request, $name)
    {
        // return $request;
        $this->validate($request, [
            'name' => 'max:255|alpha',
        ]);
        $hall = Hall::where('name', $name)->first();
        $hall->update([
            'name' => $request->name,
        ]);
        return redirect(route('edit.hall', $hall->name));
    }

    public function listHalls(Request $request)
    {
        $halls = Hall::all();
        return view('admin.hall.list',compact('halls'));
    }

    public function showHall($name)
    {   
        $hall = Hall::where('name', $name)->first();
        return view('admin.hall.view', compact('hall'));
    }
}
    
