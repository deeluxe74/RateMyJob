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

    public function like(Request $request){
        $picture = Picture::where('post_id', $request->id)
        ->where('url', $request->url)
        ->first();

        $picture->like = $picture->like + 1;
        $picture->save();
        return true;
    }

    public function dislike(Request $request){
        $picture = Picture::where('post_id', $request->id)
            ->where('url', $request->url)
            ->first();
        $picture->dislike = $picture->dislike + 1;
        $picture->save();
        return true;
    }
    
}
