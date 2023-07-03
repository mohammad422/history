<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {

        $request->validate([
            'body'=>'required'
        ]);

        $user_id = Auth::id();
        $body = $request->body;
        $article_id = $request->article_id;
        $article = Article::find($article_id);
        $comment = new Comment(['body' => $body, 'user_id' => $user_id]);
        $article->comments()->save($comment);

       return redirect()->back()->with('success', 'دیدگاه شما ارسال شد.');
     }
}
