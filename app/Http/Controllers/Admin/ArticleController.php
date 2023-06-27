<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.panel');
    }

    public function show(Article $article)
    {
        $article = Article::where('id', $article->id)->with('category')->with('tags')->first();

        return view('admin.article.article', compact('article'));
    }

    public function all_articles()
    {
        $articles = Article::latest()->get();

        return view('admin.articles', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.article.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|unique:articles|max:255',
            'short_description' => 'max:500',
            'body' => 'required',
            'image' => 'required|mimes:png,bmp,jpg,jpeg',
            'tags' => 'required'
        ]);

        $imageName = null;
        if ($request->image) {
            $imageName = time() . rand(0, 9999) . '.' . request()->image->getClientOriginalExtension();
            $img = Image::make(request()->image);
//            Storage::put('public/articles/real/' . $imageName, $img);
            $img->save('image/articles/real/' . $imageName);
            $img->resize(920, 500);
//            Storage::put('public/articles/large/' . $imageName, $img);
            $img->save('image/articles/large/' . $imageName);
            $img->resize(362, 201);
//            Storage::put('public/articles/medium/' . $imageName, $img);
            $img->save('image/articles/medium/' . $imageName);
            $img->resize(80, 50);
//            Storage::put('public/articles/small/' . $imageName, $img);
            $img->save('image/articles/small/' . $imageName);
        }

        $code = Article::withTrashed()->max('article_code');
        if($code != null){
            $code = $code + 1;
        }else{
            $code = 1000;
        }

        $article = Article::create([
            'title' => $request['title'],
            'article_code' => $code,
            'category_id' => $request['category_id'],
            'author' => $request['author'],
            'short_description' => $request['short_description'],
            'body' => $request['body'],
            'image' => $imageName,
            'source' => $request['source'],
        ]);

        $all_tags = Tag::all()->pluck('tag_name', 'id')->toArray();
        $tags = $request['tags'];
        $tags = explode(',', $tags);

        foreach ($tags as $tag) {
            if (in_array($tag, $all_tags)) {
                $tag_id = Tag::where('tag_name', $tag)->value('id');
                $article->tags()->attach($tag_id);
            } else {
                $new_tag = Tag::create(['tag_name' => $tag]);
                $article->tags()->attach($new_tag['id']);
            }
        }
        return redirect('/admin/articles/create')->with('success', 'مقاله با موفقیت ثبت شد.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $article->with('tags')->get();
        $tags = [];
        foreach ($article->tags as $tag) {
            $tags[] = $tag->tag_name;
        }
        $tags = implode(',', $tags);
        return view('admin.article.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'max:500',
            'body' => 'required',
            'image' => 'mimes|png,bmp,jpg,jpeg'
        ]);
        $imageName = null;
        if ($request->image) {
            $imageName = time() . rand(0, 9999) . '.' . request()->image->getClientOriginalExtension();
            $img = Image::make(request()->image);
//            Storage::put('public/articles/real/' . $imageName, $img);
            $img->save('image/articles/real/' . $imageName);
            $img->resize(920, 500);
//            Storage::put('public/articles/large/' . $imageName, $img);
            $img->save('image/articles/large/' . $imageName);
            $img->resize(362, 201);
//            Storage::put('public/articles/medium/' . $imageName, $img);
            $img->save('image/articles/medium/' . $imageName);
            $img->resize(80, 50);
//            Storage::put('public/articles/small/' . $imageName, $img);
            $img->save('image/articles/small/' . $imageName);
        } else {
            $imageName = $article->image;
        }

        Article::where('id', $article->id)->update([
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'author' => $request['author'],
            'short_description' => $request['short_description'],
            'body' => $request['body'],
            'image' => $imageName,
            'source' => $request['source'],
        ]);
        $old_tags = [];
        //  $old_tags = Article::with('tags')->where('id',$article->id)->first();
        foreach ($article->tags as $tag) {
            $old_tags[] = $tag->tag_name;
        }
        $all_tags = Tag::all()->pluck('tag_name', 'id')->toArray();

        $tags = $request['tags'];
        $tags = explode(',', $tags);

        foreach ($old_tags as $old_tag) {
            if (!in_array($old_tag, $tags)) {
                $tag_id = Tag::where('tag_name', $old_tag)->value('id');
                $article->tags()->detach($tag_id);
            } else {
                if (($key = array_search($old_tag, $tags)) !== false) {
                    unset($tags[$key]);
                }
            }
        }

        foreach ($tags as $tag) {
            if (in_array($tag, $all_tags)) {
                $tag_id = Tag::where('tag_name', $tag)->value('id');
                $article->tags()->attach($tag_id);
            } else {
                $new_tag = Tag::create(['tag_name' => $tag]);
                $article->tags()->attach($new_tag['id']);
            }
        }

        return redirect()->back()->with('success', 'مقاله با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
//        unlink('image/articles/large/'.$article->image);
//        unlink('image/articles/real/'.$article->image);
//        unlink('image/articles/medium/'.$article->image);
//        unlink('image/articles/small/'.$article->image);
        $article->delete();
        return redirect()->back();

    }

    public function activation(Article $article)
    {
        if ($article->status == 0) {
            Article::where('id', $article->id)->update(['status' => 1]);
        } elseif ($article->status == 1) {
            Article::where('id', $article->id)->update(['status' => 0]);
        }
        return back();
    }

    public function articles_removed()
    {
        $articles = Article::onlyTrashed()->get();

        return view('admin.article.articles_removed', compact('articles'));
    }
    public function restore($id)
    {

        Article::withTrashed()->find($id)->restore();
        return back();
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories',compact('categories'));
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
           'category_name'=>'required|unique:categories'
        ]);

        Category::create([
            'category_name'=>$request['category_name']
        ]);
         return back();
    }

}
