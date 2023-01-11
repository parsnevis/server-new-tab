@extends('admin.layouts.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('lang.' . strtoupper('Reset Password') }}</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('lang.' . strtoupper('E-Mail Address') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('lang.' . strtoupper('Password') }}" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
{{--                <div class="col-12">--}}
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('lang.' . strtoupper('Confirm Password') }}" required autocomplete="new-password">
{{--                </div>--}}
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        {{ __('lang.' . strtoupper('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>

    </div>

@endsection
