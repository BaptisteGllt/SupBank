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
                        <h3 class="__title">Password Recovery</h3>

                        <p>
                            Enter your email and click below to reset your password.
                        </p>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="input-wrp">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} textfield" name="email" value="{{ old('email') }}" required placeholder="Email" />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button class="custom-btn custom-btn--medium custom-btn--style-2 wide" type="submit" role="button">Send link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
