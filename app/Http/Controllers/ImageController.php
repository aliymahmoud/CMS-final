<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function get($folderA,$folderB)
    {
        $imagesA = \File::allFiles(public_path($folderA));
        $imagesB = \File::allFiles(public_path($folderB));
        return view('images',compact('imagesA','imagesB','folderA','folderB'));
    }
    public function post(Request $request)
    {
        // return $request;
        foreach($request->better as $better){
            $folder = explode('/',$better)[0];
            $image = explode('/',$better)[1];
            $source = public_path($folder)."/".$image;
            if (!file_exists(public_path($request->folderName))) {
                mkdir(public_path($request->folderName), 0777, true);
            }
            $destination = public_path($request->folderName);
            copy($source,$destination.'/'.$image);
        }
        return "folder created succesfuly";
    }
}
