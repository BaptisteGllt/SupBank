<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js" xmlns="http://www.w3.org/1999/html"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?php $__env->startSection('content'); ?>

    <div class="wrapper">
        <main class="main-content">
    <section class="settings">

        <div class="settings__header">
            <h2>Settings</h2>

            <ul class="settings__tabs">
                <li class="settings__tabs-item active" data-tab="1">User profile</li>
                <li class="settings__tabs-item" data-tab="2">Security</li>
                <li class="settings__tabs-item" data-tab="3">Wallets</li>
            </ul>
        </div>
        <div class="settings__content">

            <div id="tab-1" class="settings__content-item settings__profile active">


                <div class="settings__row">
                    <div class="settings__col">
                        <div class="settings__text">
                            <h4>Load photo</h4>
                            <p>Max file size is 20Mb. <br></p>
                        </div>
                        <div class="upload-image">
                            <img src="<?php echo e($user->avatar); ?>"  style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">

                            <div class="form-group-sm">
                            <form enctype="multipart/form-data" action="/settings" method="POST">
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <button style="position:inherit;" type="submit" name="update_avatar" class="btn btn--blue" value="Submit">Update</button>
                            </form>
                            </div>

                            <input type="hidden" id="storage_path" value="<?php echo e(storage_path()); ?>">


                        </div>

                    </div>

                </div>

                <form action="/settings" method="POST" class="form settings-form">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                    <div class="form__row">

                        <div class="form__col-xl">
                            <label class="form__label">
                                User name
                            </label>
                            <div class="input-wrap">
                                <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>">
                            </div>
                        </div>

                    </div>


                    <div class="form__row">

                        <div class="form__col-xl">
                            <label class="form__label">Adress</label>
                            <div class="input-wrap">
                                <input type="text" name="user_address" value="<?php echo e(Auth::user()->user_address); ?>">
                            </div>
                        </div>

                    </div>

                    <button class="btn btn--green" name="update_info">Save settings</button>

                </form>

            </div>
            <div id="tab-2" class="settings__content-item settings__security">
                <form class="security">

                    <div class="security__row">
                        <div class="security__col">
                            <h3>My private keys</h3>
                            <p>Wallets security keys</p>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e($wallet->name); ?> wallet</h5>
                                        <samp><?php echo e($wallet->private_key); ?></samp>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </form>
            </div>
            <div id="tab-3" class="settings__content-item settings__wallets ">
                <div class="wallet__list">
                    <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="wallet__item">

                        <div class="wallet__item__currency">
                            <svg style="box-shadow: 0 3px 7px rgba(107, 119, 202, 0.57);" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="30px" height="30px" viewBox="0 0 30 30" style="enable-background:new 0 0 30 30;" xml:space="preserve">
                            <path fill="#005572"  d="M16,19.3l-2.9-1.4l0.6,11.6L16,19.3z"/>
                                <path fill="#0076A6"  d="M13.7,29.5L7.4,17.7l5.6,0.1L13.7,29.5z"/>
                                <path fill="#009EE3"  d="M9.9,12.2l-2.5,5.5l5.6,0.1L9.9,12.2z"/>
                                <path fill="#008DBF"  d="M13.1,17.8l-3.1-5.6h6.3L13.1,17.8z"/>
                                <path fill="#0076A5"  d="M13.1,17.8l3.2-5.6L16,19.3L13.1,17.8z"/>
                                <path fill="#36AFE4"  d="M9.9,12.2l-9.1,1.3l6.6,4.2L9.9,12.2z"/>
                                <path fill="#56B9E4"  d="M18.7,7.6l-2.4,4.6H9.9L18.7,7.6z"/>
                                <path fill="#7CCBF6"  d="M18.7,7.6l-8.7,4.6l1.3-5.6L18.7,7.6z"/>
                                <path fill="#57BAE5"  d="M11.3,6.6L0.9,13.5l9.1-1.3L11.3,6.6z"/>
                                <path fill="#00698C"  d="M21.7,25.6L16,19.3l0.2-7L21.7,25.6z"/>
                                <path fill="#028CBF"  d="M21.7,25.6l-5.4-13.3l5.4,1.4L21.7,25.6z"/>
                                <path fill="#0AA0CB"  d="M24.6,22.1l-3,3.5V13.7L24.6,22.1z"/>
                                <path fill="#55BDE2"  d="M21.7,13.7l4.6,8.1l-1.6,0.3L21.7,13.7z"/>
                                <path fill="#77CEF4"  d="M26.2,21.8l-3.6-6.4h2.1L26.2,21.8z"/>
                                <path fill="#0076A6"  d="M26,23l-4.4,2.6l3-3.5L26,23z"/>
                                <path fill="#79CDF3"  d="M22.2,10l-6,2.3l3.2-6.1L22.2,10z"/>
                                <path fill="#0C9FCA"  d="M21.7,13.7l-5.4-1.4l6-2.3L21.7,13.7z"/>
                                <path fill="#8BD8FD"  d="M25,14.9l-3.3-1.2l0.6-3.7L25,14.9z"/>
                                <path fill="#5EB6E5"  d="M19.4,6.2l2.8,3.8l0.3-5.6L19.4,6.2z"/>
                                <path fill="#79CDF3"  d="M27,3.9l-4.4,0.5L22.2,10L27,3.9z"/>
                                <path fill="#01B0E1"  d="M29,4.2l-4.4,2.6l2.3-3L29,4.2z"/>
                                <path fill="#75D3EA"  d="M29,4.2l-2-0.4l2.6-3.4L29,4.2z"/>
</svg>
                            SupCash
                        </div>

                        <div class="wallet__item__status">
                            <div class="status status--active">Active</div>
                        </div>

                        <div class="wallet__item__id">
                            <?php echo e($wallet->num_wallet); ?>

                        </div>

                        <div class="wallet__item__course">
                            <span><?php echo e($wallet->solde); ?> SC</span>
                            <?php echo e($wallet->solde *36); ?> €
                        </div>
                            <form autocomplete="off" enctype="multipart/form-data" action="<?php echo e(action('SettingsController@deleteWallet')); ?>" method="POST"  id="wallet-deletion">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <input type="hidden" name="walletNumber" value="<?php echo e($wallet->num_wallet); ?>">
                                <button class="button-prevent-multiple-submits btn btn--blue" type="submit"  name="delete_wallet" value="Submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>

            </div>

        </div>

    </section>
</main>
    </div>
    <script>
        //file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>