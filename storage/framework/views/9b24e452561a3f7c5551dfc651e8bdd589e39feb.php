<?php $__env->startSection('content'); ?>
    <style scoped> .pagination { justify-content: center!important; } </style>


    <main class="main-content">
        <section class="transactions">

            <div class="transactions__header">
                <h2>Transactions</h2>
            </div>
            <form enctype="multipart/form-data" action="<?php echo e(action('TransactionsController@showTransactions')); ?>" name="dropdowntri_tr" method="POST" id="dropdowntri_tr">

            <div class="transactions__filters">

                <div class="transactions__filters-col">

                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="custom-select--grey custom-select--actions">
                            <select id="dropdown_transactions" name="dropdown_transactions" class="custom-select">
                                <option value="All transactions" <?php if(Session::get('dropdown_transactions') == 'All transactions'){ echo "selected"; } ?>>All transactions</option>
                                <option value="Sent" <?php if(Session::get('dropdown_transactions') == 'Sent'){ echo "selected"; } ?>>Sent</option>
                                <option value="Received" <?php if(Session::get('dropdown_transactions') == 'Received'){ echo "selected"; } ?>>Received</option>
                                <option value="Decline" <?php if(Session::get('dropdown_transactions') == 'Decline'){ echo "selected"; } ?>>Decline</option>
                                <option value="Mined" <?php if(Session::get('dropdown_transactions') == 'Mined'){ echo "selected"; } ?>>Mined</option>
                            </select>
                        </div>
                </div>
            </div>
            </form>


            <div class="transactions__list">

                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="transaction">

                        <div class="transaction__header transaction__header--six-cols">
                            <div class="transaction__data">
                                <p><?php echo e($transaction->date); ?></p>
                            </div>

                            <div class="transaction__currency">
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
                                SupCash
                            </div>


                            <?php switch($transaction->state):
                            case ('Sent'): ?>
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
                            <?php case ('Received'): ?>
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
                            <?php case ('Mined'): ?>
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
                            <?php case ('Decline'): ?>
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
                                        <span class="rate rate--minus">- <?php echo e($transaction->currency); ?>SC</span>
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
                            <?php break; ?>
                            <?php endswitch; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div>
                <?php if(count($transactions)>0): ?>
                    <?php echo e($transactions->render()); ?>

                <?php endif; ?>
            </div>
            </div>
        </section>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type='text/javascript'>
        $(document).ready(function(){
            $('#dropdown_transactions').change(function(){
                // Call submit() method on <form id='myform'>
                $('#dropdowntri_tr').submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>