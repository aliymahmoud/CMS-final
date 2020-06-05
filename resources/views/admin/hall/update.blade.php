@extends('adminlte::page')
@section('content')
    <form action="{{ route('update.hall', $hall->name) }}" method="POST">
    @csrf
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Hall</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                    <label>Hall Name</label>
                    <input type="text" class="form-control" value="{{ $hall->name }}" name="name">
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
