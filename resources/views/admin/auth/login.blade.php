@extends('admin.layouts.auth')

@section('title')
    <title>{{ $site_name_en ?? config('site_setting.site_name_en') }} | {{ __('lang.' . strtoupper('Login')) }}</title>
@endsection

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('lang.' . strtoupper('sign_in_to_your_panel')) }}</p>

        <form action="{{ route('admin.login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" placeholder="{{ __('lang.' . strtoupper('email')) }}" required autocomplete="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" value="{{ old('password') }}" placeholder="{{ __('lang.' . strtoupper('password')) }}" required
                       autocomplete="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="icheck-primary">
                        <label for="remember">{{ __('lang.' . strtoupper('remember_me')) }}</label>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('lang.' . strtoupper('login')) }}</button>
                </div>
            </div>
        </form>

{{--        <div class="social-auth-links text-center mb-3">--}}
{{--            <p>- OR -</p>--}}
{{--            <a href="#" class="btn btn-block btn-primary">--}}
{{--                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook--}}
{{--            </a>--}}
{{--            <a href="#" class="btn btn-block btn-danger">--}}
{{--                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+--}}
{{--            </a>--}}
{{--        </div>--}}
        <!-- /.social-auth-links -->

        @if (Route::has('admin.password.request'))
            <p class="mb-1">
                <a href="{{ route('admin.password.request') }}">{{ __('lang.' . strtoupper('forget_password')) }}</a>
            </p>
        @endif

        <p class="mb-0">
            <a href="{{ route('admin.register') }}" class="text-center">{{ __('lang.' . strtoupper('register')) }}</a>
        </p>
    </div>
    <!-- /.login-card-body -->
@endsection
