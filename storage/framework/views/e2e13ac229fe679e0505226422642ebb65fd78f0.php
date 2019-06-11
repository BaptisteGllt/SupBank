<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('css/themify-icons.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('css/animate.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"/>
<script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>

<?php $__env->startSection('content'); ?>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
<div class="container">

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>