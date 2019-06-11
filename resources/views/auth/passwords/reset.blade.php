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

                <form class="authorization__form" method="POST" action="{{ route('password.request') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <h3 class="__title">Reset Password</h3>

                    <div class="input-wrp">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} textfield" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Email" />
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-wrp">
                        <i class="textfield-ico fontello-eye" id="password-fontello"></i>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} textfield" name="password" required placeholder="Password" />
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-wrp">
                        <i class="textfield-ico fontello-eye" id="password-fontello-confirm"></i>
                        <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} textfield" name="password_confirmation" required placeholder="Confirm Password" />
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button class="custom-btn custom-btn--medium custom-btn--style-2 wide" type="submit" role="button">Reset password</button>
                </form>
            </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
        $("body").on('click', '.fontello-eye', function() {
            var pfontello = $(this).attr('id');
            if (pfontello === "password-fontello-confirm"){
                var input = $("#password-confirm");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            }
            else {
                var input = $("#password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            }
        });
    </script>
@endsection
