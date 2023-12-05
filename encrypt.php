<?php

use Defuse\Crypto\Crypto;

require "vendor/autoload.php";

// Do this once then store it somehow:
//$key = Key::createNewRandomKey();
//file_put_contents('encrypt.key', serialize($key));
$key = unserialize(file_get_contents('encrypt.key'));
//var_dump($key);

$message = file_get_contents('public/data.json');

$ciphertext = Crypto::encrypt($message, $key);
$plaintext = Crypto::decrypt($ciphertext, $key);

var_dump($ciphertext);
var_dump($plaintext);
