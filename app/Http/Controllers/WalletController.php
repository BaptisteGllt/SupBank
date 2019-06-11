<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Wallet;
use App\User;
use App;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;

class WalletController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showWallet()
    {

        $wallets = Wallet::where('id_user',Auth::id())->get();
        $walletsNumbers= $wallets->pluck('num_wallet');
        $client = new Client();
        foreach ($wallets as &$wallet) {

            $responseSold = $client->post('xcvbn.co:11180/getSolde.php', [
                'form_params' => [
                    'idWallet' => $wallet->num_wallet
                ]
            ]);
            $responseLastSold = $client->post('xcvbn.co:11180/getLastTransactionByWallet.php', [
                'form_params' => [
                    'num_wallet' => $wallet->num_wallet
                ]
            ]);
            $wallet['solde'] = json_decode($responseSold->getBody()->getContents());
            $wallet['lastTransaction'] =json_decode($responseLastSold->getBody()->getContents());
        }
        $transactions = [];
        foreach ($wallets as $wallet)
        {
            $response = $client->post('xcvbn.co:11180/getBlock.php', [
                'form_params' => [
                    'id' => "[".json_encode($wallet->num_wallet) ."]",
                    'action' => 'getAll'
                ]
            ]);
            $jsons = json_decode($response->getBody()->getContents());
            foreach ($jsons as $json)
            {
                $transaction = new App\Transaction();
                $transaction['sender'] = $json->data->emmeteur;
                $transaction['receiver'] = $json->data->recepteur;
                $transaction['currency'] = $json->data->montantTransaction;
                $transaction['miner'] = $json->data->mineur;
                $transaction['status'] = $json->etat;
                $transaction['date'] = date("F j, Y, g:i a", $json->time);
                $transaction['time'] = $json->time;
                if( ($walletsNumbers->contains($transaction['sender'])) && ($transaction['sender'] == $wallet->num_wallet) ){
                    $transaction['state'] = 'sent';
                    $transaction['currency'] = $json->data->montantTransaction + $json->data->taxe;
                }
                elseif ( ( ($wallet->num_wallet!=$transaction['sender'] || $wallet->num_wallet!=$transaction['receiver']) ) && ($wallet->num_wallet == $json->data->mineur ) ){
                    if(!$walletsNumbers->contains($transaction['sender'])){
                        $transaction['state'] ='received';
                        $transaction_taxe = new App\Transaction(); //Créer une transaction taxe si elle émane d'un autre utilisateur et que l'un des portefeuilles actuels a miné le block (pour afficher et la transaction de récéption et la transaction de taxe)
                        $transaction_taxe['state'] = 'mined';
                        $transaction_taxe['sender'] = $json->data->emmeteur;
                        $transaction_taxe['receiver'] = $json->data->recepteur;
                        $transaction_taxe['currency'] = 0;
                        $transaction_taxe['taxe'] = $json->data->taxe;
                        $transaction_taxe['miner'] = $json->data->mineur;
                        $transaction_taxe['status'] = $json->etat;
                        $transaction_taxe['date'] = date("F j, Y, g:i a", $json->time);
                        $transaction_taxe['time'] = $json->time;
                        $transactions[] = $transaction_taxe;
                    }
                    else{
                        $transaction['state'] = 'mined';
                        $transaction['currency'] = 0;
                        $transaction['taxe'] = $json->data->taxe;
                        if($transaction['miner'] == $transaction['receiver'])
                        {
                            $transaction_received = new App\Transaction(); //Créer une transaction taxe si elle émane d'un autre utilisateur et que l'un des portefeuilles actuels a miné le block (pour afficher et la transaction de récéption et la transaction de taxe)
                            $transaction_received['state'] = 'received';
                            $transaction_received['sender'] = $json->data->emmeteur;
                            $transaction_received['receiver'] = $json->data->recepteur;
                            $transaction_received['currency'] = $json->data->montantTransaction;
                            $transaction_received['miner'] = $json->data->mineur;
                            $transaction_received['status'] = $json->etat;
                            $transaction_received['date'] = date("F j, Y, g:i a", $json->time);
                            $transaction_received['time'] = $json->time;
                            $transactions[] = $transaction_received;
                        }
                    }
                }
                else
                {
                    $transaction['state'] = 'received';
                }

                $transactions[] = $transaction;
            }
        }
        $transactions = (collect($transactions))->sortByDesc('time')->take(10);
        //dd($transactions);
        return view('wallet',array('user'=>Auth::user()),array('wallets'=>$wallets,'transactions'=>$transactions));
    }

    public function showDetailWallet($walletNumber)
    {
        $client = new Client();
        $response = $client->post('xcvbn.co:11180/getSolde.php', [
            'form_params' => [
                'idWallet' => $walletNumber->num_wallet
            ]
        ]);
        $todaySold = $client->post('xcvbn.co:11180/getSoldeToday.php', [
            'form_params' => [
                'num_wallet' => $walletNumber->num_wallet
            ]
        ]);
        $response = $response->getBody()->getContents();
        $todaySold = $todaySold->getBody()->getContents();
        $walletDetails = Wallet::where('num_wallet', $walletNumber->num_wallet)->first();
        $walletDetails['solde'] = $response;
        $walletDetails['todaySold'] = $todaySold;
        //Détails des transactions du portefeuille
        $response = $client->post('xcvbn.co:11180/getBlock.php', [
            'form_params' => [
                'id' => "[".json_encode($walletNumber->num_wallet) ."]",
                'action' => 'getAll'
            ]
        ]);
        $jsons = json_decode($response->getBody()->getContents());

        foreach ($jsons as $json)
        {
            $transaction = new App\Transaction();
            $transaction['sender'] = $json->data->emmeteur;
            $transaction['receiver'] = $json->data->recepteur;
            $transaction['currency'] = $json->data->montantTransaction;
            $transaction['miner'] = $json->data->mineur;
            $transaction['status'] = $json->etat;
            $transaction['date'] = date("F j, Y", $json->time);
            $transaction['time'] = $json->time;
            if($walletNumber->num_wallet == $transaction['sender']){
                $transaction['state'] = 'sent';
                $transaction['currency'] = $json->data->montantTransaction + $json->data->taxe;
            }elseif ( ( ($walletNumber->num_wallet!=$transaction['sender'] || $walletNumber->num_wallet!=$transaction['receiver']) ) && ($walletNumber->num_wallet == $json->data->mineur ) ){
                if(!$walletNumber->num_wallet == $transaction['sender']){
                    $transaction['state'] ='received';
                    $transaction_taxe = new App\Transaction(); //Créer une transaction taxe si elle émane d'un autre utilisateur et que l'un des portefeuilles actuels a miné le block (pour afficher et la transaction de récéption et la transaction de taxe)
                    $transaction_taxe['state'] = 'mined';
                    $transaction_taxe['sender'] = $json->data->emmeteur;
                    $transaction_taxe['receiver'] = $json->data->recepteur;
                    $transaction_taxe['currency'] = 0;
                    $transaction_taxe['taxe'] = $json->data->taxe;
                    $transaction_taxe['miner'] = $json->data->mineur;
                    $transaction_taxe['status'] = $json->etat;
                    $transaction_taxe['date'] = date("F j, Y, g:i a", $json->time);
                    $transaction_taxe['time'] = $json->time;
                    $transactions[] = $transaction_taxe;
                }
                else{
                    $transaction['state'] = 'mined';
                    $transaction['currency'] = 0;
                    $transaction['taxe'] = $json->data->taxe;
                    if($transaction['miner'] == $transaction['receiver'])
                    {
                        $transaction_received = new App\Transaction(); //Créer une transaction taxe si elle émane d'un autre utilisateur et que l'un des portefeuilles actuels a miné le block (pour afficher et la transaction de récéption et la transaction de taxe)
                        $transaction_received['state'] = 'received';
                        $transaction_received['sender'] = $json->data->emmeteur;
                        $transaction_received['receiver'] = $json->data->recepteur;
                        $transaction_received['currency'] = $json->data->montantTransaction;
                        $transaction_received['miner'] = $json->data->mineur;
                        $transaction_received['status'] = $json->etat;
                        $transaction_received['date'] = date("F j, Y, g:i a", $json->time);
                        $transaction_received['time'] = $json->time;
                        $transactions[] = $transaction_received;
                    }
                }
            }
            else
            {
                $transaction['state'] = 'received';
            }

            $transactions[] = $transaction;
        }
        if(count($jsons)>0){
            $transactions = (collect($transactions))->sortByDesc('time')->take(7);
        }
        else{
            $transactions = [];
        }
        return view('walletdetails',array('walletDetails'=>$walletDetails),array('transactions'=>$transactions));
    }

    public function createNewWallet(Request $request)
    {

        if(count(App\Wallet::where('id_user',Auth::id())->get()) < 3)
        {
            if($request->post('create_wallet'))
            {
                $walletName = $request->input('wallet-new-name');
                if (strlen($walletName) > 10) {
                    return back()->with(['warning' => 'Wallet name is too long !']);
                }
                if (Wallet::where('name', '=', $request->input('wallet-new-name'))->where('id_user','=',Auth::id())->exists())
                {
                    return back()->with(['warning' => 'Wallet name already exists !']);
                }
                include(app_path() . '/traduire.php');
                $keys = generateCoupleKeys();
                $public = $keys["public"];
                $private = $keys["private"];
                $config = array
                (
                    "digest_alg" => "sha512",
                    "private_key_bits" => 4096,
                    "private_key_type" => OPENSSL_KEYTYPE_RSA,
                );
                openssl_private_encrypt("creation", $encrypted, $private);
                $encrypted_hex = bin2hex($encrypted);
                $client = new Client();
                $request = $client->post('xcvbn.co:11180/createWallet.php', [
                    'form_params' => [
                        'publicKey' => $public,
                        'encryptedMessage' => $encrypted_hex
                    ]
                ]);
                $response = $request->getBody()->getContents();
                $response = json_decode($response);
                $walletId = $response->WalletId;
                $isError =  $response->Error;
                $passw = $private;

                if($isError == 0 )
                {
                    $wallet = Wallet::create([
                        'name' => $walletName,
                        'id_user' => Auth::id(),
                        'num_wallet' => $walletId,
                        'private_key' => $passw

                    ]);
                    $wallet->save();
                    if(session('status') ==null) {
                        alert()->success('Your wallet was added successfuly!')->showConfirmButton('Ok', '#3085d6');
                    }


                }

            }
        }
        else
        {
            if(session('status') ==null) {
                alert()->error('You have reached the maximum wallets, please go Premium!')->showConfirmButton('Ok', '#3085d6');
                return \Redirect::back()->withStatus('Form submitted!');
            }
        }
        return \Redirect::back()->withStatus('Form submitted!');
        //return view('wallet',array('user'=>Auth::user()),array('wallets'=>App\Wallet::where('id_user',Auth::id())->get()));
    }

    public function sendSupCash(Request $request)
    {
        if($request->post('send_supCash'))
        {
            $wallets = Wallet::all();
            $walletsNumbers= $wallets->pluck('num_wallet');
            if($request->input('wallet_address_receiver') == $request->input('walletNumber')) // Si l'utilisateur essaye d'envoyer des SC à son portefeuille actuel
            {
                alert()->error('You can not send SupCash to the current wallet!')->showConfirmButton('Ok', '#3085d6');
                return \Redirect::back()->withStatus('Form submitted!');

            }
            else
            {
                if($walletsNumbers->contains($request->input('wallet_address_receiver')))
                {
                    // Traitement d'envoi de supcash

                    $client = new Client();
                    $response = $client->post('xcvbn.co:11180/getSolde.php', [
                        'form_params' => [
                            'idWallet' => $request->input('walletNumber')
                        ]
                    ]);
                    $wallet_currency = json_decode($response->getBody()->getContents());
                    if($request->input('scCurrencyToSend') < $wallet_currency) //Si la transaction est possible
                    {
                       // TODO : Gérer les décimales des supcash au moment d'envoyer
                        include(app_path() . '/traduire.php');
                        $signature = json_decode(traduireSign($request->input('walletNumber'),$request->input('wallet_address_receiver'),$request->input('scCurrencyToSend'),$request->input('scCurrencyToSend')/1000));
                        $signature = $signature->signature;
                        $client->post('xcvbn.co:11180/createTransaction.php', [
                            'form_params' => [
                                'emmeteur' => $request->input('walletNumber'),
                                'recepteur'=>$request->input('wallet_address_receiver'),
                                'signature' => $signature,
                                'taxe' => $request->input('scCurrencyToSend')/1000,
                                'montant' =>$request->input('scCurrencyToSend')
                            ]
                        ]);
                        alert()->success('Transaction completed !')->showConfirmButton('Ok', '#3085d6');
                        return \Redirect::back()->withStatus('Form submitted!');

                    }
                    else
                  {
                       alert()->error('Not enough money on your wallet')->showConfirmButton('Ok', '#3085d6');
                       return \Redirect::back()->withStatus('Form submitted!');
                  }

                }
                else
                {
                    Alert::html('Transaction failed', '<p>The wallet address does not exist.</p>', 'error')->showConfirmButton('Ok', '#3085d6');;
                    return \Redirect::back()->withStatus('Form submitted!');
                }
            }



        }

    }

    public function editWalletName(Request $request,$walletDetails)
    {
        if($request->post('edit_wallet'))
        {
            if (strlen($request->input('wallet-new-name')) > 10) {
                return back()->with(['warning' => 'Wallet name is too long !']);
            }
            if (Wallet::where('name', '=', $request->input('wallet-new-name'))->where('id_user','=',Auth::id())->exists())
            {
                return back()->with(['warning' => 'Wallet name already exists !']);
            }
            $wallet=Wallet::where('num_wallet',$walletDetails->num_wallet)->first();
            $wallet->name=$request->input('wallet-new-name');
            $wallet->save();
            alert()->success('The name has been changed succesfuly !')->showConfirmButton('Ok', '#3085d6');
            return \Redirect::back()->withStatus('Form submitted!');
        }
    }

}
