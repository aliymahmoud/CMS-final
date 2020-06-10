@extends('adminlte::page')

@section('title','Register Courses')
    
@section('content_header')
    <h1 class="m-0 text-dark">Register Courses for this semester</h1>
@endsection
@section('content')
@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    
@endif
    
    <table class="table dataTable text-center">
        <thead>
            <th>#</th>
            <th>Course code</th>
            <th>Course Name</th>
            <th>Department</th>
            <th>Semester</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($courses as $index=>$course)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->department->name }}</td>
                    <td>{{ ($course->semester == 1)? "First" : "Second" }}</td>
                    <td>
                        @if ($instructor_courses->contains('course_id',$course->id))
                        <form action="{{ route('unregister.course.instructor',$course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="unregister btn-danger btn-sm btn fa">Unregister</button>
                        </form>
                        @else
                        <form action="{{ route('register.course.instructor',$course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="register btn-primary btn-sm btn fa">Register</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection