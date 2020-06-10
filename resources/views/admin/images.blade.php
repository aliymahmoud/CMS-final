<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></head>
<body>
    <a href="{{  url('home') }}"> testing</a>
    <form action="{{ route('post') }}" method="post">
        @csrf
        <table class="table">
        <thead class="text-center">
            <th>Index</th>
            <th>Gamma</th>
            <th>Linear</th>
        </thead>
        <tbody class="text-center">
                @foreach($imagesA as $index=>$image)
                    <tr class="current_row" current="{{ $index }}">
                        <td>{{ $index }}</td>
                        <input type="hidden" value="">
                        <td>
                            <label class="row-linear-click">
                                <div class="col-md-12 m-auto">
                                    <img src="{{ asset($folderA ."/". $image->getFilename()) }}" height="500" width="500">
                                </div>
                                <div class="col-md-12 m-auto">
                                    <label class="font-weight-bold" for="gamma">Gamma</label>
                                    <input class="row-{{ $index }}-linear-input" type="checkbox" id="gamma" value="{{ $folderA ."/".$image->getFilename() }}" name="better[]" >
                                </div>
                            </label>
                        </td>

                        {{-- <td><img src="{{ asset('covid/' . $covid[$index]->getFilename()) }}" height="500" width="500"></td> --}}

                        <td>
                            <label>
                                <div class="col-md-12 m-auto">
                                    <img src="{{ asset($folderB ."/" . $imagesB[$index]->getFilename()) }}" height="500" width="500">
                                </div>
                                <div class="col-md-12 m-auto">
                                    <label class="font-weight-bold" for="linear">Linear</label>
                                    <input class="row-{{ $index }}-gamma-input" type="checkbox" id="linear" value="{{ $folderB ."/".$imagesB[$index]->getFilename() }}" name="better[]" >
                                </div>
                            </label>
                        </td>

                    </tr>
            @endforeach
            </tbody>
        </table>
        <div class="form-group justify-content-center">
            <input type="text" class="form-control " name='folderName' required placeholder="Folder Name">
        </div>
        <div class="text-center form-group">
            <button type="submit" class="btn btn-primary " >Submit</button>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('.row-linear-click').on('click',function(){
            var index = $(this).parents("tr").attr('current');
            $(".row-"+index+"-linear-input").on('click',function(){
                $(".row-"+index+"-gamma-input").prop('checked',false);
                // $(".row-"+index+"-gamma-input").prop('required',false);
                $(".row-"+index+"-linear-input").prop('checked',true);
            });
            $(".row-"+index+"-gamma-input").on('click',function(){
                $(".row-"+index+"-linear-input").prop('checked',false);
                // $(".row-"+index+"-linear-input").prop('required',false);
                $(".row-"+index+"-gamma-input").prop('checked',true);
            });
        });
        $('#state_form').on('change',function(){
            $("#state_form").sumbit();
        })
        
    })
</script>
</body>
</html>
    
