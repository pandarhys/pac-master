<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        if($request->file('file'))
        {
            $image = $request->file('file');
            $name = time().$image->getClientOriginalName();
            $image->move(public_path().'/images/', $name);
        }

        $image= new Image();
        $image->image_name = $name;
        $image->save();

        return response()->json($image, 200);
    }
}
