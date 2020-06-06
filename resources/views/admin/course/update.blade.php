@extends('adminlte::page')
@section('content')
    <form action="{{ route('update.course', $course->code) }}" method="POST">
    @csrf
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Course</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                  <div class="form-group">
                    <label>Course Name</label>
                    <input type="text" class="form-control" value="{{ $course->name }}" name="courseName">
                  </div>

                  <div class="form-group">
                    <label>Course Code</label>
                    <input type="text" class="form-control" value="{{ $course->code }}" name="courseCode">
                  </div>

                  <div class="form-group">
                      <label>Minimum Number Of Students</label>
                      <input type="number" class="form-control" value="{{ $course->min_students_number }}" name="minStudentsNumber">
                  </div>

                  <div class="form-group">
                    <label >Department</label>
                    <select class ="form-control" name="department_id">
                      <option selected disabled>Select Department</option>
                      @foreach ($departments as $department)
                        <option {{ ($course->department_id == $department->id)? "selected" : " " }} value="{{ $department->id }}">{{ $department->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="1st">1st Semester</label>
                    <input type="radio" name="semester" value="1" id="1st" {{ ($course->semester == 1)? "checked" : " " }}>
                    <label for="2nd">2nd Semester</label>
                    <input type="radio" name="semester" value="0" id="2nd" {{ ($course->semester == 0)? "checked" : " " }}>
                  </div>
                  <div class="form-group">
                    <label>Credit Hours</label>
                    <input type="number" class="form-control" value={{ $course->credit_hours }} name="creditHours">
                  </div>
                </div>
              </form>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </form>
@endsection