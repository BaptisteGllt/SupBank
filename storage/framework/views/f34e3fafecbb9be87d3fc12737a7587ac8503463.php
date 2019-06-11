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

                    <form class="authorization__form" method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo csrf_field(); ?>
                        <h3 class="__title">Password Recovery</h3>

                        <p>
                            Enter your email and click below to reset your password.
                        </p>
                        <?php if(session('status')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <div class="input-wrp">
                            <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?> textfield" name="email" value="<?php echo e(old('email')); ?>" required placeholder="Email" />
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback">
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <button class="custom-btn custom-btn--medium custom-btn--style-2 wide" type="submit" role="button">Send link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>