<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function show($article_code,$slug)
    {
        $article = Article::where('article_code', $article_code)->with('category')->with('tags')->first();
        $latest_articles = cache('articles', function () {
            return Article::where('status', 1)->latest()->take(3)->get();
        });

        $article->increment('views');
        $article->save();
        /* $number_likes = $article->users->count();
         $comments = Comment::where('commentable_id', $article->id)->get();*/
        //dd($number_likes);
        /*  $date = Jalalian::forge('today')->format('%A, %d %B %Y');
          $likes = $article->users->toArray();
          $is_like = false;
          foreach ($likes as $like) {
              if (\Auth::id() === $like['id']) {
                  $is_like = true;
                  break;
              }
          }*/

        //   return view('test', compact('article', 'date', 'number_likes', 'comments', 'is_like'));
        return view('article.article', compact('article', 'latest_articles'));
    }

    public function articles()
    {
        $articles = Article::latest()->get();
        $latest_articles = Article::where('status', 1)->latest()->take(10)->get();
        return view('article.articles', compact('articles', 'latest_articles'));
    }

    public function all_tag_articles(Tag $tag)
    {
        $tag_with_articles = Tag::with('articles')->with(['articles' => function ($query) {
            $query->latest();
        }])->where('id', $tag->id)->first();


        $most_views_tags =DB::table('taggables')->join('tags','tags.id','=','taggables.tag_id')
            ->select(DB::raw('count("tag_id") as repetition, tag_id, tags.tag_name'))
                     ->groupBy('taggables.tag_id','tags.tag_name')
        ->orderBy('repetition', 'desc')->take(3)
        ->get();

        return view('article.tags_articles', compact('tag_with_articles','most_views_tags'));
    }

    public function all_category_articles(Category $category)
    {
        $category_name = $category->category_name;
        $articles_for_category = Article::where('category_id', $category->id)->with('tags')->get();
        $latest_articles = Article::where('status', 1)->latest()->take(10)->get();

        return view('article.categories_articles', compact('category_name', 'articles_for_category', 'latest_articles'));
    }
}
