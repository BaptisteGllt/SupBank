<!-- Fonts -->
<link href="<?php echo e(asset('/css/bootstrap-social.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('/css/style.login.min.css')); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"/>
<script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $__env->startSection('content'); ?>
            <div id="preloder">
                <div class="loader"></div>
            </div>

            <div class="grid grid--container">
                <div class="authorization authorization--login">
                    <a class="site-logo" href="">
                        <img class="img-responsive" width="130" height="42" src="img/favicon.ico" alt="demo">
                    </a>

                    <form class="authorization__form" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <h3 class="__title">Login</h3>

                        <div class="input-wrp">
                            <input placeholder="Email" id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?> textfield" name="email" value="<?php echo e(old('email')); ?>" required autofocus />
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="input-wrp">
                            <i class="textfield-ico fontello-eye"></i>
                            <input  placeholder="Password" id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?> textfield" name="password" required/>
                            <?php if($errors->has('password')): ?>
                                <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                        <p>
                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>"><?php echo e(__('Forgot Your Password?')); ?></a>

                            <button class="custom-btn custom-btn--medium custom-btn--style-2 wide" type="submit"  role="button"><?php echo e(__('Login')); ?></button>
                        </p>

                        <p class="text--center"><a href="<?php echo e(route('register')); ?>">Register</a> if you don’t have an account</p>
                        <hr>
                        <div class="form-group" align="center">
                            <h2>Already registred ?</h2>
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>