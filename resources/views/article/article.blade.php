@extends('layouts.app')
@section('title')
    {{$article->title}}
@endsection
@section('content')
    <!-- Page Content-->
    <section class="py-0">
        <div class="container px-5">
            <div class="row">
                <div class="col-lg-3">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row gx-5 py-5" style="background-color:rgb(243, 229, 216); ">
                <div class="col-lg-9">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1" style="color:rgb(77, 51, 25)">{{$article->title}}</h1>
                            <hr>
                            @if($article->author)
                                <span>نویسنده:</span>
                                {{$article->author}}
                            @endif
                            <!-- Post categories-->
                            <a class="badge bg-primary text-decoration-none text-light"
                               href="{{route('category_articles', $article->category->category_name)}}">{{$article->category->category_name}}</a>
                            <br>
                            <div
                                class="text-muted fst-italic mb-2">{{Morilog\Jalali\Jalalian::forge($article->created_at)->format('%d %B %Y')}}
                            </div>

                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded"
                                                  src="{{asset('image/articles/large/'.$article->image)}}" alt="..."/>
                        </figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4">{!! $article->body !!}</p>
                        </section>
                        <section class=" mb-1">
                            @if($article->source)
                                <span>منبع: {{$article->source}}</span>
                            @endif
                            <div style="margin-right: 100% !important;">
                                <i class="bi bi-eye-fill"></i><span
                                    style="position: relative; top:-23px;right:-20px;">{{$article->views}}</span>
                            </div>

                        </section>
                        <hr>

                        <section class="mb-1">
                            <span>کلید واژه ها:</span>
                            @foreach($article->tags as $tag)
                                <span><a class="btn btn-info"
                                         href="{{route('tag.articles',$tag->tag_name)}}">{{$tag->tag_name}}</a></span>
                            @endforeach
                        </section>
                        <hr>
                    </article>
                    <!-- Comments section-->

                    <section>
                        @if(auth()->user())
                            <div class="card bg-light">
                                <div class="card-body">
                                    <!-- Comment form-->
                                    <form class="mb-4" method="post" action="{{route('comments.store')}}">
                                        @csrf
                                        <input name="article_id" type="hidden" value="{{$article->id}}">
                                        <textarea name="body" class="form-control" rows="5" placeholder="دیدگاهتان را وارد کنید."></textarea>
                                        <button class="btn btn-primary mt-2">ارسال دیدگاه</button>
                                    </form>
                                    <hr>
                                    <h5 class="mb-4">نظرات</h5>
                                    <!-- Comment with nested comments-->
                                    @foreach($comments as $comment)
                                    <div class="d-flex mb-4 p-2" style="background-color: rgba(254, 242, 231);">
                                        <!-- Parent comment-->
                                        <div class="ms-3">
                                            <div class="mb-2">
                                                <span class="fw-bold mb-2">{{$comment->user->firstname}}</span><br>
                                                <span style="font-size: smaller">{{Morilog\Jalali\Jalalian::forge($article->updated_at)->format('%d %B %Y')}}</span>
                                            </div>

                                            <div class="text-start">
                                               <span> {{$comment->body}}</span>
                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Single comment-->
                              {{--      <div class="d-flex">
                                        <div class="flex-shrink-0"><img class="rounded-circle"
                                                                        src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                                                        alt="..."/></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            When I look at the universe and all the ways the universe wants to kill us,
                                            I find it hard to reconcile that with statements of beneficence.
                                        </div>
                                    </div>--}}
                                </div>
                            </div>
                        @else
                            <div >
                                <h6>برای ثبت دیدگاه <span><a href="{{route('login')}}">وارد </a></span> سایت شوید یا <span><a href="{{route('register')}}"> ثبت نام</a> </span> کنید. </h6>
                            </div>
                        @endif
                    </section>
                    <hr>
                </div>
                <div class="col-lg-3">
                    <div class=" mt-1 mb-4">
                        <div class="card" style="border-radius: 3px; background-color:#ecd7c6">
                            <h4 class="card-header text-center text-light p-3"
                                style="background-color: rgb(153, 102, 51)">آخرین مطالب</h4>
                            <div class="card-body">
                                @foreach($latest_articles as $art)
                                    <a class="links" style="color:rgb(40,40,40)"
                                       href="{{url('/articles/'.$art->article_code.'/'.$art->slug)}}">{{$art->title}}</a>
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
