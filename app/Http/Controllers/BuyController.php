<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use Auth;

class BuyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showPayment()
    {
        $wallets = Wallet::where('id_user',Auth::id())->get();
        return view('buy',array('wallets'=>$wallets));
    }
}
