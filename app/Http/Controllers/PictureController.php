<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function getPictures(Request $request) {
        $pictures = Picture::where('post_id', $request->id)->get();
        return response()->json(['pictures' => $pictures]);
    }
    
}
