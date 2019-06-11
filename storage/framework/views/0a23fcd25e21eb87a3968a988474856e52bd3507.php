<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <img src="<?php echo e($user->avatar); ?>"  style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">
               <h2><?php echo e($user->name); ?></h2>
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <label>Update profile image</label>
                </br>
                        <input type="file" name="avatar">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="submit" class="pull-right btn btn-sm btn-primary" value="Submit">
                </form>

            </div>
        </div>
    </div>

    <input type="hidden" id="storage_path" value="<?php echo e(storage_path()); ?>">


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>