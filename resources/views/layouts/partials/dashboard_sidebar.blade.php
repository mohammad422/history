<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar" >
            <div class="sidebar-sticky">
                <ul class="nav flex-column" >
                    <li class="nav-item"   >
                        <a class="nav-link active" href="{{route('dashboard')}}" >
                            <span data-feather="home"></span>
                            داشبورد
                        </a>
                    </li>
                    <li class="nav-item"   >
                        <a class="nav-link active" href="{{route('articles.all')}}" >
                            <span data-feather="home"></span>
                            مقالات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('articles.create')}}">
                            <span data-feather="file"></span>
                           افزودن مقاله
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('articles.removed')}}">
                            <span data-feather="file"></span>
                            مقالات حذف شده
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categories')}}">
                            <span data-feather="file"></span>
                            دسته ها
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        @yield('content')
    </div>
</div>
