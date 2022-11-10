<?php

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'sadgjakgufgchdng';
    $secret_iv = 'rjtaksjwemdldkjafkj';

    $key = hash('sha256', $secret_key);
    
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function getRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}



















/*
// To encrypt a string

$dataToEncrypt_esempio = 'Hello World';
$cypherMethod = 'AES-256-CBC';
$key = random_bytes(32);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cypherMethod));
$encryptedData_esempio = openssl_encrypt($dataToEncrypt_esempio, $cypherMethod, $key, $options=0, $iv);
// To decrypt an encrypted string

$decryptedData_esempio = openssl_decrypt($encryptedData_esempio, $cypherMethod, $key, $options=0, $iv);
*/

?>