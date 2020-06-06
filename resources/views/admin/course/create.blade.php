@extends('adminlte::page')
@section('content')
    <form action="{{ route('add.course') }}" method="POST">
    @csrf
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add a new course</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Course Name</label>
                  <input type="text" class="form-control" placeholder="Enter Course Name" name="courseName">
                </div>

                <div class="form-group">
                  <label>Course Code</label>
                  <input type="text" class="form-control" placeholder="Enter Course Code" name="courseCode">
                </div>

                <div class="form-group">
                    <label>Minimum Number Of Students</label>
                    <input type="number" class="form-control" placeholder="Enter Minimum Students Number" name="minStudentsNumber">
                </div>

                <div class="form-group">
                  <label >Department</label>
                  <select class ="form-control" name="department_id">
                      <option selected disabled>Select Department</option>
                      @foreach ($departments as $department)
                        <option  value="{{ $department->id }}">{{ $department->name }}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="1st">1st Semester</label>
                  <input type="radio" name="semester" value="1" id="1st">
                  <label for="2nd">2nd Semester</label>
                  <input type="radio" name="semester" value="0" id="2nd">
                </div>
                <div class="form-group">
                  <label>Credit Hours</label>
                  <input type="number" class="form-control" placeholder="Enter Cridit Hours" name="creditHours">
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