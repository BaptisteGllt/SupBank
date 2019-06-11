<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/terms', 'TermsOfUse@index');
Route::get('/settings','SettingsController@profile')->middleware('verified');
Route::get('/wallet','WalletController@showWallet')->name('wallet')->middleware('verified');
Route::get('wallet/{walletNumber}','WalletController@showDetailWallet')->name('showDetailWallet')->middleware('verified');
Route::post('/wallet','WalletController@createNewWallet')->middleware('verified');
Route::post('/wallet/{walletNumber}','WalletController@editWalletName')->middleware('verified');
Route::post('','WalletController@sendSupCash')->middleware('verified');
Route::any('/transactions','TransactionsController@showTransactions')->middleware('verified');
Route::get('/buy','BuyController@showPayment')->middleware('verified');
Route::get('/settings','SettingsController@showSettings')->middleware('verified');
Route::get('/network','NetworkController@showNetwork')->middleware('verified');
Route::post('settings','SettingsController@update')->middleware('verified');
Route::post('settings','SettingsController@deleteWallet')->middleware('verified');
Route::get('auth/facebook',['as'=>'auth/facebook','uses'=>'Auth\LoginController@redirectToProviderFacebook']);
Route::get('auth/facebook/callback',['as'=>'auth/facebook/callback','uses'=>'Auth\LoginController@handleProviderCallbackFacebook']);
Route::get('auth/google',['as'=>'auth/google','uses'=>'Auth\LoginController@redirectToProviderGoogle']);
Route::get('auth/google/callback',['as'=>'auth/google/callback','uses'=>'Auth\LoginController@handleProviderCallbackGoogle']);
Route::get('auth/github',['as'=>'auth/github','uses'=>'Auth\LoginController@redirectToProviderGitHub']);
Route::get('auth/github/callback',['as'=>'auth/github/callback','uses'=>'Auth\LoginController@handleProviderCallbackGitHub']);
Route::post('pay','PaymentController@payWithPaypal')->name('pay')->middleware('verified');
Route::get('status','PaymentController@status')->name('status')->middleware('verified');
Route::get('canceled','PaymentController@canceled')->name('canceled')->middleware('verified');