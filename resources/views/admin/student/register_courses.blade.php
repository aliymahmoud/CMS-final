@extends('adminlte::page')

@section('title','Register Courses')
    
@section('content_header')
    <h1 class="m-0 text-dark">Register Courses for this semester</h1>
@endsection
@section('content')
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
                        @if ($student_courses->contains('course_id',$course->id))
                        <form action="{{ route('post.unregister.course',['course_id' => $course->id,'student_id' => Auth::user()->id]) }}" method="POST">
                            @csrf
                            <button type="submit" user_id = "{{ Auth::user()->id }}" course_id = "{{ $course->id }}" id="{{ $index }}" class="unregister btn-danger btn-sm btn fa">Unregister</button>
                        </form>
                        @else
                        <form action="{{ route('post.register.course',['course_id' => $course->id,'student_id' => Auth::user()->id]) }}" method="POST">
                            @csrf
                            <button type="submit" url= user_id = "{{ Auth::user()->id }}" course_id = "{{ $course->id }}" id="{{ $index }}" class="register btn-primary btn-sm btn fa">Register</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

{{-- @section('js')
    <script>
        
                
        $(".register").on('click',function(){
                var id = $(this).attr('id');
                var user_id = $("#"+id).attr('user_id');
                var course_id = $("#"+id).attr('course_id');
                var newUrl = "{{ url('unregister-course') }}/"+course_id+"/"+user_id;
                var url = $("#"+id).attr("url");
                $.ajax({
                    data : {
                        "_token" : "{{ csrf_token() }}",
                    }, 
                    type : "POST",
                    url : url,
                    success: data =>{
                        if(data.state){
                            $("#"+id).attr('class',"unregister btn-danger btn-sm btn fa");
                            $("#"+id).html('Unregister');
                            $("#"+id).attr('url',newUrl);
                        }       
                    }
                });
            });
            
            $(".unregister").on('click',function(){
                var id = $(this).attr('id');
                var user_id = $("#"+id).attr('user_id');
                var course_id = $("#"+id).attr('course_id');
                var newUrl = "{{ url('register-course') }}/"+course_id+"/"+user_id;
                var url = $("#"+id).attr("url");
                $.ajax({
                    data : {
                        "_token" : "{{ csrf_token() }}",
                    }, 
                    type : "POST",
                    url : url,
                    success: data =>{
                        if(data.state){
                            $("#"+id).attr('class',"register btn-primary btn-sm btn fa");
                            $("#"+id).html('Register');
                            $("#"+id).attr('url',newUrl);
                        }
                    }
                });
            });
        $(document).ready(function(){
            
        });
    </script>
@endsection --}}
