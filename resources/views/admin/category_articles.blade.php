@extends('layouts.main')

@section('content')
    <div class="container-fluid ">
        <div class="pr-5 pl-5">
            <div class="row">
                <div class="col-md-8 p-4 mb-5" style="background-color: #FFE4B5;">
                    <h4><a href="/">خانه</a> / {{$name}}</h4>
                    <hr>
                    @foreach($articles as $article)
                        <h5><a href="{{url('/articles/'.$article->slug)}}">{{$article->title}}</a></h5>
                        <hr>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

