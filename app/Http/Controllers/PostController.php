<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index(){

        $posts = Post::with(['user', 'likes'])->orderBy('created_at', 'desc')->paginate(20);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post){
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request){

        //dd($request->body);
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create([
            "body" => $request->body
        ]);

        return back();
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
