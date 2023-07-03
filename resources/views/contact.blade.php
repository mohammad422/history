@extends('layouts.app')
@section('title')
    تماس با ما
@endsection
@section('content')
    <!-- Page content-->
    <section>
        <div class="container px-5 py-2">
            <!-- Contact form-->
            <div class=" rounded-3 py-5 px-4 px-md-5 mb-1" style="background-color:rgb(243, 229, 216)!important;">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">با ما در تماس باشید.</h1>
                </div>
                <div class="row gx-5 justify-content-center ">
                    <div class="col-lg-8 col-xl-6 ">
                        <!-- * * Contact Form * *-->
                        <form action="{{route('contact.store')}}" method="post">
                            @csrf
                            <!-- Name input-->
                            <div class="form-floating mb-3 ">
                                <input class="form-control" id="name" name="name" type="text"
                                       placeholder="Enter your name..."/>
                                <label for="name" class="w-100 text-right">نام و نام خانوادگی</label>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" name="email" type="email"
                                       placeholder="name@example.com"/>
                                <label for="email" class="w-100 text-right">ایمیل</label>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="body" name="body" type="text"
                                          placeholder="Enter your message here..." style="height: 10rem"></textarea>
                                <label for="body" class="w-100 text-right">متن</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        تلفن همراه: 09126154553
        <br>
        تلفن ثابت:32710828-026
        <br>
        ایمیل: jahanetarikh@gmail.com
        <br>
        آدرس: کرج بلوار سرداران خیابان فرهنگیان کوچه دوم غربی مجتمع هشت بهشت واحد 6
        <br>
    </section>
@endsection
