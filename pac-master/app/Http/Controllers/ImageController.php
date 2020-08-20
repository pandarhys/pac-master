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
            $thumbnailImage = ImageIntervention::make($originalImage);
            $thumbnailPath = public_path().'/thumbnail/';
            $originalPath = public_path().'/images/';
            $thumbnailImage->save($originalPath.$name);
            $thumbnailImage->resize(150,150);
            $thumbnailImage->save($thumbnailPath.$name);
        }
        return response()->json($name, 200);
    }
}
