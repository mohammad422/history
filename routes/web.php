<?php


use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $latest_articles = cache('articles', function () {
        return Article::where('status', 1)->latest()->take(3)->get();
    });
    $most_views_articles = Article::where('status',1)->orderBy('views', 'DESC')->take(3)->get();
    $latest_article = Article::where('status', 1)->latest()->first();
    // $latest_articles = Article::where('status', 1)->latest()->take(3)->get();
    $latest_other_source_articles = Article::where('status', 1)->where('source', '<>', null)->latest()->take(3)->get();
    // $date = Jalalian::forge('today')->format('%A, %d %B %Y');
    return view('welcome', compact('latest_articles', 'latest_article', 'latest_other_source_articles', 'most_views_articles'));
});

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', [\App\Http\Controllers\HomeController::class, 'contact']);
Route::post('/contact/store', [\App\Http\Controllers\HomeController::class, 'contactStore'])->name('contact.store');
Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'articles'])->name('articles');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['can:isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('dashboard');
    Route::get('/articles', [\App\Http\Controllers\Admin\ArticleController::class, 'all_articles'])->name('articles.all');
    Route::get('/articles/create', [\App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles/store', [\App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [\App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}/update', [\App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('articles.update');
    Route::get('/articles/{article}/delete', [\App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('articles.delete');
    Route::get('/articles/{article}/activation', [\App\Http\Controllers\Admin\ArticleController::class, 'activation']);
    Route::get('/articles/removed', [\App\Http\Controllers\Admin\ArticleController::class, 'articles_removed'])->name('articles.removed');
    Route::get('/articles/{id}/restore', [\App\Http\Controllers\Admin\ArticleController::class, 'restore'])->name('articles.restore');
    Route::get('/categories', [\App\Http\Controllers\Admin\ArticleController::class, 'categories'])->name('categories');
    Route::post('/category/store', [\App\Http\Controllers\Admin\ArticleController::class, 'storeCategory'])->name('categories.store');
    Route::get('/articles/{article}',[\App\Http\Controllers\Admin\ArticleController::class,'show']);
});

Route::get('/articles/{article_code}/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('article');

Route::get('/tagarticles/{tag}', [\App\Http\Controllers\ArticleController::class, 'all_tag_articles'])->name('tag.articles');
Route::get('/categoryarticles/{category}', [\App\Http\Controllers\ArticleController::class, 'all_category_articles'])->name('category_articles');
