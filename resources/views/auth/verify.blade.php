@extends('layouts.app')
<link href="{{ asset('/css/bootstrap-social.css') }}" rel="stylesheet">
<link href="{{ asset('/css/style.login.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
<script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
@section('content')
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <div class="grid grid--container">
        <div class="authorization authorization--registration">
            <div class="row">
                <div class="col col--md-auto">
                    <div class="text--center">
                        <a class="site-logo" href="">
                            <img class="img-responsive" width="130" height="42" src="/img/favicon.ico" alt="demo">
                        </a>
                    </div>
                    <form class="authorization__form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <h3 class="__title">Email Verification</h3>

                        <p>
                            Before proceeding, please check your email for a verification link.
                            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.

                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection