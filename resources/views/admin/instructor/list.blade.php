@extends('adminlte::page')
@section('content')
    <form action="{{ route('list.instructor') }}" id="form">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Show Instructors Of Department:</label>
                    <select class="form-control" id="department" name="department_id">
                        <option disabled selected>Choose Department</option>
                        <option value="1">Computer Science</option>
                        <option value="2">Information Systems</option>
                        <option value="3">Information Technology</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
               <div class="form-group">
                    <button type="submit" style="margin-top: 6%" class="btn btn-primary">Show</button>
               </div>
            </div>
        </div>
    </form>
    
    <table class='table dataTable'>
        <thead class="text-center">
            <th>Instructor ID</th>
            <th>Instructor Name</th>
            <th>Username</th>
            <th>Department</th>
            <th >Actions</th>
        </thead>
        <tbody class="text-center">
            @foreach($instructors as $instructor)
                <tr>
                    <td>{{ $instructor->user->id}}</td>
                    <td>{{ $instructor->user->full_name}}</td>
                    <td>{{ $instructor->user->user_name}}</td>
                    <td>{{ $instructor->department->name }}</td>
                    <td>
                        <a href="{{ route('assign.instructor', $instructor->user->user_name) }}" class='btn btn-primary btn-sm'><i class="fas fa-eye"></i><span> Assign</span></a>
                        <a href="{{ route('edit.instructor', $instructor->user->user_name) }}" class='btn btn-warning btn-sm fa'><i class="fas fa-pen"></i> Edit</a>
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
