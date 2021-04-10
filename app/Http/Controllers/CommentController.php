<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\CommentEvent;
use App\Http\Requests\StoreCommentRequest;
use App\Models\{User, Post, PostComment};

class CommentController extends Controller
{
    public function index()
    {
    	return view('index');
    }

    public function store(StoreCommentRequest $request)
    {
        // Find or create new user
        $user = User::where('name', $request->name)->first();
        if (!$user) 
        {
            $user = new User;
            $user->name = $request->name;
            $user->save();
        }

        // Get 1 post
        $post = Post::first();

        // Create new comment
        $comment = new PostComment;
        $comment->user_id = $user->id;
        $comment->post_id = $post->id;
        $comment->content = $request->content;
        $comment->parent_id = isset($request->parent_id) ? $request->parent_id : '';
        $comment->save();

        return response()->json(1);
    }

    public function fetchComments()
    {
        $comments = PostComment::whereNull('parent_id')->with('user', 'replies.user')->get();
        return response()->json($comments);
    }

    public function fetchPost()
    {
        $post = Post::first();
        return response()->json($post);
    }
}
