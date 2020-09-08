<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use app\Image;
use Intervention\Image\Facades\Image as ImageIntervention;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        if($request->file('file'))
        {
            $originalImage= $request->file('file');
            $name = time().$originalImage->getClientOriginalName();
            $img = ImageIntervention::make($originalImage);
            $img->orientate();
            $thumbnailPath = public_path().'/thumbnail/';
            $originalPath = public_path().'/images/';
            $img->save($originalPath.$name);
            $thumbnailImage = ImageIntervention::make($originalPath.$name)->fit(145, 145,null,'top');
            $thumbnailImage->orientate();
            $thumbnailImage->save($thumbnailPath.$name);
        }
        return response()->json($name, 200);
    }
}
