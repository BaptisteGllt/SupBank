<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Be right back</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('/css/style.login.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <style>
        #intro{
            background-image: url("{{ asset('/img/bg-img.jpg') }}")
        }
    </style>
</head>
<body class="page-404">

<div id="preloder">
    <div class="loader"></div>
</div>

<div id="intro">
    <div class="grid grid--container">
        <div class="row row--xs-middle">
            <div class="col col--sm-10 col--md-7 col--lg-5 text--center">
                <span class="span">Ooops!</span>
                <br>
                <h2 class="__title">Sorry we are down for maintenance.</h2>

                <p class="col-MB-40">We will be back shortly.</p>

            </div>
        </div>
    </div>
</div>
</body>
<body>
<div class="flex-center position-ref full-height">
        <div class="title m-b-md">

        </div>
</div>
</body>
</html>
