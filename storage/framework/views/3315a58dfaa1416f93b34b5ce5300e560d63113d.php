<!-- Fonts -->

<link href="<?php echo e(asset('/css/bootstrap-social.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('/css/style.login.min.css')); ?>" rel="stylesheet">
<link  href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet"/>
<script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<?php $__env->startSection('content'); ?>
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

                    <form class="authorization__form" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>
                        <h3 class="__title">Sign Up</h3>
                        <hr>
                        <div class="form-group" align="center">
                            <h2> Register with...</h2>
                            </br>
                            <div class="flex-c-m">
                                <a href="<?php echo e(URL::route('auth/facebook')); ?>" class="login100-social-item bg1">
                                    <i class="fa fa-facebook fa"></i>
                                </a>

                                <a href="<?php echo e(url('/auth/github')); ?>" class="login100-social-item bg2">
                                    <i class="fa fa-github"></i>
                                </a>

                                <a href="<?php echo e(url('/auth/google')); ?>" class="login100-social-item bg3">
                                    <i class="fa fa-google"></i>
                                </a>
                            </div>
                        </div>
                        <div class="input-wrp">
                            <input id="name" type="text" class="textfield form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus placeholder="Name" />
                            <?php if($errors->has('name')): ?>
                                <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="input-wrp">
                            <input id="email" type="email" class="textfield form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required placeholder="Email" />
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="input-wrp">
                            <i class="textfield-ico fontello-eye" id="password-fontello"></i>
                            <input id="password" type="password" class="textfield form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required placeholder="Password" />
                            <?php if($errors->has('password')): ?>
                                <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="input-wrp">
                            <i class="textfield-ico fontello-eye" id="password-fontello-confirm"></i>
                            <input id="password-confirm" type="password" class="textfield form-control" name="password_confirmation" required placeholder="Confirm Password" />
                        </div>

                        <div class="input-wrp">
                            <input id="user_address" type="user_address" class="textfield form-control<?php echo e($errors->has('user_address') ? ' is-invalid' : ''); ?>" name="user_address" required placeholder="Address" />
                            <?php if($errors->has('user_address')): ?>
                                <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('user_address')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <p>
                            <label class="checkbox">
                                <input name="p1" type="checkbox" value="ok" required />
                                <i class="fontello-check"></i><span>I agree with <a href="">Terms of Services</a></span>
                            </label>
                            <button class="custom-btn custom-btn--medium custom-btn--style-2 wide" type="submit" role="button"><?php echo e(__('Register')); ?></button>
                        </p>

                        <p class="text--center"><a href="<?php echo e(route('login')); ?>">Login</a> if you already have an account</p>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>