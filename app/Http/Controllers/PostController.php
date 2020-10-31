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
        foreach ($cards as $card) {
            $card['like'] = round(intval($card['like']), 2);
            $card['dislike'] = round(intval($card['dislike']),2);
        }
        return response()->json(['cards' => $cards]);
    }

    public function like(Request $request){
        $post = Post::where('id', $request->id)->first();

        $post->like = $post->like + 1;
        $post->save();
        return true;
    }

    public function dislike(Request $request){
        $post = Post::where('id', $request->id)->first();

        $post->dislike = $post->dislike + 1;
        $post->save();
        return true;
    }
}
