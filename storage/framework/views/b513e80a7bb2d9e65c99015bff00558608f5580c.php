<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $__env->startSection('content'); ?>

    <main class="main-content">
        <section class="wallets">
            <h2>My wallets</h2>

            <div class="wallets__list">
                <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('showDetailWallet', [$wallet->num_wallet])); ?>" class="wallet" style="background-color: #158EBD;">
                         <span class="wallet__header">
								<span class="wallet__currency">
									<span class="wallet__currency-icon">

										<svg version="1.1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 260.8 248.3" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             width="42px" height="42px" viewBox="0 0 260.8 248.3" fill="#005572" xml:space="preserve">
											<g>
												<path d="m137.7 160.9-26.8-12.2 5.7 99.6z" fill="#005572"/>
                                                <path d="m116.6 248.3-56.9-100.6 51.2 1z" fill="#0076a6"/>
                                                <path d="m82.3 100.5-22.6 47.2 51.2 1z" fill="#009ee3"/>
                                                <path d="m110.9 148.7-28.6-48.2h57.4z" fill="#008dbf"/>
                                                <path d="m110.9 148.7 28.8-48.2-2 60.4z" fill="#0076a5"/>
                                                <path d="m82.3 100.5-82.3 10.9 59.7 36.3z" fill="#36afe4"/>
                                                <path d="m161.7 60.9-22 39.6h-57.4z" fill="#56b9e4"/>
                                                <path d="m161.7 60.9-79.4 39.6 12-47.9z" fill="#7ccbf6"/>
                                                <path d="m94.3 52.6-94.3 58.8 82.3-10.9z" fill="#57bae5"/>
                                                <path d="m188.8 215.1-51.1-54.2 1.7-59.9z" fill="#00698c"/>
                                                <path d="m188.8 215.1-49.4-114.1 49.4 12.1z" fill="#028cbf"/>
                                                <path d="m215.9 185-27.1 30.1v-102z" fill="#0aa0cb"/>
                                                <path d="m188.8 113.1 41.5 69.3-14.4 2.6z" fill="#55bde2"/>
                                                <path d="m230.3 182.4-32.8-54.7h19.3z" fill="#77cef4"/>
                                                <path d="m228.5 192.6-39.7 22.5 27.1-30.1z" fill="#0076a6"/>
                                                <path d="m194.2 81.3-54.8 19.7 29.1-52.2z" fill="#79cdf3"/>
                                                <path d="m188.8 113.1-49.1-12.2 54.5-19.6z" fill="#0c9fca"/>
                                                <path d="m219.1 123.3-30.3-10.2 5.4-31.8z" fill="#8bd8fd"/>
                                                <path d="m168.5 48.8 25.7 32.5 2.7-47.9z" fill="#5eb6e5"/>
                                                <path d="m237.2 29.2-40.3 4.2-2.7 47.9z" fill="#79cdf3"/>
                                                <path d="m255.6 32.3-39.6 22.6 21.2-25.7z" fill="#01b0e1"/>
                                                <path d="m255.6 32.3-18.4-3.1 23.6-29.2z" fill="#75d3ea"/>
											</g>
									   </svg>
									</span>
									<span class="wallet__currency-info">
										<span><?php echo e($wallet->name); ?></span>
										<span>SC</span>
									</span>
								</span>

								<span class="wallet__course">
									<span><?php echo e(strlen($wallet->solde)>=11 ? substr(($wallet->solde),0,9).".." : $wallet->solde); ?> SC</span>
									<span> <?php echo e(strlen($wallet->solde *36)>=11 ? substr(($wallet->solde *36),0,9).".." : $wallet->solde *36); ?> €</span>
								</span>
							</span>

                        <span class="wallet__footer">
								<span>1 SC - 36 € </span>
								<span><?php echo e($wallet->lastTransaction); ?>€</span>
                    </span>

                        <span class="wallet__bg-img">
								<img src="../img/wallet-bg-img-2.png" alt="">
                    </span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                <a href="#" id="add-new-wallet" class="add-wallet">
							<span class="add-wallet__icon">
								<img src="../img/add-wallet-icon.png" alt="">
							</span>
                    <span class="add-wallet__text">
								Add New Wallet
                    </span>
                </a>
            </div>
        </section>

        <section class="transactions">
            <h3>Transactions</h3>

            <div class="transactions__list">

                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="transaction">

                        <div class="transaction__header transaction__header--six-cols">
                            <div class="transaction__data">
                                <p><?php echo e($transaction->date); ?></p>
                            </div>

                            <div class="transaction__currency">
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

                            <?php switch($transaction->status):
                            case (0): ?>
                            <?php if($transaction->state == 'sent'): ?>
                                <div class="transaction__info">
                                    <img src="../img/SVG/transaction-icon-sent.svg" alt="">
                                    <p>
                                        Sent to <?php echo e(strlen($transaction->receiver)>=20 ? substr(($transaction->receiver),0,20).".." : $transaction->receiver); ?>

                                    </p>
                                </div>
                                <div class="transaction__status">
                                    <div class="status status--sent">
                                        Sent
                                    </div>
                                </div>

                                <div class="transaction__course">
                                    <span class="rate rate--pending">- <?php echo e($transaction->currency); ?> SC</span>
                                    <span class="rate rate--normal">- <?php echo e($transaction->currency * 36); ?> €</span>
                                </div>
                        </div>

                        <div class="transaction__body">
                            <ul class="transaction__details">
                                <li>
                                    <span>Miner adress:</span> <?php echo e($transaction->miner); ?>

                                </li>
                                <li>
                                    <span>Sender adress:</span> <?php echo e($transaction->sender); ?>

                                </li>
                                <li>
                                    <span>Condition:</span> Sent
                                </li>
                            </ul>
                        </div>
                        <?php break; ?>
                        <?php elseif($transaction->state == 'received'): ?>
                            <div class="transaction__info">
                                <img src="../img/SVG/transaction-icon-recived.svg" alt="">
                                <p>
                                    Sent by <?php echo e(strlen($transaction->sender)>=20 ? substr(($transaction->sender),0,20).".." : $transaction->sender); ?>

                                </p>
                            </div>
                            <div class="transaction__status">
                                <div class="status status--recived">
                                    Received
                                </div>
                            </div>

                            <div class="transaction__course">
                                <span class="rate rate--plus">+ <?php echo e($transaction->currency); ?> SC</span>
                                <span class="rate rate--normal">+ <?php echo e($transaction->currency * 36); ?> €</span>
                            </div>
                    </div>

                    <div class="transaction__body">
                        <ul class="transaction__details">
                            <li>
                                <span>Miner adress:</span> <?php echo e($transaction->miner); ?>

                            </li>
                            <li>
                                <span>Sender adress:</span> <?php echo e($transaction->sender); ?>

                            </li>
                            <li>
                                <span>Earner adress:</span> <?php echo e($transaction->receiver); ?>

                            </li>
                            <li>
                                <span>Condition:</span> Received
                            </li>
                        </ul>
                    </div>
                    <?php break; ?>
                    <?php elseif($transaction->state == 'mined'): ?>
                        <div class="transaction__info">
                            <img src="../img/SVG/transaction-icon-pending.svg" alt="">
                            <p>
                                Sent by <?php echo e(strlen($transaction->sender)>=20 ? substr(($transaction->sender),0,20).".." : $transaction->sender); ?>

                            </p>
                        </div>
                        <div class="transaction__status">
                            <div class="status status--pending">
                                Mined
                            </div>
                        </div>

                        <div class="transaction__course">
                            <span class="rate rate--plus">+ <?php echo e($transaction->taxe); ?> SC</span>
                            <span class="rate rate--normal">+ <?php echo e($transaction->taxe * 36); ?> €</span>
                        </div>
                        </div>

                        <div class="transaction__body">
                            <ul class="transaction__details">
                                <li>
                                    <span>Miner adress:</span> <?php echo e($transaction->miner); ?>

                                </li>
                                <li>
                                    <span>Sender adress:</span> <?php echo e($transaction->sender); ?>

                                </li>
                                <li>
                                    <span>Earner adress:</span> <?php echo e($transaction->miner); ?>

                                </li>
                                <li>
                                    <span>Condition:</span> Mined
                                </li>
                            </ul>
                        </div>
                    <?php break; ?>
                    <?php endif; ?>

                    <?php default: ?>
                    <div class="transaction__info">
                        <img src="../img/SVG/transaction-icon-disable.svg" alt="">
                        <p>
                            Sent to <?php echo e(strlen($transaction->receiver)>=20 ? substr(($transaction->receiver),0,20).".." : $transaction->receiver); ?>

                        </p>
                    </div>
                    <div class="transaction__status">
                        <div class="status status--decline">
                            Decline
                        </div>
                    </div>
                    <div class="transaction__course">
                        <span class="rate rate--minus">- <?php echo e($transaction->currency); ?> SC</span>
                        <span class="rate rate--normal">- <?php echo e($transaction->currency * 36); ?> €</span>
                    </div>
            </div>

            <div class="transaction__body">
                <ul class="transaction__details">
                    <li>
                        <span>Miner adress:</span> <?php echo e($transaction->miner); ?>

                    </li>
                    <li>
                        <span>Sender adress:</span> <?php echo e($transaction->sender); ?>

                    </li>
                    <li>
                        <span>Condition:</span> Decline
                    </li>
                </ul>
            </div>
            <?php endswitch; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    </main>
    <div id="popup-new-wallet" class="mfp-container mfp-inline-holder d-none"><div class="mfp-content">
            <form class="form-prevent-multiple-submits popup popup-add-wallet zoom-anim-dialog" enctype="multipart/form-data" action="<?php echo e(action('WalletController@createNewWallet')); ?>" method="POST" id="add-wallet">
                <div class="popup__content">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <img class="popup-add-wallet__img" src="../img/popup-add-wallet-icon.png" alt="">
                    <h3>Add new wallet</h3>

                    <div class="popup-add-wallet__row">

                        <div class="input-wrap">
                            <input type="text" required="required" maxlength="12" name="wallet-new-name" placeholder="Name wallet">
                        </div>

                        <select class="custom-select" style="display: none;">
                            <option value="SupCash">SupCash</option>
                        </select>
                    </div>

                    <button class="button-prevent-multiple-submits btn btn--blue btn--full" type="submit"  name="create_wallet" value="Submit">
                        <i class="spinner fa fa-spinner fa-spin d-none"></i> Add new wallet</button>
                </div>
                <button title="Close (Esc)" id="close-popup-wallet" type="button" class="mfp-close">×</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>