<?php

class RSA
{
    public static function encrypt($data, $private)
    {

        $config = array(
            "digest_alg" => "sha512",
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        openssl_private_encrypt($data, $encrypted, $private);
        $encrypted_hex = bin2hex($encrypted);
        return $encrypted_hex;

    }

    public static function decrypt($data, $public)
    {
        $config = array(
            "digest_alg" => "sha512",
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        $data = hex2bin($data);
        openssl_public_decrypt($data, $decrypted, $public);
        return $decrypted;
    }
}
