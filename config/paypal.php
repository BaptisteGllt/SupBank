<?php

/**
 * *
 *  Configuration et paramétrage de paypal
 */

return [
    //sandbox
    'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
    'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET'),
    //live
    'live_client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
    'live_secret' => env('PAYPAL_LIVE_SECRET'),
    //Configuration paypal sdk
    'settings' => [
        //Mode (live ou sandbox)
        'mode'=> env('PAYPAL_MODE','sandbox'),
        //logs
        'log.longEnabled' => true,
        'log.filename' => storage_path() .'/logs/paypal.log',
        //Levels : DEBUG, INFO, WARN, ERROR
        'log.logLevel' => 'DEBUG'
    ]
];