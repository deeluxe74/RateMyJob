<?php
namespace App\Http\Controllers;

use App\Models\Chat;
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
            $post->save();
            
            foreach ($pictures as $url) {
                if(@getimagesize($url)){
                    $picture = new Picture();
                    $picture->post_id = $post->id;
                    $picture->url = $url;
                    $picture->like = 0;
                    $picture->dislike = 0;
                    $picture->save();
                }else {
                    $post->delete();
                    return response()->json(['error' => true, 'message' => 'Une image ne semble pas existé, avez vous vérifiez vos urls ?']);
                }
                
            }

        }catch(\Exception $e){
            $post->delete();
            return response()->json(['error' => true, 'message' => 'Une erreur est survenue, veuillez remplir correctement les champs.']);
        }
        return response()->json(['error' => false]);
    }

    public function getCards() {
        $cards = Post::orderBy('created_at', 'ASC')->get();
        foreach ($cards as $card) {
            $like = 0;
            $dislike = 0;
            $pictures = Picture::where('post_id', $card->id)->get();
            foreach ($pictures as $picture) {
                $like += intval($picture->like);
                $dislike += intval($picture->dislike);
            }
            $card['like'] = $like;
            $card['dislike'] = $dislike;
        }
        return response()->json(['cards' => $cards]); 
    }

    public function setComment(Request $request) {
        $chat = new Chat();
        $chat->post_id = $request->id;
        $chat->author = $request->author;
        $chat->comment = $request->comment;

        $chat->save();
        return response()->json([ 'chat' => $chat]);
    }

    public function getComment(Request $request) {
        $comments = Chat::where('post_id', $request->id)->get();

        return response()->json([ 'comments' => $comments]);
    }

    public function getCommentsNum(Request $request) {
        $comments = Chat::where('post_id', $request->id)->get();
        $commentsNum = count($comments);
    
        return response()->json([ 'commentsNum' => $commentsNum]);
    }
}
