@extends('adminlte::page')
@section('content')
    <form action="{{ route('list.student') }}" id="form">
        <div class="col-md-3 form-group">
            <h2>!!Show Students Of Level:</h2>
            <select name="level" class="form-control" id="level" name="level">
                <option disabled selected>Choose Level</option>
                <option {{ ($level==1)? "selected" : " " }} value="1">First Level</option>
                <option {{ ($level==2)? "selected" : " " }} value="2">Second Level</option>
                <option {{ ($level==3)? "selected" : " " }} value="3">Third Level</option>
                <option {{ ($level==4)? "selected" : " " }} value="4">Fourth Level</option>
            </select>
        </div>  
    </form>
    <table class='table dataTable'>
        <thead class="text-center">
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Username</th>
            <th >Actions</th>
        </thead>
        <tbody class="text-center">
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->user->unique_id}}</td>
                    <td>{{ $student->user->full_name }}</td>
                    <td>{{ $student->user->user_name }}</td>
                    <td>
                        <a href="{{ route('view.student', ['name'=>$student->user->user_name]) }}" class='btn btn-primary btn-sm'><i class="fas fa-eye"></i><span> View</span></a>
                        <a href="{{ route('edit.student',['name'=>$student->user->user_name]) }}" class='btn btn-warning btn-sm fa'><i class="fas fa-pen"></i> Edit</a>
                        <a href="#" class='btn btn-danger btn-sm' onclick="return confirm('ARE YOU SURE?')"><i class="fas fa-trash-alt"></i> Delete</a>
                    </td>
                </tr>
             @endforeach
        </tbody>
        
    </table>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#level").on('change',function(){
                $("#form").submit();
            });
        });
    </script>
@endsection
