@extends('adminlte::page')
@section('content')

<table class='table dataTable'>
    <thead class="text-center">
        <th>Course Name</th>
        <th>Course Code</th>
        <th>Semester</th>
    </thead>
    <tbody class="text-center">
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->code }}</td>
                <td>{{ $course->semster }}</td>
            </tr>
         @endforeach
    </tbody>
</table>
@endsection
© 2020 GitHub, Inc.
