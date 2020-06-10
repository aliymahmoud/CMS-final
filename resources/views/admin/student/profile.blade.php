@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1 class="m-0 text-dark">Your Profile</h1>
@stop

@section('content')
<h4>Username: {{ ($student->user->email_verified_at)? $student->user->user_name : "'Update Your Profile to get your username'" }}</h4>
    
        @if ($student->user->email_verified_at)
            <form action="{{ route('update.profile') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>First name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="firstName" value="{{ $student->user->first_name }}"> 
                </div>
                <div class="form-group">
                    <label>Last name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="lastName" value="{{ $student->user->last_name }}">
                </div> 
                {{-- <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="new_password">
                </div> 
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="confirm_password">
                </div>  --}}
                {{-- <div class="form-group">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="1" id="male">
                    <label for="female">Female</label>
                    <input type="radio" name="gender" value="0" id="female">
                </div>  --}}
                <div class="form-group">
                    <label >Department:</label>
                    <p>{{ $student->department->name }}</p>
                    {{-- <select class ="form-control" name="department_id">
                    <option selected disabled>Select Department</option>
                    <option value="0">General</option>
                    <option value="1">Computer Science</option>
                    <option value="2">Information Systems</option>
                    <option value="3">Information Technology</option>
                    </select> --}}
                </div> 
                {{-- <div class="form-group">
                    <label>Level</label>
                    <input type="number" class="form-control" placeholder="Enter Level" name="level">
                </div>  --}}
            {{-- <div class="form-group">
                <label>GPA</label>
                <input type="number" step="0.01" ste class="form-control" placeholder="Enter GPA" name="gpa">
            </div>  --}}
            @else
            <form action="{{ route('first-login') }}" method="POST">
               @csrf
                <div class="form-group">
                    <label>*Student ID</label>
                    <input type="number" class="form-control" placeholder="Your ID in The college" name="student_id" required>
                </div>
            
            @endif
            <div class="form-group">
                <label>New Email: {{ ($student->user->email_verified_at)? $student->user->email : " " }}</label>
                <input type="email" class="form-control" placeholder="Your Email" name="email"  {{ ($student->user->email_verified_at)? " " : "required" }}>
            </div>
            <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="new_password">
                </div> 
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" name="confirm_password">
            </div> 
        <input type="hidden" value="{{ $student->user->id }}" name="user_id">    
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
    </form>
@endsection
