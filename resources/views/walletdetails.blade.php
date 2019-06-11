@extends('layouts.app')
@section('content')
    <div class="content">
        <main class="main-content">
            <div class="wallet-inner">
                <div class="wallet-inner__header">
                    <h2>{{$walletDetails->name}}</h2>
                </div>
            </div>
            <div class="wallet-inner__row">
                <div class="wallet-inner__col">
                    <div class="wallet wallet--full-width" style="background-color: #158EBD;">

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
										<span>{{$walletDetails->name}}</span>
										<span>SC</span>
									</span>
								</span>

								<span class="wallet__last-transactions">
									<span>{{$walletDetails->todaySold}}</span>
									<span>Last day</span>
								</span>

								<span class="wallet__currency-course">
									<span>1 SC</span>
									<span>36 € </span>
								</span>

								<span class="wallet__course">
									<span>{{$walletDetails->solde}} SC</span>
									<span>{{$walletDetails->solde *36}}  €</span>
								</span>
							</span>

                        <span class="wallet__footer">
								<a href="#" id="edit-wallet" class="small-btn">Edit</a>

								<span><b>Wallet number:</b> <span id="post-shortlink">{{$walletDetails->num_wallet}}</span></span>
                                <button class="btn btn-copy fa fa-copy" id="copy-button" data-clipboard-target="#post-shortlink" title="Copy to clipboard">
                                </button>

                        <span class="wallet__bg-img">
								<img src="../img/wallet-bg-img-2.png" alt="">
							</span>
                    </div>

                    <div class="wallet-inner__chart">
                        <h3>SupCash Chart</h3>
                        <div class="chart">
                            <canvas id="line-chart"></canvas>
                        </div>
                        <div class="wallet-inner__btns">
                            <button id="send-supcash" class="btn btn--blue">Send SupCash</button>
                        </div>
                    </div>
                </div>
                <div class="wallet-inner__col">
                    <section class="transactions">
                        <h3>{{$walletDetails->name}} transactions</h3>

                        <div class="transactions__list">

                            @foreach($transactions as $transaction)
                                <div class="transaction">

                                    @switch($transaction->status)
                                    @case(0)
                                    @if($transaction->state == 'sent')
                                        <div class="transaction__header transaction__header--three-cols">
                                            <div class="transaction__data">
                                                <p>{{$transaction->date}}</p>
                                            </div>

                                            <div class="transaction__info">
                                                <img src="../img/SVG/transaction-icon-sent.svg" alt="">
                                                <p>
                                                    Sent to {{strlen($transaction->receiver)>=20 ? substr(($transaction->receiver),0,20).".." : $transaction->receiver}}
                                                </p>
                                            </div>
                                            <div class="transaction__course">
                                                <span class="rate rate--pending">- {{$transaction->currency}} SC</span>
                                                <span class="rate rate--normal">- {{$transaction->currency * 36 }} €</span>
                                            </div>
                                        </div>

                                        <div class="transaction__body">
                                            <ul class="transaction__details">
                                                <li>
                                                    <span>Miner adress:</span> {{$transaction->miner}}
                                                </li>
                                                <li>
                                                    <span>Sender adress:</span> {{$transaction->sender}}
                                                </li>
                                                <li>
                                                    <span>Condition:</span> Sent
                                                </li>
                                            </ul>
                                        </div>
                                        @break
                                    @elseif($transaction->state == 'received')
                                        <div class="transaction__header transaction__header--three-cols">
                                            <div class="transaction__data">
                                                <p>{{$transaction->date}}</p>
                                            </div>

                                            <div class="transaction__info">
                                                <img src="../img/SVG/transaction-icon-recived.svg" alt="">
                                                <p>
                                                    Sent by {{strlen($transaction->sender)>=20 ? substr(($transaction->sender),0,20).".." : $transaction->sender}}
                                                </p>
                                            </div>
                                            <div class="transaction__course">
                                                <span class="rate rate--plus">+ {{$transaction->currency}} SC</span>
                                                <span class="rate rate--normal">+ {{$transaction->currency * 36 }} €</span>
                                            </div>
                                        </div>

                                        <div class="transaction__body">
                                            <ul class="transaction__details">
                                                <li>
                                                    <span>Miner adress:</span> {{$transaction->miner}}
                                                </li>
                                                <li>
                                                    <span>Sender adress:</span> {{$transaction->sender}}
                                                </li>
                                                <li>
                                                    <span>Earner adress:</span> {{$transaction->receiver}}
                                                </li>
                                                <li>
                                                    <span>Condition:</span> Received
                                                </li>
                                            </ul>
                                        </div>
                                        @break
                                    @elseif($transaction->state == 'mined')
                                        <div class="transaction__header transaction__header--three-cols">
                                            <div class="transaction__data">
                                                <p>{{$transaction->date}}</p>
                                            </div>

                                            <div class="transaction__info">
                                                <img src="../img/SVG/transaction-icon-pending.svg" alt="">
                                                <p>
                                                    Sent by {{strlen($transaction->sender)>=20 ? substr(($transaction->sender),0,20).".." : $transaction->sender}}
                                                </p>
                                            </div>
                                            <div class="transaction__course">
                                                <span class="rate rate--plus">+ {{$transaction->taxe}} SC</span>
                                                <span class="rate rate--normal">+ {{$transaction->taxe * 36 }} €</span>
                                            </div>
                                        </div>

                                        <div class="transaction__body">
                                            <ul class="transaction__details">
                                                <li>
                                                    <span>Miner adress:</span> {{$transaction->miner}}
                                                </li>
                                                <li>
                                                    <span>Sender adress:</span> {{$transaction->sender}}
                                                </li>
                                                <li>
                                                    <span>Earner adress:</span> {{$transaction->miner}}
                                                </li>
                                                <li>
                                                    <span>Condition:</span> Mined
                                                </li>
                                            </ul>
                                        </div>
                                        @break
                                    @endif
                                    @default
                                    <div class="transaction__header transaction__header--three-cols">
                                        <div class="transaction__data">
                                            <p>{{$transaction->date}}</p>
                                        </div>

                                        <div class="transaction__info">
                                            <img src="../img/SVG/transaction-icon-disable.svg" alt="">
                                            <p>
                                                Sent to {{strlen($transaction->receiver)>=20 ? substr(($transaction->receiver),0,20).".." : $transaction->receiver}}
                                            </p>
                                        </div>
                                        <div class="transaction__course">
                                            <span class="rate rate--minus">- {{$transaction->currency}} SC</span>
                                            <span class="rate rate--normal">- {{$transaction->currency * 36 }} €</span>
                                        </div>
                                    </div>

                                    <div class="transaction__body">
                                        <ul class="transaction__details">
                                            <li>
                                                <span>Miner adress:</span> {{$transaction->miner}}
                                            </li>
                                            <li>
                                                <span>Sender adress:</span> {{$transaction->sender}}
                                            </li>
                                            <li>
                                                <span>Condition:</span> Decline
                                            </li>
                                        </ul>
                                    </div>
                                    @endswitch
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn--blue" onclick="location.href='{{url('/transactions') }}'">All transactions</button>
                    </section>
                </div>
            </div>
        </main>
    </div>
    <div id="popup-edit-wallet"  class="mfp-container mfp-inline-holder d-none"><div class="mfp-content">
            <form class="form-prevent-multiple-submits popup popup-add-wallet zoom-anim-dialog" enctype="multipart/form-data" action="{{ action('WalletController@editWalletName', [$walletDetails->num_wallet]) }}" method="POST" id="add-wallet">
                <div class="popup__content">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <h3>Change wallet name</h3>
                    <div class="popup-add-wallet__row">
                        <div class="input-wrap">
                            <input type="text" required="required" maxlength="10" name="wallet-new-name" value="{{$walletDetails->name}}">
                        </div>
                    </div>

                    <button class="button-prevent-multiple-submits btn btn--blue btn--full" type="submit"  name="edit_wallet" value="Submit">
                        <i class="spinner fa fa-spinner fa-spin d-none"></i> Submit</button>
                </div>
                <button title="Close (Esc)" id="close-popup-edit-wallet" type="button" class="mfp-close">×</button>
            </form>
        </div>
    </div>

    <div id="popup-send-supcash" class="mfp-container mfp-inline-holder d-none"><div class="mfp-content">
            <form class="popup popup-sent-currency zoom-anim-dialog form" autocomplete="off" enctype="multipart/form-data" action="{{ action('WalletController@sendSupCash') }}" method="POST"  id="sent-currency">
                <div class="popup__content">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="walletNumber" value="{{$walletDetails->num_wallet}}">
                    <img class="popup-add-wallet__img" src="../img/popup-add-wallet-icon.png" alt="">
                    <h3 class="form__title">Send SC</h3>

                    <div class="form__row">
                        <div class="input-wrap">
                            <input type="text" required="required" name="wallet_address_receiver" placeholder="Enter a SC adress wallet">
                        </div>
                    </div>

                    <label class="form__label">Withdraw From</label>
                    <div class="form__row">
                        <select class="custom-select" style="display: none;">
                            <option value="SupCash">{{$walletDetails->name}}</option>
                        </select>
                    </div>
                    <div class="exchange__col">
                        <label class="form__label">Give Currency:</label>
                        <div class="group-input">
                            <input id="givecurrency" name="CurrencyPrice" required="required" min="0" type="number" placeholder="0.0" step='0.01'>
                            <select id="listMoney" name="listMotto" class="custom-select">
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                    </div>
                    <label class="form__label">Amount to send :</label>
                    <div class="exchange__col">
                        <div class="group-input">
                            <input id="getcurrency" required="required" min=0 max="{{$walletDetails->solde}}" name="scCurrencyToSend" type="number" step='0.01' placeholder="0.0">
                            <select id="scselect" class="custom-select">
                                <option value="SupCash">SupCash</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <button class="button-prevent-multiple-submits btn btn--blue btn--full" type="submit"  name="send_supCash" value="Submit">
                        <i class="spinner fa fa-spinner fa-spin d-none"></i>Continue</button>
                </div>
                <button title="Close (Esc)" type="button" id="close-popup-send-sc" class="mfp-close">×</button></form>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"> </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>

        <script >
            (function(){
                new Clipboard('#copy-button');
            })();

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
@endsection