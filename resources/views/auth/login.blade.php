@extends('layouts.app')
<!-- Fonts -->
<link href="{{ asset('/css/bootstrap-social.css') }}" rel="stylesheet">
<link href="{{ asset('/css/style.login.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
<script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@section('content')
            <div id="preloder">
                <div class="loader"></div>
            </div>

            <div class="grid grid--container">
                <div class="authorization authorization--login">
                    <a class="site-logo" href="">
                        <img class="img-responsive" width="130" height="42" src="img/favicon.ico" alt="demo">
                    </a>

                    <form class="authorization__form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h3 class="__title">Login</h3>

                        <div class="input-wrp">
                            <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} textfield" name="email" value="{{ old('email') }}" required autofocus />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="input-wrp">
                            <i class="textfield-ico fontello-eye"></i>
                            <input  placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} textfield" name="password" required/>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <p>
                            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>

                            <button class="custom-btn custom-btn--medium custom-btn--style-2 wide" type="submit"  role="button">{{ __('Login') }}</button>
                        </p>

                        <p class="text--center"><a href="{{ route('register') }}">Register</a> if you don’t have an account</p>
                        <hr>
                        <div class="form-group" align="center">
                            <h2>Already registred ?</h2>
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
                    </form>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
            <script type="text/javascript">
                $("body").on('click', '.fontello-eye', function() {
                    var input = $("#password");
                    if (input.attr("type") === "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }

                });
            </script>


@endsection
