@extends('adminlte::page')
@section('content')
    <form action="{{ route('list.course') }}" id="form">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>Show Courses Of Department:</label>
                    <select name="department" class="form-control" id="department">
                        <option disabled selected>Choose Department</option>
                        <option value="1">Computer Science</option>
                        <option value="2">Information Systems</option>
                        <option value="3">Information Technology</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Show Courses Of Semester:</label>
                    <select name="semester" class="form-control" id="semester">
                        <option disabled selected>Choose Semester</option>
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
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
            <th>Course Code</th>
            <th>Course Name</th>
            <th>Minimum Number Of Students</th>
            <th>Department</th>
            <th>Semester</th>
            <th>Credit Hours</th>
            <th >Actions</th>
        </thead>
        <tbody class="text-center">
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->code}}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->min_students_number  }}</td>
                    <td>{{ $course->department->name  }}</td>
                    <td>{{ $course->semester }}</td>
                    <td>{{ $course->credit_hours }}</td>
                    <td>
                        <a href="#" class='btn btn-primary btn-sm'><i class="fas fa-eye"></i><span> View</span></a>
                        <a href="{{ route('edit.course', $course->code) }}" class='btn btn-warning btn-sm fa'><i class="fas fa-pen"></i> Edit</a>
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
