<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/wallet';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallbackFacebook()
    {
        try{
            $user = Socialite::driver('facebook')->user();
        }catch (Exception $e){
            return redirect('auth/facebook');
        }
        $authUser=$this->findOrCreateUserFacebook($user);
        Auth::login($authUser,true);
        return redirect()->route('wallet');
    }
    private function findOrCreateUserFacebook($facebookUser)
    {
        $authUser=User::Where('provider_id',$facebookUser->id)->first();
        if($authUser){
            return $authUser;
        }

        $user =  User::Create([
            'name'=>$facebookUser->name,
            'provider'=>'Facebook',
            'email'=>$facebookUser->email,
            'provider_id'=>$facebookUser->id,
            'avatar'=>$facebookUser->avatar,
        ]);
        $user->sendEmailVerificationNotification();
        return $user;
    }


    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallbackGoogle()
    {
        try{
            $user = Socialite::driver('google')->stateless()->user();
        }catch (Exception $e){
            return redirect('auth/google');
        }
        $authUser=$this->findOrCreateUserGoogle($user);
        Auth::login($authUser,true);
        return redirect()->route('wallet');
    }
    private function findOrCreateUserGoogle($googleUser)
    {
        $authUser=User::Where('provider_id',$googleUser->id)->first();
        if($authUser){
            return $authUser;
        }
        $user =  User::Create([
            'name'=>$googleUser->name,
            'provider'=>'Google',
            'email'=>$googleUser->email,
            'provider_id'=>$googleUser->id,
            'avatar'=>$googleUser->avatar,
        ]);
        $user->sendEmailVerificationNotification();
        return $user;
    }

    public function redirectToProviderGitHub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function handleProviderCallbackGitHub()
    {
        try{
            $user = Socialite::driver('github')->stateless()->user();
        }catch (Exception $e){
            return redirect('auth/github');
        }
        $authUser=$this->findOrCreateUserGitHub($user);
        Auth::login($authUser,true);
        return redirect()->route('wallet');
    }
    private function findOrCreateUserGitHub($gitUser)
    {
        $authUser=User::Where('provider_id',$gitUser->id)->first();
        if($authUser){
            return $authUser;
        }

        $user= User::Create([
            'name'=>$gitUser->nickname,
            'provider'=>'GitHub',
            'email'=>$gitUser->email,
            'provider_id'=>$gitUser->id,
            'avatar'=>$gitUser->avatar,
        ]);
        $user->sendEmailVerificationNotification();
        return $user;
    }
}
