<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo e(config('app.name', 'Laravel')); ?> - Landing Page</title>
        <meta charset="UTF-8">
        <meta name="description" content="Cryptocurrency">
        <meta name="keywords" content="cryptocurrency, supbank, creative">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="shortcut icon"/>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link rel="stylesheet" href="css/themify-icons.css"/>
        <link rel="stylesheet" href="css/animate.css"/>
        <link rel="stylesheet" href="css/owl.carousel.css"/>
        <link rel="stylesheet" href="css/style.css"/>


        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

        </style>
    </head>
    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>
        <!-- Header section -->
        <header class="header-section clearfix">
            <div class="container-fluid">
                <a href="<?php echo e(url('/')); ?>" class="site-logo">
                    <img src="img/logo.png" alt="home">
                </a>
                <div class="responsive-bar"><i class="fa fa-bars"></i></div>
                <a href=<?php echo e(url('/settings')); ?> class="user"><i class="fa fa-user"></i></a>
                <nav class="main-menu">
                    <ul class="menu-list">
                        <?php if(auth()->guard()->check()): ?>
                        <li><a href="<?php echo e(url('/wallet')); ?>">My wallet</a></li>
                        <li><a href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                        <?php else: ?>
                            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- Hero section -->
        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 hero-text">
                        <h2>Invest in <span>SupCash</span> <br>SupBank's money</h2>
                        <h4>Use SupCash to anonymize your internet purchases and earn money.</h4>
                        <form class="hero-subscribe-from">
                            <a href="<?php echo e(url('/register')); ?>" class="site-btn sb-gradients">Get Started</a>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <img src="img/laptop.png" class="laptop-image" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero section end -->

        <!-- About section -->
        <section class="about-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 about-text">
                        <h2>What is SupCash</h2>
                        <h5>SupCash is a reliable and secure means of payment thanks to an efficient miner network.</h5>
                        <p>SupBank is a service that allows its users to invest in SupCash, a virtual currency that can be used anywhere on the planet, in a convenient and unrestricted way.
                            <br>SupBank will also allow you to earn money by joining its minor network.</p>
                        <a href="<?php echo e(url('/register')); ?>" class="site-btn sb-gradients sbg-line mt-5">Get Started</a>
                    </div>
                </div>
                <div class="about-img">
                    <img src="img/about-img.png" alt="">
                </div>
            </div>
        </section>
        <!-- About section end -->

        <!-- Features section -->
        <section class="features-section spad gradient-bg">
            <div class="container text-white">
                <div class="section-title text-center">
                    <h2>Our Features</h2>
                    <p>SupCash is the simplest way to exchange money at very low cost.</p>
                </div>
                <div class="row">
                    <!-- feature -->
                    <div class="col-md-6 col-lg-4 feature">
                        <i class="ti-mobile"></i>
                        <div class="feature-content">
                            <h4>Mobile Apps</h4>
                            <p>A mobile application 'SupBank' is also available on Android.<br/>
                                It will allow you to perform the same actions as on the web version.. </p>

                        </div>
                    </div>
                    <!-- feature -->
                    <div class="col-md-6 col-lg-4 feature">
                        <i class="ti-shield"></i>
                        <div class="feature-content">
                            <h4>Wallet Encryption</h4>
                            <p>Wallet Encryption allows you to secure your transactions and your account.<br>
                                This encryption anonymizes all your actions with SupBank</p>

                        </div>
                    </div>
                    <!-- feature -->
                    <div class="col-md-6 col-lg-4 feature">
                        <i class="ti-wallet"></i>
                        <div class="feature-content">
                            <h4>Wallet</h4>
                            <p>SupBank authorizes to create up to 3 wallets per account.<br/>
                                You will be able to make transactions between your wallets or to other external wallets</p>

                        </div>
                    </div>
                    <!-- feature -->
                    <div class="col-md-6 col-lg-4 feature">
                        <i class="ti-bookmark-alt"></i>
                        <div class="feature-content">
                            <h4>History Wallet</h4>
                            <p>Your SupBank account will allow you to view all your wallets transactions over time.<br/>
                                Keep an eye on your expenses all over your wallets transactions</p>

                        </div>
                    </div>
                    <!-- feature -->
                    <div class="col-md-6 col-lg-4 feature">
                        <i class="ti-exchange-vertical"></i>
                        <div class="feature-content">
                            <h4>P2P</h4>
                            <p>All operations that you will perform will be analyzed by all minors and will be rewarded in SupCash.<br/>
                                One way to make instant payments.</p>

                        </div>
                    </div>
                    <!-- feature -->
                    <div class="col-md-6 col-lg-4 feature">
                        <i class="ti-money"></i>
                        <div class="feature-content">
                            <h4>Mining Reward</h4>
                            <p>SupBank remunerates its miners based on the amount of the transaction. <br/>
                                This payment is made by our system, your wallet is not charged to it. </p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features section end -->

        <!-- Process section -->
        <section class="process-section spad">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Get Started With SupBank</h2>
                    <p>Start easily, and spend your SupCash in a few minutes ! </p>
                </div>
                <div class="row">
                    <div class="col-md-4 process">
                        <div class="process-step">
                            <figure class="process-icon">
                                <img src="img/process-icons/1M.png" alt="#">
                            </figure>
                            <h4>Create Your Account</h4>
                            <p>By disclosing some information to us, you will be able to create a ready-to-use account.</p>
                        </div>
                    </div>
                    <div class="col-md-4 process">
                        <div class="process-step">
                            <figure class="process-icon">
                                <img src="img/process-icons/2M.png" alt="#">
                            </figure>
                            <h4>Create Your Wallet</h4>
                            <p>Create your different wallets in just a click, and add some SupCash. Your wallets are ready to use. </p>
                        </div>
                    </div>
                    <div class="col-md-4 process">
                        <div class="process-step">
                            <figure class="process-icon">
                                <img src="img/process-icons/3M.png" alt="#">
                            </figure>
                            <h4>Spend your SupCash</h4>
                            <p>Anonymously send SupCash through the internet and all services supporting payments by SupBank. </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Process section end -->

        <!-- Fact section -->
        <section class="fact-section gradient-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="fact">
                            <h2>3</h2>
                            <p>Up To<br>Wallets</p>
                            <i class="ti-wallet"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="fact">
                            <h2>1</h2>
                            <p>&#8240; tax<br>Transacts</p>
                            <i class="ti-stats-up"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="fact">
                            <h2>0.03</h2>
                            <p>SupCash<br>for a dollar</p>
                            <i class="ti-money"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="fact">
                            <h2>2</h2>
                            <p>Currency <br>to get supcash</p>
                            <i class="ti-reload"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Fact section end -->

        <!-- Team section -->
        <section class="team-section spad">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Meet Our Team</h2>
                    <p>Discover our experts in the field of crypto currency and the creators of SupBank!</p>
                </div>
            </div>
            <div class="team-members row  justify-content-md-center">
                <!-- Team member -->
                <div class="member">
                    <div class="member-text">
                        <div class="member-img set-bg" data-setbg="img/member/1.jpg"></div>
                        <h2>Hamza Naciri Farid</h2>
                        <span>Web Integrator</span>
                    </div>
                    <div class="member-info">
                        <div class="member-img mf set-bg" data-setbg="img/member/1.jpg"></div>
                        <div class="member-meta">
                            <h2>Hamza Naciri Farid</h2>
                            <span>Web Integrator</span>
                        </div>
                        <p>Hamza is the developer who set up all the functionality of the web application of our service. He looked at the methods of transactions between wallets.</p>
                    </div>
                </div>

                <!-- Team member -->
                <div class="member">
                    <div class="member-text">
                        <div class="member-img set-bg" data-setbg="img/member/2.jpg"></div>
                        <h2>Julien Jagosz</h2>
                        <span>Blockchain's SupCash Author</span>
                    </div>
                    <div class="member-info">
                        <div class="member-img mf set-bg" data-setbg="img/member/2.jpg"></div>
                        <div class="member-meta">
                            <h2>Julien Jagosz</h2>
                            <span>Blockchain's SupCash Author</span>
                        </div>
                        <p>Julien is a PHP developer who advocates crypto-curency as the payment method of tomorrow, he is one of the main creators of the blockchain.</p>
                    </div>
                </div>

                <!-- Team member -->
                <div class="member">
                    <div class="member-text">
                        <div class="member-img set-bg" data-setbg="img/member/3.jpg"></div>
                        <h2>Baptiste Gillet</h2>
                        <span>Web Integrator</span>
                    </div>
                    <div class="member-info">
                        <div class="member-img mf set-bg" data-setbg="img/member/3.jpg"></div>
                        <div class="member-meta">
                            <h2>Baptiste Gillet</h2>
                            <span>Web Integrator</span>
                        </div>
                        <p>Baptiste is the developer who participates in the development of the web application but also to create the blockchain explorer.</p>
                    </div>
                </div>
                <!-- Team member -->
                <div class="member">
                    <div class="member-text">
                        <div class="member-img set-bg" data-setbg="img/member/4.jpg"></div>
                        <h2>Clément Dutoit</h2>
                        <span>App Developper</span>
                    </div>

                    <div class="member-info">
                        <div class="member-img mf set-bg" data-setbg="img/member/4.jpg"></div>
                        <div class="member-meta">
                            <h2>Clément Dutoit</h2>
                            <span>App Developper</span>
                        </div>
                        <p>Clement is a Pro-Android developer who set up all the functionalities of the Android application of our service.</p>
                    </div>
                </div>
            </div>

        </section>
        <!-- Team section -->



        <!-- Blog section -->





























































        <!-- Blog section end -->

        <!-- Footer section -->
        <footer class="footer-section">
            <div class="container">
                <div class="row spad">
                    <div class="col-md-6 col-lg-4 footer-widget">
                        <img src="img/logo.png" class="mb-4" alt=""><h5 class="widget-title">By SupBank</h5><br>
                        <span>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</a>
                            </span>
                    </div>
                    <div class="col-md-6 col-lg-3 offset-lg-1 footer-widget">
                        <h5 class="widget-title">Documentation Resources</h5>
                        <ul>
                            <li><a href="#">Users Manual</a></li>
                            <li><a href="#">Users Manual - How To join the network of minors</a></li>
                            <li><a href="#">Technical Documentation</a></li>
                        </ul>
                    </div>







                </div>
                <div class="footer-bottom">
                    <div class="row">
                        <div class="col-lg-4 store-links text-center text-lg-left pb-3 pb-lg-0">

                            <a href=""><img src="img/playstore.png" alt=""></a>
                        </div>
                        <div class="col-lg-8 text-center text-lg-right">
                            <ul class="footer-nav">
                                <li><a href="<?php echo e(url('/terms')); ?>">Terms of Use</a></li>
                                <li><a href="mailto:welcomesupbank@gmail.com">welcomesupbank@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--====== Javascripts & Jquery ======-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>
    </body>

</html>
