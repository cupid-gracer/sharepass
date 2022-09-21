<?php

function isData($val){
  if(is_null($val) || trim($val) == "") return false;
  return true;
}


function encrypt($plaintext, $password, $iv) {
  $method = "AES-256-CBC";
  $key = hash('sha256', $password, true);
  $ciphertext = openssl_encrypt($plaintext, $method, $key, 0, $iv);
  $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
  $hash = bin2hex($hash);
 return $hash . $ciphertext;
}

function decrypt($ivHashCiphertext, $password, $iv) {
  $method = "AES-256-CBC";
  $hash = substr($ivHashCiphertext, 0, 64);
  $ciphertext = substr($ivHashCiphertext, 64);
  $key = hash('sha256', $password, true);
  if (!hash_equals(bin2hex(hash_hmac('sha256', $ciphertext . $iv, $key, true)), $hash)) return null;

  return openssl_decrypt($ciphertext, $method, $key, 0, $iv);
}


?>