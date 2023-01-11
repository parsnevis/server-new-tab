@extends('reseller.layouts.auth')

@section('title')
    <title>{{ $site_name_en ?? config('site_setting.site_name_en') }} | {{ __('lang.' . strtoupper('login')) }}</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">{{ __('lang.' . strtoupper('register_a_new_membership')) }}</p>

            <form action="{{ route('reseller.register') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('lang.' . strtoupper('first_name')) }}" required autocomplete="first_name" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('lang.' . strtoupper('last_name')) }}" required autocomplete="last_name" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('lang.' . strtoupper('email')) }}" required autocomplete="email">
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
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="{{ __('lang.' . strtoupper('password')) }}" required autocomplete="password">
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

                <div class="input-group mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password') }}" placeholder="{{ __('lang.' . strtoupper('confirm_password')) }}" required autocomplete="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <label for="agreeTerms">
                                <a href="{{ route('terms') }}">{{ __('lang.' . strtoupper('terms')) }}</a>
                                <span>{{ __('lang.' . strtoupper('I_agree_to_the')) }}</span>
                            </label>
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('lang.' . strtoupper('register')) }}</button>
                    </div>
                </div>
            </form>

{{--            <div class="social-auth-links text-center">--}}
{{--                <p>- OR -</p>--}}
{{--                <a href="#" class="btn btn-block btn-primary">--}}
{{--                    <i class="fab fa-facebook mr-2"></i>--}}
{{--                    Sign up using Facebook--}}
{{--                </a>--}}
{{--                <a href="#" class="btn btn-block btn-danger">--}}
{{--                    <i class="fab fa-google-plus mr-2"></i>--}}
{{--                    Sign up using Google+--}}
{{--                </a>--}}
{{--            </div>--}}

            <a href="{{ route('reseller.login') }}" class="text-center">{{ __('lang.' . strtoupper('I_already_have_a_membership')) }}</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
@endsection
