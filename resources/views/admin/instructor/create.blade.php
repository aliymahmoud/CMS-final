@extends('adminlte::page')
@section('content')
    <form action="{{ route('add.instructor') }}" method="POST">
    @csrf
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add a new instructor</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>First name</label>
                  <input type="text" class="form-control" placeholder="Enter First Name" name="firstName">
                </div>
                <div class="form-group">
                  <label>Last name</label>
                  <input type="text" class="form-control" placeholder="Enter Last Name" name="lastName">
                </div>
                <div class="form-group">
                  <label>User name</label>
                  <input type="text" class="form-control" placeholder="Enter User Name" name="userName">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" placeholder="Enter Email" name="email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" placeholder="Enter Password" name="password">
                </div>
                <div class="form-group">
                  <label for="male">Male</label>
                  <input type="radio" name="gender" value="1" id="male">
                  <label for="female">Female</label>
                  <input type="radio" name="gender" value="0" id="female">
                </div>
                <div class="form-group">
                  <label >Department</label>
                  <select class ="form-control" name="department_id">
                    <option selected disabled>Select Department</option>
                    <option value="1">Computer Science</option>
                    <option value="2">Information Systems</option>
                    <option value="3">Information Technology</option>
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
