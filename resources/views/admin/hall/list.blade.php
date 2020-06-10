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
                        
                        <form action={{ route('delete.hall', $hall->id) }} method="POST">
                            @csrf
                            <a href="{{ route('edit.hall', $hall->name) }}" class='btn btn-warning btn-sm fa'><i class="fas fa-pen"></i> Edit</a>
                            <button type="submit" class='btn btn-danger btn-sm' onclick="return confirm('ARE YOU SURE?')"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>

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