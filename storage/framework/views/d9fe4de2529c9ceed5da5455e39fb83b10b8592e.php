<?php $__env->startSection('content'); ?>
    <div class="wrapper">
    <main class="main-content">

        <div class="buy">
            <div class="buy__header">

                <h2>Buy/Sale</h2>

            </div>

            <div class="buy__body">
                <form method="post" action="<?php echo e(route('pay')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="exchange">
                        <div class="exchange__col">
                            <label class="form__label">Give Currency:</label>
                            <div class="group-input">
                                <input id="givecurrency" name="CurrencyPrice" required="required" min="0" type="number" step='0.01'>
                                <select id="listMoney" name="listMotto" class="custom-select">
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                        </div>
                        <div class="exchange__col">
                            <label class="form__label">Get Currency:</label>
                            <div class="group-input">
                                <input id="getcurrency" type="number" required="required" min="0" name="ScPrice" step='0.01'>
                                <select id="scselect" class="custom-select">
                                    <option value="SupCash">SupCash</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <label class="form__label">Credit Wallet</label>
                    <div class="form__row">
                        <select class="custom-select" name="select_credit_wallet" required="required" style="display: none;">
                            <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($wallet->num_wallet); ?>">
                                    <?php echo e($wallet->name); ?>

                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="payment">

                        <h3>Payment details</h3>

                        <div class="payment__row">

                            <div class="form__row">
                                <label class="radio-input">
                                    <input class="radio-input__radio" checked="true" name="group1" type="radio">
                                    <span class="radio-input__checkmark"></span>
                                    <img src="img/paypal.png" alt="">
                                </label>
                            </div>
                        </div>


                        <div class="payment__row">
                                <button type="submit" class="btn btn--blue">Buy Currency</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"> </script>

    <script >
        var OneSupcashToDollar = 41;
        var OneSupcashToEuro = 36;
        function getValue(){
            var value;
            var from;
            var to;
            value = document.getElementById("givecurrency").value;
            from = document.getElementById("listMoney").value;
            to = document.getElementById("scselect").value;
            document.getElementById("getcurrency").value = convert(from,to,value).toFixed(2);
        }
        function getValue2(){
            var value2;
            var from2;
            var to2;
            value2 = document.getElementById("getcurrency").value;
            from2 = document.getElementById("scselect").value;
            to2 = document.getElementById("listMoney").value;
            document.getElementById("givecurrency").value = convert(from2,to2,value2).toFixed(2);
        }
        function convert(From,to,value){
            //  1 SupCash = 41 Dollar
            //  1 SupCash = 36 Euro
            if (From == "SupCash"){
                return (To(to, value))/1;
            }
            if (From == "EUR"){
                return (To(to, value))/OneSupcashToEuro;
            }
            if (From == "USD"){
                return (To(to, value))/OneSupcashToDollar;
            }
        }
        function To(to,value){
            if (to == "EUR"){
                return value * OneSupcashToEuro;
            }
            if (to == "USD"){
                return value * OneSupcashToDollar;
            }
            if (to == "SupCash"){
                return value * 1;
            }
        }
        $(document).ready(function() {
            $('#listMoney').on('change', function(){
                getValue();
            });
            $('#getcurrency').on('change keyup', function(){
                getValue2();
            });
            $('#givecurrency').on('change keyup', function(){
                getValue();
            });
        });


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>