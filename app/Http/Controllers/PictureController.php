<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function upload(Request $request)
    {
        $imgPath = request()->file('file')->store('uploads', 'public');
        return response()->json(['location' => "/storage/$imgPath"]);
    }
}
