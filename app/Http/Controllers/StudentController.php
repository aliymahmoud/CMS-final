<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;
use App\Course;
use App\StudentCourse;

class StudentController extends Controller
{
    public function profile()
    {
        switch(\Auth::user()->role){
            case '0':
                return view('admin.profile');
                break;
            case '1':
                $student = Student::whereHas('user', function($query){
                    $query->where('id',\Auth::user()->id);
                })->first();
                if($student){
                    return view('student.profile',compact('student'));
                }
                else{
                    \Auth::logout();
                    return redirect()->route('login');
                }
                break;
            case '2':
                return view('instructor.profile');
                break;
            default: return redirect(route('login'));
        }
    }
    public function firstLogin(Request $request)
    {
        $this->validate($request,[
            'student_id' => 'required|numeric|digits:8|unique:students,unique_id',
            'email' => 'required|email',
            'new_password' => 'required|min:8',
            'confirm_password' => 'same:new_password',
        ]);
        $student = Student::whereHas('user', function($query) use($request){
            $query->where('id',$request->user_id);
        })->first();
        if($student){
            $student->user->update([
                'user_name' => $student->user->first_name."-".$student->user->last_name."-".$request->student_id,
                'email' => $request->email,
                'email_verified_at' => Carbon::now(),
                'password' => \Hash::make($request->new_password),
            ]);
            $student->update([
                'unique_id' => $request->student_id,
            ]);
            return redirect()->back();
        }
        abort('500');
    }
    public function updateProfile(Request $request)
    {
        $rules = [
            'email' => 'email',
            // 'confirm_password' => 'regex:/^(?=\S*[a-z])(?=\S*[!@#$&*])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
            'new_password' => 'same:confirm_password',
            'firstName' => 'alpha',
            'lasName' => 'alpha',
        ];
        $messeges = [
            'password.regex' => 'Password format must consist of a set of uppercase, numbers, and special characters (for example:! @ # $% ^ & *?> <).',
            'email.unique' => 'This Email is already taken',
            'new_password.same' => 'password does not match',
            'firstName.alpha' => 'name must contain only letters',
        ];
        $this->validate($request,$rules,$messeges);
        $student = Student::whereHas('user', function($query) use($request){
            $query->where('id',$request->user_id);
        })->first();
        if($student){
            $student->user->update([
                'email' => $request->email,
                'password' => \Hash::make($request->new_password),
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
            ]);
            return redirect()->back();
        }
        else{
            abort('500');
        }
    }
    public function getRegisterCourses()
    {
        $courses = Course::all();
        $student = Student::whereHas('user', function($query){
            $query->where('id',\Auth::user()->id);
        })->first();
        if(!$student){
            \Auth::logout();
            return redirect(route('login'));
        }
        // return $student->courses;
        $student_courses = $student->studentCourses;
        return view('student.register_courses',compact('courses','student_courses'));
    }
    public function postRegisterCourses($course_id,$user_id)
    {
        $student = Student::whereHas('user', function($query) use($user_id){
            $query->where('id',$user_id);
        })->first();
        if(!$student){
            \Auth::logout();
            return redirect(route('login'));
        }
        $student_courses = $student->studentCourses;
        if(count($student_courses) < 7){
            if($student_courses->contains('course_id',$course_id))
            {
                return response()->json([
                    "state" => false,
                    "message" => "course already registered",
                ]);
            }
            $studentCourse = StudentCourse::create([
                'student_id' => $student->id,
                'course_id' => $course_id,
                'semester' => '1',
            ]);
            return redirect()->back();
            // return response()->json([
            //     "state" => true,
            //     "message" => "course registered succesfuly",
            // ]);
        }
        else{
            return response()->json([
                "state" => false,
                "message" => "student has seven courses",
            ]);
        }
    }

    public function postUnregisterCourses($course_id, $user_id) 
    {
        $student = Student::where('user_id',$user_id)->first();
        if(!$student)
        {
            \Auth::logout();
            return redirect(route('login'));
        }
        $studentCourses = $student->studentCourses;
        if($studentCourses->contains('course_id', $course_id))
        {
            StudentCourse::where('course_id', $course_id)->delete();
            return redirect()->back();
            // return response()->json([
            //     "state" => true,
            //     "message" => "Course has been deleted successfully",
            // ]);
        }
        else
        {
            return response()->json([
                "state" => false,
                "message" => "Course has not been found successfully",
            ]);
        }
    }
    public function getShowRegesteredCourses(Request $request)
    {
        $user = \Auth::user();
        //$courses = StudentCourse::where('student_id', $user->id)->toSql();
        $student = Student::where('user_id', $user->id)->first();
        $courses = $student->courses;
        return view('student.show_courses',compact('courses'));
    }
}
        