<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App;
use Auth;
use App\Wallet;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showTransactions(Request $request)
    {
        if(Session::get('dropdown_transactions') == null){
            Session::put('dropdown_transactions', 'All transactions');
        }
        if($request->post('dropdown_transactions'))
        {
            $filterBy = $request->input('dropdown_transactions');
            Session::put('dropdown_transactions', $filterBy);
        }
        $wallets = Wallet::where('id_user',Auth::id())->get();
        $walletsNumbers= $wallets->pluck('num_wallet');
        $client = new Client();
        $jsons = [];
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
                $transaction['status'] = $json->etat;
                $transaction['currency'] = $json->data->montantTransaction;
                $transaction['miner'] = $json->data->mineur;
                $transaction['date'] = date("F j, Y, g:i a", $json->time);
                $transaction['time'] = $json->time;
                $transactions[] = $transaction;
                if($transaction['status'] !=0){
                    $transaction['state'] = 'Decline';
                }elseif ($walletsNumbers->contains($transaction['sender']) && $transaction['sender'] == $wallet->num_wallet){
                    $transaction['state'] = 'Sent';
                    $transaction['currency'] = (double)$json->data->montantTransaction + (double)$json->data->taxe;
                }elseif ( ( ($wallet->num_wallet!=$transaction['sender'] || $wallet->num_wallet!=$transaction['receiver']) ) && ($wallet->num_wallet == $json->data->mineur ) ){
                    if(!$walletsNumbers->contains($transaction['sender'])){
                        $transaction['state'] ='Received';
                        $transaction_taxe = new App\Transaction(); //Créer une transaction taxe si elle émane d'un autre utilisateur et que l'un des portefeuilles actuels a miné le block (pour afficher et la transaction de récéption et la transaction de taxe)
                        $transaction_taxe['state'] = 'Mined';
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
                        $transaction['state'] = 'Mined';
                        $transaction['currency'] = 0;
                        $transaction['taxe'] = $json->data->taxe;

                    }
                }else{
                    $transaction['state'] = 'Received';
                }
            }
        }

        if(count($wallets)>0 and isset($transactions)) {
            $transactions = (collect($transactions))->sortByDesc('time');
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            // Define how many items we want to be visible in each page
            $perPage = 7;

            // Slice the collection to get the items to display in current page
            $currentPageItems = $transactions->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedItems= new LengthAwarePaginator($currentPageItems , count($transactions), $perPage);

            if(Session::get('dropdown_transactions') != 'All transactions'){
                if(Session::get('dropdown_transactions')!= 'Sent' && Session::get('dropdown_transactions') != 'Received')
                {
                    $filterBy='Decline';
                }
                $filterBy = Session::get('dropdown_transactions');
                $filter = $transactions->filter(function($value) use ($filterBy) {
                    if ($value['state'] == $filterBy) {
                        return true;
                    }
                });
                $filter->all();
                $currentPageItems = $filter->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($filter), $perPage);

            }
            // set url path for generted links
            $paginatedItems->setPath($request->url());
        }else{
            $paginatedItems = [];
        }


        return view('transactions',array('transactions'=>$paginatedItems));
    }
}
