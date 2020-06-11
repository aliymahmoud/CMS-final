@extends('adminlte::page')
@section('content')
    <form action="{{ route('assign.hall',$hall->id) }}" method="POST">
    @csrf
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Assign Courses to {{ $hall->name }}</h3>
            </div>
                <div class=>
                  <label>Select Courses</label>
                  <table class="table text-center">
                      <thead>
                          <th>Time</th>
                          <th>Availablty</th>
                          <th></th>
                      </thead>
                      <tbody>
                          @foreach ($hall->hallsAvailable as $timeAvailable)
                          <tr>
                              <td>{{ $timeAvailable->time }}</td>
                              <td>{{ ($timeAvailable->available)? "Available" : "Not Available" }}</td>
                              <td>
                                    <div class="col-6">
                                        <select name="course" class="form-control">
                                            <option selected disabled >Not Assigned</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
          </div>
    </form>
@endsection