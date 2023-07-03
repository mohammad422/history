<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comments()
    {
        $comments = Comment::latest()->get();
        return view('admin.comment.comments', compact('comments'));
    }

    public function activation(Comment $comment)
    {
        if ($comment->status == 0) {
            Comment::where('id', $comment->id)->update(['status' => 1]);
        } elseif ($comment->status == 1) {
            Comment::where('id', $comment->id)->update(['status' => 0]);
        }
        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
