<?php
namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createNew(Request $request) {
        $post = new Post();
        $pictures = $request->pictures;
        try {
            $post->author = $request->author;
            $post->description = $request->description;
            $post->like = 0;
            $post->dislike = 0;
            $post->save();
            
            foreach ($pictures as $url) {
                $picture = new Picture();
                $picture->post_id = $post->id;
                $picture->url = $url;
                $picture->save();
            }

        }catch(\Exception $e){
            return false;
        }
        return true;
    }

    public function getCards() {
        $cards = Post::orderBy('created_at', 'ASC')->get();
        return response()->json(['cards' => $cards]);
    }
}
