@extends('adminlte::page')
@section('content')
    <form action="{{ route('update.instructor', $instructor->user->user_name) }}" method="POST">
    @csrf
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Instructor</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                    <label>First name</label>
                    <input type="text" class="form-control" value="{{ $instructor->user->first_name }}" name="firstName">
                </div>
                <div class="form-group">
                    <label>Last name</label>
                    <input type="text" class="form-control" value="{{$instructor->user->last_name}}" name="lastName">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{$instructor->user->email}}" name="email">
                </div>
                <div class="form-group">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="1" id="male" {{ ($instructor->user->gender == 1)? "checked" : " " }}>
                    <label for="female">Female</label>
                    <input type="radio" name="gender" value="0" id="female"{{ ($instructor->user->gender == 0)? "checked" : " " }}>
                </div>
                <div class="form-group">
                    <label >Department</label>
                    <select class ="form-control" name="department_id">
                        <option {{ ($instructor->department_id == 1)? "selected" : " " }} value="1">Computer Science</option>
                        <option {{ ($instructor->department_id == 2)? "selected" : " " }} value="2">Information Systems</option>
                        <option {{ ($instructor->department_id == 3)? "selected" : " " }} value="3">Information Technology</option>
                    </select>
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