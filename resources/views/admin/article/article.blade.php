@extends('layouts.app')
@section('title')
    {{$article->title}}
@endsection
@section('content')
    <!-- Page Content-->
    <section class="py-0">
        <div class="container px-5">
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
                                <i class="bi bi-eye-fill"></i><span style="position: relative; top:-23px;right:-20px;">{{$article->views}}</span>
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
                    </article>
                    <!-- Comments section-->
                    {{--    <section>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <!-- Comment form-->
                                    <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                    <!-- Comment with nested comments-->
                                    <div class="d-flex mb-4">
                                        <!-- Parent comment-->
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                            <!-- Child comment 1-->
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                <div class="ms-3">
                                                    <div class="fw-bold">Commenter Name</div>
                                                    And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                                </div>
                                            </div>
                                            <!-- Child comment 2-->
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                <div class="ms-3">
                                                    <div class="fw-bold">Commenter Name</div>
                                                    When you put money directly to a problem, it makes a good headline.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single comment-->
                                    <div class="d-flex">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>--}}
                    <hr>
                </div>

            </div>
        </div>
    </section>
@endsection
