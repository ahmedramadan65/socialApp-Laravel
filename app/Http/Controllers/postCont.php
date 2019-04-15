<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class postCont extends Controller
{
    //
    
    public function createPost(Request $request) {
        $this->validate($request,[
            'body'=>'required|max:1000',
        ]);
        $message = 'there is some Error';
        $post = new Post();
        $post->body = $request['body'];
        if($request->user()->posts()->save($post)){
            $message='post has been created';
        }
        
        return redirect()->route('dashboard')->with(['message'=>$message]);
    }
    
    public function deletePost($id){
        $post = Post::where('id',$id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with('message','your post deleted');
        
    }
    
     public function editPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }
    
    public function likePost(Request $request){
          $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    
    }
}