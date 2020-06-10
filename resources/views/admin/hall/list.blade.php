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
                        <a href="#" class='btn btn-primary btn-sm'><i class="fas fa-eye"></i><span> View</span></a>
                        <a href="{{ route('edit.hall', $hall->name) }}" class='btn btn-warning btn-sm fa'><i class="fas fa-pen"></i> Edit</a>
                        <a href="#" class='btn btn-danger btn-sm' onclick="return confirm('ARE YOU SURE?')"><i class="fas fa-trash-alt"></i> Delete</a>
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
