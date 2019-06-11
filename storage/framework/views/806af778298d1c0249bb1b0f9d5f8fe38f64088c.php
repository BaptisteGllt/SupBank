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
                        <?php if(session('resent')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

                            </div>
                        <?php endif; ?>
                        <h3 class="__title">Email Verification</h3>

                        <p>
                            Before proceeding, please check your email for a verification link.
                            <?php echo e(__('If you did not receive the email')); ?>, <a href="<?php echo e(route('verification.resend')); ?>"><?php echo e(__('click here to request another')); ?></a>.

                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>