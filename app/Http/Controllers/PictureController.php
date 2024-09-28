<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function upload(Request $request)
    {
        $imgPath = request()->file('file')->store('uploads', 'public');
        return response()->json(['location' => "/storage/$imgPath"]);
    }

    public function delete(Request $request)
    {
        $imgPath = Storage::disk('public')->delete('uploads/'.basename($request->file));
    }
}
