@extends('adminlte::page')
@section('content')

    <table class='table dataTable'>
        <thead class="text-center">
            <th>Hall ID</th>
            <th>Hall Name</th>
            <th >Actions</th>
        </thead>
        <tbody class="text-center">
            @foreach($halls as $hall)
                <tr>
                    <td>{{ $hall->id}}</td>
                    <td>{{ $hall->name}}</td>
                    <td>
                        <form action="{{ route('delete.hall',$hall->id) }}"></form>
                        <a href="{{ route('assign.hall',$hall->id) }}" class='btn btn-primary btn-sm'><i class="fas fa-pen"></i><span> Assign Courses</span></a>
                        <butoon type="submit" class='btn btn-danger btn-sm' onclick="return confirm('ARE YOU SURE?')"><i class="fas fa-trash-alt"></i> Delete</butoon>
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
