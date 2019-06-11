<link href="<?php echo e(asset('/css/bootstrap-social.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('/css/style.login.min.css')); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"/>
<script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
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
                        <img class="img-responsive" width="130" height="42" src="/img/favicon.ico" alt="demo">
                    </a>
                </div>

                <form class="authorization__form" method="POST" action="<?php echo e(route('password.request')); ?>">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="token" value="<?php echo e($token); ?>">

                    <h3 class="__title">Reset Password</h3>

                    <div class="input-wrp">
                        <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?> textfield" name="email" value="<?php echo e(isset($email) ? $email : old('email')); ?>" required autofocus placeholder="Email" />
                        <?php if($errors->has('email')): ?>
                            <span class="invalid-feedback">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="input-wrp">
                        <i class="textfield-ico fontello-eye" id="password-fontello"></i>
                        <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?> textfield" name="password" required placeholder="Password" />
                        <?php if($errors->has('password')): ?>
                            <span class="invalid-feedback">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="input-wrp">
                        <i class="textfield-ico fontello-eye" id="password-fontello-confirm"></i>
                        <input id="password-confirm" type="password" class="form-control<?php echo e($errors->has('password_confirmation') ? ' is-invalid' : ''); ?> textfield" name="password_confirmation" required placeholder="Confirm Password" />
                        <?php if($errors->has('password_confirmation')): ?>
                            <span class="invalid-feedback">
                                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                            </span>
                        <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>