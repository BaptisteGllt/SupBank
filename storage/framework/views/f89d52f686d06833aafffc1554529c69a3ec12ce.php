<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Oops..</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="<?php echo e(asset('/css/style.login.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"/>
    <script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <style>
        #intro{
            background-image: url("<?php echo e(asset('/img/bg-img.jpg')); ?>")
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
                    <h2 class="__title">Page not found</h2>

                    <p class="col-MB-40">The page you are looking for was moved, removed, renamed or might never existed.</p>

                    <p><a class="custom-btn custom-btn--medium custom-btn--style-2" href="<?php echo e(url('')); ?>">Home page</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



