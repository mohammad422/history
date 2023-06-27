@extends('layouts.dashboard')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 pb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">ایجاد دسته</h1>
        </div>
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
        </div>
        <div class="p-5" style="">
            <form action="{{url('/admin/category/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category_name">عنوان</label>
                    <input type="text" name="category_name" value="{{old('category_name')}}"
                           class="form-control" id="category_name" placeholder="عنوان">
                </div>
                <button type="submit" class="btn btn-primary px-5">ثبت</button>
            </form>
        </div>

    </main>
@endsection



