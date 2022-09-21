<?php

include('DB.php');
include('Config.php');


$plain_msg = $_POST['msg'];
$plain_passphrase = $_POST['passphrase'];
$exiry = $_POST['exiry'];
$password = $secretKey.'$'.$plain_passphrase;

if (isData($plain_msg) && isData($plain_passphrase) && isData($plain_passphrase)) {
    if ($exiry > 604800) {
        $result = ['status' => 'err', 'msg' => 'Expiry time cant over than 7 days!'];
        print(json_encode($result, true));
        die;
    }
} else {
    $result = ['status' => 'err', 'msg' => 'Please fill correct data!'];
    print(json_encode($result, true));
    die;
}

$exiry += time();
$encrypt_msg = encrypt($plain_msg, $password, $iv);
// var_dump(decrypt($d, $secretKey, $iv));
$plain_passphrase = password_hash($plain_passphrase, PASSWORD_BCRYPT);
$bytes = random_bytes(20);
$url = bin2hex($bytes);


$db = new DB();
$sql = "INSERT INTO messages ( passphrase, msg, expiry_time, url ) VALUES ('$plain_passphrase', '$encrypt_msg', '$exiry', '$url')";
$result = $db->sqlRun($sql);

if($result){
    // date("j F Y g:i a", $exiry)
    $result = ['status' => 'ok', 'url' => $APP_DOMAIN. $url, 'expiry_time' =>  $exiry];
    print(json_encode($result, true));
    die; 
}
else{
    $result = ['status' => 'err', 'msg' => 'Server error'];
    print(json_encode($result, true));
    die;
}