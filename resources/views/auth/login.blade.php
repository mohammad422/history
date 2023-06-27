@extends('layouts.app')
@section('title')
    ورود
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center px-5 py-5" style="margin-bottom: 30px;margin-top: 30px;background-color:rgba(243, 229, 216);">
        <div class="col-md-8 px-lg-5 py-5" >
            <div class="card" >
                <div class="card-header py-3" style="background-color:rgb(153, 102, 51);color:white;">ورود </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">ایمیل</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">گذر واژه</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-check-label col-md-4" for="remember" >
                                مرا بخاطر بسپار
                            </label>
                            <div class="col-md-6">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-4 col-form-label text-md-end"></div>

                            <div class="col-md-6 d-grid">
                                <button type="submit" class="btn btn-primary ">
                                    ثبت
                                </button>
                            </div>
                              {{--  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                       رمز عبور خود را فراموش کرده اید؟
                                    </a>
                                @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
