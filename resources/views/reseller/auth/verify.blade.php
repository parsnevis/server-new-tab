@extends('reseller.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('lang.' . strtoupper('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('lang.' . strtoupper('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('lang.' . strtoupper('Before proceeding, please check your email for a verification link.') }}
                    {{ __('lang.' . strtoupper('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('lang.' . strtoupper('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
