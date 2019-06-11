<?php
/**
 * Created by PhpStorm.
 * User: Julien Jagosz
 * Date: 22/11/2018
 * Time: 20:01
 */

include "Classes/Crypt.php";

function traduireSign($walletAccount, $destWalletAccount, $amount, $taxe)
{

    $private = App\Wallet::where('num_wallet',$walletAccount)->first()->private_key;
    // Je récucupère le numero de la transaction.
    $transactionId = json_decode(shell_exec("curl http://xcvbn.co:11180/getNumeroTransaction.php -d 'idCompte=".$walletAccount."'"));
    $transactionId = $transactionId->nextIdTransaction;
    $aTraduire = ["transactionId" => $transactionId, "emmeteur" => $walletAccount, "recepteur" => $destWalletAccount, "montant" => $amount, "taxe" => $taxe];
    $aTraduire = json_encode($aTraduire);
    return json_encode( ["signature" => ( RSA::encrypt ( $aTraduire, $private ) ) ] );
}
function generateCoupleKeys()
{
    $config = array(
        "digest_alg" => "sha512",
        "private_key_bits" => 4096,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );
    $couple = openssl_pkey_new($config);
    openssl_pkey_export($couple, $private);
    $pubKey = openssl_pkey_get_details($couple);
    $public = $pubKey["key"];

    return ["public" => $public, "private" => $private];
}





