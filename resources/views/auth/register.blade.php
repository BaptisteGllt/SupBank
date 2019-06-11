@extends('layouts.app')
<!-- Fonts -->

<link href="{{ asset('/css/bootstrap-social.css') }}" rel="stylesheet">
<link href="{{ asset('/css/style.login.min.css') }}" rel="stylesheet">
<link  href="{{ asset('css/style.css') }}" rel="stylesheet"/>
<script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

    @media screen and (max-height: 575px){
        #rc-imageselect,
        .g-recaptcha {
            transform:scale(0.77);
            transform-origin:0;
            transform:scale(0.77);
            transform-origin:0 0;
            -webkit-transform:scale(0.77);
            transform:scale(0.77);
            -webkit-transform-origin:0 0;
            transform-origin:0 0;
        }
    }
</style>
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
                            <img class="img-responsive" width="130" height="42" src="img/favicon.ico" alt="demo">
                        </a>
                    </div>

                    <form class="authorization__form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <h3 class="__title">Sign Up</h3>
                        <hr>
                        <div class="form-group" align="center">
                            <h2> Register with...</h2>
                            </br>
                            <div class="flex-c-m">
                                <a href="{{URL::route('auth/facebook')}}" class="login100-social-item bg1">
                                    <i class="fa fa-facebook fa"></i>
                                </a>

                                <a href="{{ url('/auth/github') }}" class="login100-social-item bg2">
                                    <i class="fa fa-github"></i>
                                </a>

                                <a href="{{ url('/auth/google') }}" class="login100-social-item bg3">
                                    <i class="fa fa-google"></i>
                                </a>
                            </div>
                        </div>
                        <div class="input-wrp">
                            <input id="name" type="text" class="textfield form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Name" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="input-wrp">
                            <input id="email" type="email" class="textfield form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email" />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="input-wrp">
                            <i class="textfield-ico fontello-eye" id="password-fontello"></i>
                            <input id="password" type="password" class="textfield form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password" />
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-wrp">
                            <i class="textfield-ico fontello-eye" id="password-fontello-confirm"></i>
                            <input id="password-confirm" type="password" class="textfield form-control" name="password_confirmation" required placeholder="Confirm Password" />
                        </div>

                        <div class="input-wrp">
                            <input id="user_address" type="user_address" class="textfield form-control{{ $errors->has('user_address') ? ' is-invalid' : '' }}" name="user_address" required placeholder="Address" />
                            @if ($errors->has('user_address'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-wrp">
                            <div class="g-recaptcha" style="text-align: -webkit-match-parent;"  type="g-recaptcha-response" name="g-recaptcha-response" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                            <input class="form-control form-control{{ $errors->has('g-recaptcha-response') ? ' is-invalid' : '' }}"hidden>
                            @if($errors->has('g-recaptcha-response'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                        <p>
                            <label class="checkbox">
                                <input name="p1" type="checkbox" value="ok" required />
                                <i class="fontello-check"></i><span>I agree with <a href="{{ url('/terms') }}">Terms of Services</a></span>
                            </label>
                            <button class="custom-btn custom-btn--medium custom-btn--style-2 wide" type="submit" role="button">{{ __('Register') }}</button>
                        </p>


                        <p class="text--center"><a href="{{ route('login') }}">Login</a> if you already have an account</p>

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
        var width = $('.g-recaptcha').parent().width();
        if (width < 302) {
            var scale = width / 302;
            $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
            $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
            $('.g-recaptcha').css('transform-origin', '0 0');
            $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
        }
    </script>
@endsection
