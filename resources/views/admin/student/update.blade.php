@extends('adminlte::page')
@section('content')
    <form action="{{ route('update.student', $student->user->user_name) }}" method="POST">
    @csrf
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Student</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                    <label>First name</label>
                    <input type="text" class="form-control" value="{{ $student->user->first_name }}" name="firstName">
                </div>
                <div class="form-group">
                    <label>Last name</label>
                    <input type="text" class="form-control" value="{{$student->user->last_name}}" name="lastName">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{$student->user->email}}" name="email">
                </div>
                <div class="form-group">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="1" id="male" {{ ($student->user->gender == 1)? "checked" : " " }}>
                    <label for="female">Female</label>
                    <input type="radio" name="gender" value="0" id="female"{{ ($student->user->gender == 0)? "checked" : " " }}>
                </div>
                <div class="form-group">
                    <label >Department</label>
                    <select class ="form-control" name="department_id">
                        <option {{ ($student->department_id == 0)? "selected" : " " }} value="0">General</option>
                        <option {{ ($student->department_id == 1)? "selected" : " " }} value="1">Computer Science</option>
                        <option {{ ($student->department_id == 2)? "selected" : " " }} value="2">Information Systems</option>
                        <option {{ ($student->department_id == 3)? "selected" : " " }} value="3">Information Technology</option>
                    </select>
                </div>
                <div class="form-group">
                  <label>Level</label>
                  <input type="number" class="form-control" value="{{ $student->level }}" name="level">
                </div>
                <div class="form-group">
                  <label>GPA</label>
                  <input type="number" step="0.01" class="form-control" value="{{ $student->gpa }}" name="gpa">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </form>
@endsection
