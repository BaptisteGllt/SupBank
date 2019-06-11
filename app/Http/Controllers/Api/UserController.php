<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Wallet;
use GuzzleHttp\Client;
use Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;


class UserController extends Controller
{


    public $successStatus = 200;


    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'user_address' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        $user->sendEmailVerificationNotification();

        return response()->json(['success'=>$success], $this->successStatus);
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function wallets()
    {
        $wallets = Wallet::where('id_user',Auth::id())->get();
        return response()->json(['success'=>$wallets], $this->successStatus);
    }

    public function createWallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $input = $request->all();

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $walletName = $input['name'];

        if(count(Wallet::where('id_user',Auth::id())->get()) < 3)
        {
            if (Wallet::where('name', '=', $walletName)->where('id_user','=',Auth::id())->exists())
            {
                $response = ['status' => 'error','message' => 'Wallet name already exists !'];
                return response()->json($response);
            }
            if (strlen($input['name']) > 10) {
                $response = ['status' => 'error','message' => 'Wallet name is too long !'];
                return response()->json($response);
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
                    'name' => $input['name'],
                    'id_user' => Auth::id(),
                    'num_wallet' => $walletId,
                    'private_key' => $passw

                ]);
                $wallet->save();
                if(session('status') ==null) {
                    $response = ['status' => 'success','message' => 'Your wallet was added successfuly !'];
                    return response()->json($response);
                }


            }
            else
            {
                return response()->json(['error'=>$validator->errors()], 401);
            }

        }
        else
        {
            $response = ['status' => 'error','message' => 'You have reached the maximum wallets, please go Premium!'];
            return response()->json($response);
        }

    }

    public function generateSCFromPaypal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required',
            'to' => 'required',
            'scCurrency' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $input = $request->all();
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user = User::where('email',$input['email'])->first();
        $walletMaster = Wallet::where('num_wallet',config('app.wallet_parent_id'))->first();
        $userMaster = User::where('id',$walletMaster->id_user)->first();

        if ($user)
        {
            if($user->id == $userMaster->id)  // vérifier que le mail correspond au wallet du from
            {
                if (password_verify ( $input['password'], $user->password ))
                {
                    if(config('app.wallet_parent_id') == $input['from'])
                    {
                        $wallets = Wallet::all();
                        $walletsNumbers= $wallets->pluck('num_wallet');
                        if($input['from'] == $request->input('to')) // Si l'utilisateur essaye d'envoyer des SC à son portefeuille actuel
                        {
                            $response = ['status' => 'error','message' => 'You can not send SupCash to the current wallet!'];
                            return response()->json($response);
                        }
                        else
                        {
                            if($walletsNumbers->contains($input['to']))
                            {
                                $client = new Client();
                                $response = $client->post('xcvbn.co:11180/getSolde.php', [
                                    'form_params' => [
                                        'idWallet' => $input['from']
                                    ]
                                ]);
                                $wallet_currency = json_decode($response->getBody()->getContents());
                                if($input['scCurrency'] < $wallet_currency) //Si la transaction est possible
                                {
                                    // TODO : Gérer les décimales des supcash au moment d'envoyer
                                    include(app_path() . '/traduire.php');
                                    $signature = json_decode(traduireSign($input['from'],$input['to'],$input['scCurrency'],$input['scCurrency']/1000));
                                    $signature = $signature->signature;
                                    $client->post('xcvbn.co:11180/createTransaction.php', [
                                        'form_params' => [
                                            'emmeteur' => $input['from'],
                                            'recepteur'=>$input['to'],
                                            'signature' => $signature,
                                            'taxe' => $input['scCurrency']/1000,
                                            'montant' =>$input['scCurrency']
                                        ]
                                    ]);
                                    $response = ['status' => 'success','message' => 'Transaction completed !'];
                                    return response()->json($response);
                                }
                                else
                                {
                                    $response = ['status' => 'error','message' => 'Not enough money on your wallet !'];
                                    return response()->json($response);
                                }

                            }
                            else
                            {
                                $response = ['status' => 'error','message' => 'Transaction failed !'];
                                return response()->json($response);
                            }
                        }
                    }
                    else
                    {
                        $response = ['status' => 'error','message' => 'Error'];
                        return response()->json($response);
                    }
                }
                else
                {
                    $response = ['status' => 'error','message' => 'Wrong password'];
                    return response()->json($response);
                }
            }
            else
            {
                $response = ['status' => 'error','message' => 'Error'];
                return response()->json($response);
            }
        }
        else
        {
            $response = ['status' => 'error','message' => 'User does not exist'];
            return response()->json($response);
        }


    }

    public function createTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required',
            'to' => 'required',
            'scCurrency' => 'required',
        ]);
        $input = $request->all();
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user = Auth::user();

        $walletUser = Wallet::where('num_wallet',$input['from'])->first();
        $userWallet = User::where('id',$walletUser->id_user)->first();
        if ($user)
        {
            if($user->id == $userWallet->id)  // vérifier que le token correspond au wallet du from
            {
                    if($input['from'] == $input['from'])
                    {
                        $wallets = Wallet::all();
                        $walletsNumbers= $wallets->pluck('num_wallet');
                        if($input['from'] == $request->input('to')) // Si l'utilisateur essaye d'envoyer des SC à son portefeuille actuel
                        {
                            $response = ['status' => 'error','message' => 'You can not send SupCash to the current wallet!'];
                            return response()->json($response);
                        }
                        else
                        {
                            if($walletsNumbers->contains($input['to']))
                            {
                                $client = new Client();
                                $response = $client->post('xcvbn.co:11180/getSolde.php', [
                                    'form_params' => [
                                        'idWallet' => $input['from']
                                    ]
                                ]);
                                $wallet_currency = json_decode($response->getBody()->getContents());
                                if($input['scCurrency'] < $wallet_currency) //Si la transaction est possible
                                {
                                    // TODO : Gérer les décimales des supcash au moment d'envoyer
                                    include(app_path() . '/traduire.php');
                                    $signature = json_decode(traduireSign($input['from'],$input['to'],$input['scCurrency'],$input['scCurrency']/1000));
                                    $signature = $signature->signature;
                                    $client->post('xcvbn.co:11180/createTransaction.php', [
                                        'form_params' => [
                                            'emmeteur' => $input['from'],
                                            'recepteur'=>$input['to'],
                                            'signature' => $signature,
                                            'taxe' => $input['scCurrency']/1000,
                                            'montant' =>$input['scCurrency']
                                        ]
                                    ]);
                                    $response = ['status' => 'success','message' => 'Transaction completed !'];
                                    return response()->json($response);
                                }
                                else
                                {
                                    $response = ['status' => 'error','message' => 'Not enough money on your wallet !'];
                                    return response()->json($response);
                                }

                            }
                            else
                            {
                                $response = ['status' => 'error','message' => 'Transaction failed !'];
                                return response()->json($response);
                            }
                        }
                    }
                    else
                    {
                        $response = ['status' => 'error','message' => 'Error'];
                        return response()->json($response);
                    }

            }
            else{
                $response = ['status' => 'error','message' => 'Bad owner'];
                return response()->json($response);
            }

        }
        else
        {
            $response = ['status' => 'error','message' => 'User does not exist'];
            return response()->json($response);
        }


    }

    public function checkPinCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin_code' => 'required',
        ]);
        $input = $request->all();
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user = Auth::user();
        if($user->pin_code == $input['pin_code'] )
        {
            $response = ['status' => 'success','message' => 'Correct'];
            return response()->json($response);
        }
        else
        {
            $response = ['status' => 'error','message' => 'Incorrect or empty'];
            return response()->json($response);
        }
    }

    public function setPinCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin_code' => 'required',
        ]);
        $input = $request->all();
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user = Auth::user();
        $user->pin_code = $input['pin_code'];
        $user->save();
        $response = ['status' => 'success','message' => 'Pin set successfully'];
        return response()->json($response);

    }

    public function findOrCreateUserGoogle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'access_token' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();

        $client = new Client();
        $response = $client->request('GET', "https://oauth2.googleapis.com/tokeninfo", [
            "query" => [
                "id_token" => $input['access_token']
            ],
        ]);

        $googleUserJson = json_decode($response->getBody()->getContents());
        $authUser = User::Where('provider_id',$googleUserJson->sub)->first();
            if($authUser){
                $success['token'] =  $authUser->createToken('MyApp')->accessToken;
                return response()->json(['success' => $success], $this->successStatus);
            }

            $user= User::Create([
                'name'=>$googleUserJson->name,
                'provider'=>'Google',
                'email'=>$googleUserJson->email,
                'provider_id'=>$googleUserJson->sub,
                'avatar'=>$googleUserJson->picture,
            ]);
            $user->sendEmailVerificationNotification();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
    }

    public function findOrCreateUserFacebook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'access_token' => 'required',
            'facebook_id' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();

        $client = new Client();
        $response = $client->post('https://graph.facebook.com/v3.3/'.$input['facebook_id'].'?fields=id,email,name,picture', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $input['access_token']
                ],
            ]
        );


        $facebookUserJson = json_decode($response->getBody()->getContents());
        $authUser = User::Where('provider_id',$facebookUserJson->id)->first();

        if($authUser){
            $success['token'] =  $authUser->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }

        $user= User::Create([
            'name'=>$facebookUserJson->name,
            'provider'=>'Facebook',
            'email'=>$facebookUserJson->email,
            'provider_id'=>$facebookUserJson->id,
            'avatar'=>$facebookUserJson->picture->data->url,
        ]);
        $user->sendEmailVerificationNotification();
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function editWalletName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'num_wallet' => 'required',
        ]);
        $input = $request->all();
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if (strlen($input['name']) > 10) {
            $response = ['status' => 'error','message' => 'Wallet name is too long !'];
            return response()->json($response);
        }
        $wallets = Wallet::where('id_user',Auth::id())->get();
        $walletsNumbers= $wallets->pluck('num_wallet');
        if($walletsNumbers->contains($input['num_wallet']))
        {
            if (Wallet::where('name', '=', $input['name'])->where('id_user','=',Auth::id())->exists())
            {
                return back()->with(['warning' => 'Wallet name already exists !']);
            }
            $wallet=Wallet::where('num_wallet',$input['num_wallet'])->first();
            $wallet->name=$input['name'];
            $wallet->save();
            $response = ['status' => 'success','message' => 'The name has been changed successfuly !'];
            return response()->json($response);
        }
        else
        {
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }
    public function resendEmail()
    {
        $user = Auth::user();
        $user->sendEmailVerificationNotification();
        return response()->json(['success' => 'Email sent successfully !'], $this->successStatus);
    }

    public function deleteWallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'num_wallet' => 'required',
        ]);
        $input = $request->all();
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user = Auth::user();

        $walletUser = Wallet::where('num_wallet',$input['num_wallet'])->first();
        $userWallet = User::where('id',$walletUser->id_user)->first();
        if ($user) {
            if ($user->id == $userWallet->id)  // vérifier que le token correspond au wallet du from
            {
                $client = new Client();
                $responseSold = $client->post('xcvbn.co:11180/getSolde.php', [
                    'form_params' => [
                        'idWallet' => $input['num_wallet']
                    ]
                ]);
                $solde = json_decode($responseSold->getBody()->getContents());
                if($solde>0)
                {
                    $response = ['status' => 'error','message' => 'You can not delete a wallet containing money  !'];
                    return response()->json($response);
                }
                else
                {
                    $wallet = Wallet::where('num_wallet',$input['num_wallet'])->first();
                    $wallet->delete();
                    $response = ['status' => 'success','message' => 'Wallet deleted successfully !'];
                    return response()->json($response);
                }
            }
            else
            {
                $response = ['status' => 'error','message' => 'Bad owner'];
                return response()->json($response);
            }

        }
        else
        {
            $response = ['status' => 'error','message' => 'User does not exist'];
            return response()->json($response);
        }



    }
}
