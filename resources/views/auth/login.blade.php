


@extends('layout.flay')
@include('layout.nav')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style='text-align:center'> تسجيل الدخول </div>

                <div class="card-body">
                    @if (session()->has('ban'))
                    <div class="alert alert-danger" style='text-align: center' role="alert">
                        <strong style='color:white'>{{ session()->get('ban') }}</strong>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end"> الايميل </label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-end"> كلمة المرور</label>

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
                            <div class="col-md-6 offset-md-4">
                                {{-- <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                        تذكرنى
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                </div> --}}
                            </div>
                        </div>


                        <div class="col-md-12 col-12 yas">
                            <button type="submit" class="btn btn-primary btn-lg btn-block"> تسجيل الدخول </button>
                        </div>
                        <div class="row" style='text-align: center'>
                            <div class="col-md-6 col-12 ">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    هل نسيت كلمة السر ؟
                                </a>
                                @endif
                        </div>
                        <div class="col-md-6 col-12 ">
                            <a class="btn btn-link" href="{{ route('register') }}" >
                              أو يمكنك إنشاء حساب جديد
                          </a>
                        </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
