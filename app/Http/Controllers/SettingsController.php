<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use Storage;
use GuzzleHttp\Client;
use App\Wallet;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showSettings()
    {
        $wallets = Wallet::where('id_user',Auth::id())->get();
        $client = new Client();
        foreach ($wallets as &$wallet) {

            $responseSold = $client->post('xcvbn.co:11180/getSolde.php', [
                'form_params' => [
                    'idWallet' => $wallet->num_wallet
                ]
            ]);
            $wallet['solde'] = json_decode($responseSold->getBody()->getContents());
        }
        return view('settings',array('user'=>Auth::user()),array('wallets'=>$wallets));
    }
    public function profile()
    {
        return view('settings',array('user'=>Auth::user()));
    }
    public function update(Request $request)
    {
        if($request->has('update_avatar'))
        {
            if($request->hasFile('avatar'))
            {
                $avatar = $request->file('avatar');
                $filename= time().'.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(150,150)->save(public_path('/'.$filename ));
                $user=Auth::user();
                $user->avatar=$filename;
                $user->save();
            }
        }
        elseif ($request->has('update_info'))
        {
            $user=Auth::user();
            $user->name=$request->input('name');
            $user->user_address=$request->input('user_address');
            $user->save();
        }
        $wallets = Wallet::where('id_user',Auth::id())->get();
        $client = new Client();
        foreach ($wallets as &$wallet) {

            $responseSold = $client->post('xcvbn.co:11180/getSolde.php', [
                'form_params' => [
                    'idWallet' => $wallet->num_wallet
                ]
            ]);
            $wallet['solde'] = json_decode($responseSold->getBody()->getContents());
        }

        return view('settings',array('user'=>Auth::user()),array('wallets'=>$wallets));
    }
    public function deleteWallet(Request $request)
    {
        if($request->has('delete_wallet'))
        {
            $client = new Client();
            $responseSold = $client->post('xcvbn.co:11180/getSolde.php', [
                'form_params' => [
                    'idWallet' => $request->input('walletNumber')
                ]
            ]);
            $solde = json_decode($responseSold->getBody()->getContents());
            if($solde>0)
            {
                alert()->error('You can not delete a wallet containing money !')->showConfirmButton('Ok', '#3085d6');
                return \Redirect::back()->withStatus('Form submitted!');
            }
            else
            {
                $wallet = Wallet::where('num_wallet',$request->input('walletNumber'))->first();
                $wallet->delete();
                alert()->success('Wallet deleted successfully !')->showConfirmButton('Ok', '#3085d6');
                return \Redirect::back()->withStatus('Form submitted!');
            }
        }
        return view('settings');
    }
}
