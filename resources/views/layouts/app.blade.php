<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <link rel="shortcut icon" href="" type="image/x-icon" />--}}
    <meta name="csrf-param" content="_csrf">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>جهان تاریخ |@yield('title')</title>
    <!-- Fonts -->
    <link rel="canonical" href="http://jahanetarikh.ir/" />

    <meta name="google-site-verification" content="rQLQObpBxg8KdQE7lcLGNl-cH0GL27S73s-lJxsnEIA">
    <meta name="keywords" content=" جهان تاریخ">
    <meta name="description" content="جهان تاریخ">
    <meta property="og:description" content="جهان تاریخ">
    <meta property="og:title" content="جهان تاریخ">
{{--    <meta property="og:image" content="http://tarikhirani.ir/images/www/fa/website/open-graph/2019/1563096837-tar.png?language=fa">--}}
    <meta property="og:site_name" content="جهان تاریخ">
{{--    <meta name="developer" content="Architects of Communication Age Company">--}}
    <meta name="theme-name" content="jahanetarikh">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->

   <link href="{{asset('css/app-bbd6a014.css')}}" rel="stylesheet">
    <link href="{{asset('css/styles.css?v=1')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-icons.min.css')}}" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100" style="">
<main class="flex-shrink-0 major pb-5">
    <!-- Navigation-->
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark  mb-5">
        <div class="container px-5">
            <a class="navbar-brand" href="{{url('/')}}"><img height="60" src="{{asset('image/logonomy-1686463333509.jpeg')}}"
                                                             width="65" height="45" alt="tarikhnegar"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{url('/')}}">جهان تاریخ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('about')}}">درباره ما</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('contact')}}">تماس با ما</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('articles')}}">مقالات</a></li>
                    @if (Route::has('login'))
                        @auth
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <li class="nav-item">
                                    <button class="btn btn-default nav-link">خروج</button>
                                </li>
                            </form>

                        @else
                            <li class="nav-item"><a class="nav-link" href="{{route('login')}}">ورود</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link" href="{{'register'}}">ثبت نام</a></li>
                            @endif
                        @endauth
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</main>
<!-- Footer-->
<footer class=" py-4 ">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto">
                <a class="link-light small text-light" href="{{url('about')}}">درباره ما</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small text-light" href="{{url('contact')}}">تماس با ما</a>

            </div>
            <div class="col-auto mb-2">
                 <div class="small mb-2 text-white">ایمیل: jahanetarikh@gmail.com</div>
                <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=353165&amp;Code=r3Z9hJ1KNoO9Fq9QUC1F"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id=353165&amp;Code=r3Z9hJ1KNoO9Fq9QUC1F" alt="" style="cursor:pointer" id="r3Z9hJ1KNoO9Fq9QUC1F"></a>
            </div>

        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>--}}
<!-- Core theme JS-->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/fontawesome.min.js')}}"></script>
</body>
</html>
