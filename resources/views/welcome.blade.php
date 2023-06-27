@extends('layouts.app')
@section('title')
    صفحه اول
@endsection
@section('content')
    <!-- Header-->
    <header class="px-md-5">
        <div class="container px-md-5">
            <span  style="position: relative; top: -45px;">{{Morilog\Jalali\Jalalian::forge(\Carbon\Carbon::now())->format('%A, %d %B %Y')}}</span>
            <div class="row align-items-center justify-content-center px-2" style="background-color:rgb(153, 102, 51)">
                @if($latest_article)
                    <div class="col-lg-7" >
                        <a href="{{url('/articles/'.$latest_article->article_code.'/'.$latest_article->slug)}}">
                            <div class="my-5 text-xl-end">
                                <h1 class="display-7 fw-bolder mb-2" style="color: rgb(249, 241, 235);">{{$latest_article->title}}</h1><br>
                                <p class="lead fw-normal mb-4 text-right" style="color: rgb(243, 228, 216)">{{$latest_article->short_description}}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-5 text-center">
                        <a href="{{url('/articles/'.$latest_article->article_code.'/'.$latest_article->slug)}}">
                            <img class="img-fluid rounded-3 mt-lg-1 mt-xl-5 mb-5"
                                 src="{{asset('image/articles/large/'.$latest_article->image)}}" alt="..."/>
                        </a>
                    </div>
                {{--    <div class="col-lg-1">

                    </div>--}}
                @endif
            </div>
        </div>
    </header>
    <!-- Blog preview section-->
    <section class="py-0">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">آخرین مقالات</h2>
                        <br>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                @foreach($latest_articles as $latest_art)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="{{asset('image/articles/medium/'.$latest_art->image)}}"
                                 alt="..."/>
                            <div class="card-body ">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2 text-light p-1">مقاله</div>
                                <a style="color:rgb(40,40,40)" class="links"
                                   href="{{url('/articles/'.$latest_art->article_code.'/'.$latest_art->slug)}}"><h5 class="card-title mb-3">
                                        {{$latest_art->title}}</h5></a>
                                <p>
                                    {{$latest_art->short_description}}
                                </p>
                            </div>

                            <hr>
                            <div class="card-footer  pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="small">
                                            <div class="fw-bold">{{$latest_art->author}}</div>
                                            <div
                                                class="text-muted">{{Morilog\Jalali\Jalalian::forge($latest_art->created_at)->format('%A, %d %B %Y')}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-0">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">پربازدیدترین مقالات</h2>
                        <br>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                @foreach($most_views_articles as $art)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="{{asset('image/articles/medium/'.$art->image)}}"
                                 alt="..."/>
                            <div class="card-body ">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2 text-light p-1">مقاله</div>
                                <a style="color:rgb(40,40,40)" class="links"
                                   href="{{url('/articles/'.$art->article_code.'/'.$art->slug)}}"><h5 class="card-title mb-3">
                                        {{$art->title}}</h5></a>
                                <p>
                                    {{$art->short_description}}
                                </p>
                            </div>

                            <hr>
                            <div class="card-footer  pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="small">
                                            <div class="fw-bold">{{$art->author}}</div>
                                            <div
                                                class="text-muted">{{Morilog\Jalali\Jalalian::forge($art->created_at)->format('%A, %d %B %Y')}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection


