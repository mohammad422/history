@extends('layouts.app')
@section('title')
    مقالات
@endsection
@section('content')
    <!-- Page Content-->
    <section class="py-5">
        <div class="container px-5 pb-5">
            <div class="row gx-5 py-5" style="background-color:rgba(243, 229, 216); " >
                <div class="col-lg-9 py-0">
                    <!-- Post content-->
                    <!--All Articles -->
                    <h2 class="fw-bolder mb-4"> مقالات </h2>
                    <hr>
                    <!-- articles item-->
                    @foreach($articles as $article)
                        <div class="row mb-4">
                            <div class="col-md-2" ><img  src="{{asset('image/articles/small/'.$article->image)}}" style="width:100%; height:100%;" alt="article"/></div>
                            <div class="col-md-10" >
                                <div class="small text-muted fst-italic mb-2">{{Morilog\Jalali\Jalalian::forge($article->created_at)->format('%d %B %Y')}}</div>
                                <a class="link-dark" href="{{url('/articles/'.$article->article_code.'/'.$article->slug)}}"><h3>{{$article->title}}</h3></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <div class="col-lg-3">
                    <div class="mt-1 mb-4">
                        <div class="card" style="border-radius: 3px; background-color:#ecd7c6">
                            <h4 class="card-header text-center text-light p-3" style="background-color:rgb(153, 102, 51)">آخرین مطالب</h4>
                            <div class="card-body">
                                @foreach($latest_articles as $article)
                                    <a class="links" style="color:rgb(40,40,40)" href="{{url('/articles/'.$article->article_code.'/'.$article->slug)}}">{{$article->title}}</a>
                                    <br>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
