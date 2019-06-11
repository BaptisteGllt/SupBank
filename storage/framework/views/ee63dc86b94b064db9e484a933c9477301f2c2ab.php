<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <meta name="description" content="SupBank Home">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="shortcut icon"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.min.css')); ?>" rel="stylesheet">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Load google font
        ================================================== -->
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Lato:300,400,500,700'] }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- Load other scripts
    ================================================== -->
    <script type="text/javascript">
        var _html = document.documentElement;
        _html.className = _html.className.replace("no-js","js");
    </script>
</head>
<body>
    <div id="app">
            <?php if(auth()->guard()->guest()): ?>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel ">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <?php echo e(config('app.name', 'Laravel')); ?>

                        <img src="/img/favicon.ico" alt="home" style="width: 20px; height: 20px;  margin-right: 30px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                    <li><a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a></li>
                    <li><a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php else: ?>
                <div>

                    <header class="header">

                        <div class="inner-col">

                            <a style="color: rgba(0,0,0,.9); margin-left: 30px;" class="navbar-brand" href="<?php echo e(url('/')); ?>">
                                <?php echo e(config('app.name', 'Laravel')); ?> <span class="caret"></span>
                                <img src="/img/favicon.ico" alt="home" style="width: 20px; height: 20px; margin-right: 30px;">
                            </a>

                            <div class="btn-menu btn-menu--left">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>

                        </div>


                        <div class="inner-row align-right">

                            <div class="notification">
                                <div class="notification__icon">
                                    <img src="img/SVG/notification-icon.svg" alt="">
                                </div>
                                <div class="notification__list">
                                    <div class="notification__list-item">
                                        <p><span class="circle" style="background-color: #58a3ea;"></span>	Sent Litecoin</p>
                                        <span class="rate rate--minus">- 0.1 LTC</span>
                                    </div>
                                    <div class="notification__list-item">
                                        <p><span class="circle" style="background-color: #45d25c;"></span>Recieved Bitcoin</p>
                                        <span class="rate rate--plus">+ 0.056 BTC</span>
                                    </div>
                                    <div class="notification__list-item">
                                        <p><span class="circle" style="background-color: #fd5e71;"></span>Declined Bitcoin</p>
                                        <span class="rate rate--normal">1 BTC</span>
                                    </div>
                                    <div class="notification__list-item">
                                        <p><span class="circle" style="background-color: #58a3ea;"></span>Sent Litecoin</p>
                                        <span class="rate rate--minus">- 0.1 LTC</span>
                                    </div>
                                    <a href="" class="notification__more">See more</a>
                                </div>
                            </div>

                            <div class="d-none d-md-block">
                                <div class="user">
                                    <div class="user__avatar">
                                        <img src="<?php echo e(Auth::user()->avatar); ?>" alt="">
                                        <div class="user__arr">
                                            <img src="img/SVG/user-dropdown-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <p class="user__name">
                                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                    </p>
                                    <ul class="user-menu">
                                        <li class="user-menu__item">
                                            <a href="" class="user-menu__link">
                        <span class="user-menu__icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="18px" height="18px" viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
                                   <path d="M9,6C7.343,6,6,7.343,6,9c0,1.657,1.343,3,3,3c1.657,0,3-1.343,3-3C12,7.343,10.657,6,9,6z M9,10.5
                                       c-0.828,0-1.5-0.672-1.5-1.5S8.172,7.5,9,7.5s1.5,0.672,1.5,1.5S9.828,10.5,9,10.5z M15.75,6.75h-1.32l0.93-0.93
                                       c0.847-0.909,0.797-2.333-0.112-3.18c-0.864-0.805-2.203-0.805-3.068,0l-0.93,0.93V2.25C11.25,1.007,10.243,0,9,0
                                       C7.757,0,6.75,1.007,6.75,2.25v1.32L5.82,2.625C4.911,1.778,3.487,1.828,2.64,2.737c-0.805,0.864-0.805,2.203,0,3.068l0.93,0.93
                                       H2.25C1.007,6.735,0,7.742,0,8.985c0,1.243,1.007,2.25,2.25,2.25h1.32L2.625,12.18c-0.847,0.909-0.797,2.333,0.112,3.18
                                       c0.864,0.805,2.203,0.805,3.068,0l0.93-0.93v1.32c0,1.243,1.007,2.25,2.25,2.25c1.243,0,2.25-1.007,2.25-2.25v-1.32l0.93,0.93
                                       c0.909,0.847,2.333,0.797,3.18-0.112c0.805-0.864,0.805-2.203,0-3.068l-0.93-0.93h1.32c1.243,0.008,2.257-0.992,2.265-2.235V9
                                       C18,7.757,16.993,6.75,15.75,6.75z M15.75,9.75h-1.56c-0.125,0.868-0.465,1.69-0.99,2.393l1.102,1.102
                                       c0.269,0.315,0.233,0.788-0.082,1.057c-0.281,0.241-0.695,0.241-0.976,0L12.142,13.2c-0.702,0.525-1.525,0.865-2.393,0.99v1.56
                                       c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75v-1.56c-0.868-0.125-1.69-0.465-2.393-0.99l-1.102,1.102
                                       c-0.315,0.269-0.788,0.233-1.057-0.082c-0.241-0.281-0.241-0.695,0-0.976l1.102-1.102c-0.525-0.702-0.865-1.525-0.99-2.393h-1.56
                                       c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h1.56c0.125-0.868,0.465-1.69,0.99-2.393L3.697,4.754
                                       C3.428,4.439,3.464,3.966,3.779,3.697c0.281-0.241,0.695-0.241,0.976,0l1.102,1.102c0.702-0.525,1.525-0.865,2.393-0.99v-1.56
                                       c0-0.414,0.336-0.75,0.75-0.75s0.75,0.336,0.75,0.75v1.56c0.868,0.125,1.69,0.465,2.393,0.99l1.102-1.102
                                       c0.315-0.269,0.788-0.233,1.057,0.082c0.241,0.281,0.241,0.695,0,0.976L13.2,5.857c0.525,0.702,0.865,1.525,0.99,2.393h1.56
                                       c0.414,0,0.75,0.336,0.75,0.75S16.164,9.75,15.75,9.75z"/>
                           </svg>
                        </span>
                                                <span class="user-menu__text">
                            Settings
                        </span>
                                            </a>
                                        </li>
                                        <li class="user-menu__item">
                                            <a href="<?php echo e(url('/settings')); ?>" class="user-menu__link">
                        <span href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" class="user-menu__icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="9.467px" height="11px" viewBox="0 0 9.467 11" style="enable-background:new 0 0 9.467 11;" xml:space="preserve">
                                   <path d="M8.545,5.135H7.811V2.971C7.811,1.332,6.481,0,4.841,0H4.625C2.987,0,1.656,1.331,1.656,2.971
                                       v0.721h1.231V2.971c0-0.96,0.78-1.74,1.738-1.74h0.216c0.959,0,1.738,0.781,1.738,1.74v2.165H0.922C0.416,5.135,0,5.548,0,6.056
                                       v4.024C0,10.587,0.413,11,0.922,11h7.622c0.507,0,0.922-0.412,0.922-0.92V6.056C9.467,5.548,9.054,5.135,8.545,5.135z
                                        M8.236,9.769H1.231V6.366h7.005V9.769z"/>
                           </svg>
                        </span>
                                                <span href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" class="user-menu__text">
                            Logout
                        </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="btn-menu btn-menu--right">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>

                        </div>

                    </header>

                    <div class="content">
                        <aside class="sidebar">
                            <div class="sidebar__close-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="16" viewBox="0 0 15 16"><defs><path id="hy9fa" d="M294.49 17.58L307.92 31l-1.41 1.41L293.08 19z"/><path id="hy9fb" d="M293.08 31.01l13.43-13.43 1.41 1.41-13.43 13.43z"/></defs><g><g transform="translate(-293 -17)"><use fill="#fff" xlink:href="#hy9fa"/></g><g transform="translate(-293 -17)"><use fill="#fff" xlink:href="#hy9fb"/></g></g></svg>
                            </div>

                            <ul class="menu">
                                <li id="wallet-link" class="menu__item">
                                    <a class="menu__link" href="<?php echo e(url('/wallet')); ?>">
                <span class="menu__link-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="15px" height="15px" viewBox="120.5 14.5 15 15" style="enable-background:new 120.5 14.5 15 15;" xml:space="preserve">

                           <path d="M133.921,18.447L123.658,14.5c-0.872,0-1.579,0.707-1.579,1.579v2.368
                               c-0.872,0-1.579,0.707-1.579,1.579v7.895c0,0.872,0.707,1.579,1.579,1.579h11.842c0.872,0,1.579-0.707,1.579-1.579v-7.895
                               C135.5,19.154,134.793,18.447,133.921,18.447z M123.657,17.088c0.001-0.436,0.354-0.789,0.79-0.788l5.526,2.146h-6.316V17.088z
                                M133.921,27.13c0,0.436-0.354,0.79-0.79,0.79h-10.263c-0.436-0.001-0.789-0.354-0.789-0.79v-6.315
                               c0-0.436,0.353-0.789,0.789-0.79h10.263c0.436,0,0.79,0.354,0.79,0.79V27.13z M124.842,23.183h-0.79
                               c-0.217,0.003-0.392,0.178-0.395,0.395v0.789c0.003,0.217,0.178,0.392,0.395,0.395h0.79v0.001
                               c0.217-0.003,0.393-0.179,0.395-0.396v-0.789C125.234,23.361,125.059,23.186,124.842,23.183z"/>
                   </svg>
                </span>
                                        <span class="menu__link-text">
                    Wallet
                </span>
                                    </a>
                                </li>
                                <li id="transactions-link" class="menu__item">
                                    <a class="menu__link" href="<?php echo e(url('/transactions')); ?>">
                <span class="menu__link-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="15.277px" height="12px" viewBox="18.361 16 15.277 12" style="enable-background:new 18.361 16 15.277 12;"
                         xml:space="preserve">
                   <path d="M27.858,19.159H20.79l2.003-2.003c0.264-0.264,0.264-0.694,0-0.958
                       c-0.262-0.263-0.692-0.264-0.956-0.002l-3.334,3.303c-0.091,0.091-0.142,0.211-0.142,0.34c0,0.129,0.05,0.25,0.141,0.341l3.3,3.3
                       c0.264,0.264,0.694,0.265,0.959,0c0.262-0.263,0.264-0.691,0.003-0.955l-1.98-2.005h7.075c2.437,0,4.42,1.983,4.42,4.42v2.38
                       c0,0.375,0.305,0.68,0.68,0.68c0.375,0,0.68-0.305,0.68-0.68v-2.38C33.639,21.752,31.045,19.159,27.858,19.159z"/>
                   </svg>
                </span>
                                        <span class="menu__link-text">
                    Transactions
                </span>
                                    </a>
                                </li>
                                <li id="buysale-link" class="menu__item">
                                    <a class="menu__link" href="<?php echo e(url('/buy')); ?>">
                <span class="menu__link-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="13.5px" height="18px" viewBox="0 0 13.5 18" style="enable-background:new 0 0 13.5 18;" xml:space="preserve">
                   <path d="M10.5,4.5V3.75C10.5,1.679,8.821,0,6.75,0S3,1.679,3,3.75V4.5H0v11.25C0,16.993,1.007,18,2.25,18h9
                       c1.243,0,2.25-1.007,2.25-2.25V4.5H10.5z M4.5,3.75c0-1.243,1.007-2.25,2.25-2.25S9,2.507,9,3.75V4.5H4.5V3.75z M12,15.75
                       c0,0.414-0.336,0.75-0.75,0.75h-9c-0.414,0-0.75-0.336-0.75-0.75V6H12V15.75z"/>
                   </svg>
                </span>
                                        <span class="menu__link-text">
                    Buy/Sale
                </span>
                                    </a>
                                </li>
                                <li id="settings-link" class="menu__item">
                                    <a class="menu__link" href="<?php echo e(url('/settings')); ?>">
                <span class="menu__link-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="18px" height="18px" viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
                           <path d="M9,6C7.343,6,6,7.343,6,9c0,1.657,1.343,3,3,3c1.657,0,3-1.343,3-3C12,7.343,10.657,6,9,6z M9,10.5
                               c-0.828,0-1.5-0.672-1.5-1.5S8.172,7.5,9,7.5s1.5,0.672,1.5,1.5S9.828,10.5,9,10.5z M15.75,6.75h-1.32l0.93-0.93
                               c0.847-0.909,0.797-2.333-0.112-3.18c-0.864-0.805-2.203-0.805-3.068,0l-0.93,0.93V2.25C11.25,1.007,10.243,0,9,0
                               C7.757,0,6.75,1.007,6.75,2.25v1.32L5.82,2.625C4.911,1.778,3.487,1.828,2.64,2.737c-0.805,0.864-0.805,2.203,0,3.068l0.93,0.93
                               H2.25C1.007,6.735,0,7.742,0,8.985c0,1.243,1.007,2.25,2.25,2.25h1.32L2.625,12.18c-0.847,0.909-0.797,2.333,0.112,3.18
                               c0.864,0.805,2.203,0.805,3.068,0l0.93-0.93v1.32c0,1.243,1.007,2.25,2.25,2.25c1.243,0,2.25-1.007,2.25-2.25v-1.32l0.93,0.93
                               c0.909,0.847,2.333,0.797,3.18-0.112c0.805-0.864,0.805-2.203,0-3.068l-0.93-0.93h1.32c1.243,0.008,2.257-0.992,2.265-2.235V9
                               C18,7.757,16.993,6.75,15.75,6.75z M15.75,9.75h-1.56c-0.125,0.868-0.465,1.69-0.99,2.393l1.102,1.102
                               c0.269,0.315,0.233,0.788-0.082,1.057c-0.281,0.241-0.695,0.241-0.976,0L12.142,13.2c-0.702,0.525-1.525,0.865-2.393,0.99v1.56
                               c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75v-1.56c-0.868-0.125-1.69-0.465-2.393-0.99l-1.102,1.102
                               c-0.315,0.269-0.788,0.233-1.057-0.082c-0.241-0.281-0.241-0.695,0-0.976l1.102-1.102c-0.525-0.702-0.865-1.525-0.99-2.393h-1.56
                               c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h1.56c0.125-0.868,0.465-1.69,0.99-2.393L3.697,4.754
                               C3.428,4.439,3.464,3.966,3.779,3.697c0.281-0.241,0.695-0.241,0.976,0l1.102,1.102c0.702-0.525,1.525-0.865,2.393-0.99v-1.56
                               c0-0.414,0.336-0.75,0.75-0.75s0.75,0.336,0.75,0.75v1.56c0.868,0.125,1.69,0.465,2.393,0.99l1.102-1.102
                               c0.315-0.269,0.788-0.233,1.057,0.082c0.241,0.281,0.241,0.695,0,0.976L13.2,5.857c0.525,0.702,0.865,1.525,0.99,2.393h1.56
                               c0.414,0,0.75,0.336,0.75,0.75S16.164,9.75,15.75,9.75z"/>
                   </svg>
                </span>
                                        <span class="menu__link-text">
                    Settings
                </span>
                                    </a>
                                </li>
                                <li id="archive-link" class="menu__item">
                                    <a class="menu__link" href="<?php echo e(url('/settings')); ?>">
                <span class="menu__link-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="18px" height="16px" viewBox="-12 15 18 16" style="enable-background:new -12 15 18 16;" xml:space="preserve">
                           <path d="M6,19.557L-3,15l-9,4.557l9,4.318L6,19.557z M-3,16.681l5.608,2.84L-3,22.211l-5.608-2.69
                               L-3,16.681z M2.561,26.668L-3,29.336l-5.561-2.668h-3.412L-12,26.682L-3,31l9-4.318l-0.027-0.014H2.561z M2.561,23.106L-3,25.774
                               l-5.561-2.668h-3.412L-12,23.12l9,4.318l9-4.318l-0.027-0.014C5.973,23.106,2.561,23.106,2.561,23.106z"/>
                   </svg>
                </span>
                                        <span class="menu__link-text">
                    Archive
                </span>
                                    </a>
                                </li>
                            </ul>

                            <div class="d-md-none">
                                <div class="user">
                                    <div class="user__avatar">
                                        <img src="<?php echo e(Auth::user()->avatar); ?>" alt="">
                                        <div class="user__arr">
                                            <img src="img/SVG/user-dropdown-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <p class="user__name">
                                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                    </p>
                                    <ul class="user-menu">
                                        <li class="user-menu__item">
                                            <a href="" class="user-menu__link">
                        <span class="user-menu__icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="18px" height="18px" viewBox="0 0 18 18" style="enable-background:new 0 0 18 18;" xml:space="preserve">
                                   <path d="M9,6C7.343,6,6,7.343,6,9c0,1.657,1.343,3,3,3c1.657,0,3-1.343,3-3C12,7.343,10.657,6,9,6z M9,10.5
                                       c-0.828,0-1.5-0.672-1.5-1.5S8.172,7.5,9,7.5s1.5,0.672,1.5,1.5S9.828,10.5,9,10.5z M15.75,6.75h-1.32l0.93-0.93
                                       c0.847-0.909,0.797-2.333-0.112-3.18c-0.864-0.805-2.203-0.805-3.068,0l-0.93,0.93V2.25C11.25,1.007,10.243,0,9,0
                                       C7.757,0,6.75,1.007,6.75,2.25v1.32L5.82,2.625C4.911,1.778,3.487,1.828,2.64,2.737c-0.805,0.864-0.805,2.203,0,3.068l0.93,0.93
                                       H2.25C1.007,6.735,0,7.742,0,8.985c0,1.243,1.007,2.25,2.25,2.25h1.32L2.625,12.18c-0.847,0.909-0.797,2.333,0.112,3.18
                                       c0.864,0.805,2.203,0.805,3.068,0l0.93-0.93v1.32c0,1.243,1.007,2.25,2.25,2.25c1.243,0,2.25-1.007,2.25-2.25v-1.32l0.93,0.93
                                       c0.909,0.847,2.333,0.797,3.18-0.112c0.805-0.864,0.805-2.203,0-3.068l-0.93-0.93h1.32c1.243,0.008,2.257-0.992,2.265-2.235V9
                                       C18,7.757,16.993,6.75,15.75,6.75z M15.75,9.75h-1.56c-0.125,0.868-0.465,1.69-0.99,2.393l1.102,1.102
                                       c0.269,0.315,0.233,0.788-0.082,1.057c-0.281,0.241-0.695,0.241-0.976,0L12.142,13.2c-0.702,0.525-1.525,0.865-2.393,0.99v1.56
                                       c0,0.414-0.336,0.75-0.75,0.75s-0.75-0.336-0.75-0.75v-1.56c-0.868-0.125-1.69-0.465-2.393-0.99l-1.102,1.102
                                       c-0.315,0.269-0.788,0.233-1.057-0.082c-0.241-0.281-0.241-0.695,0-0.976l1.102-1.102c-0.525-0.702-0.865-1.525-0.99-2.393h-1.56
                                       c-0.414,0-0.75-0.336-0.75-0.75s0.336-0.75,0.75-0.75h1.56c0.125-0.868,0.465-1.69,0.99-2.393L3.697,4.754
                                       C3.428,4.439,3.464,3.966,3.779,3.697c0.281-0.241,0.695-0.241,0.976,0l1.102,1.102c0.702-0.525,1.525-0.865,2.393-0.99v-1.56
                                       c0-0.414,0.336-0.75,0.75-0.75s0.75,0.336,0.75,0.75v1.56c0.868,0.125,1.69,0.465,2.393,0.99l1.102-1.102
                                       c0.315-0.269,0.788-0.233,1.057,0.082c0.241,0.281,0.241,0.695,0,0.976L13.2,5.857c0.525,0.702,0.865,1.525,0.99,2.393h1.56
                                       c0.414,0,0.75,0.336,0.75,0.75S16.164,9.75,15.75,9.75z"/>
                           </svg>
                        </span>
                                                <span class="user-menu__text">
                            Settings
                        </span>
                                            </a>
                                        </li>
                                        <li class="user-menu__item">
                                            <a href="<?php echo e(url('/settings')); ?>" class="user-menu__link">
                        <span href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" class="user-menu__icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="9.467px" height="11px" viewBox="0 0 9.467 11" style="enable-background:new 0 0 9.467 11;" xml:space="preserve">
                                   <path d="M8.545,5.135H7.811V2.971C7.811,1.332,6.481,0,4.841,0H4.625C2.987,0,1.656,1.331,1.656,2.971
                                       v0.721h1.231V2.971c0-0.96,0.78-1.74,1.738-1.74h0.216c0.959,0,1.738,0.781,1.738,1.74v2.165H0.922C0.416,5.135,0,5.548,0,6.056
                                       v4.024C0,10.587,0.413,11,0.922,11h7.622c0.507,0,0.922-0.412,0.922-0.92V6.056C9.467,5.548,9.054,5.135,8.545,5.135z
                                        M8.236,9.769H1.231V6.366h7.005V9.769z"/>
                           </svg>
                        </span>
                                                <span href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" class="user-menu__text">
                            Logout
                        </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="copyright">
                                © 2019 SupBank
                            </div>

                        </aside>
                    </div>
                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            <?php endif; ?>
    </div>
    </div>


        <main class="">
            <?php echo $__env->yieldContent('content'); ?>
        </main>


    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-2.2.4.min.js"><\/script>')</script>
    <script type="text/javascript" src="<?php echo e(asset('js/scripts.min.js')); ?>"></script>

</body>
</html>
