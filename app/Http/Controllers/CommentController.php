<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Comment::create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
