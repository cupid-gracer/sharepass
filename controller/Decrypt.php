<?php

include('DB.php');
include('Config.php');


$plain_passphrase = $_POST['passphrase'];
$url = $_POST['url'];

$db = new DB();

$sql = "SELECT * FROM messages WHERE url = '$url' LIMIT 1 ";
$result = $db->sqlRun($sql);
if ($result === false) {
    $result = ['status' => 'err', 'msg' => 'Sorry this link is not valid'];
    print(json_encode($result, true));
    die;
}
$row = $result->fetch_assoc();
if (!password_verify($plain_passphrase, $row['passphrase'])) {
    $result = ['status' => 'err', 'msg' => 'Sorry this passphrase is incorrect'];
    print(json_encode($result, true));
    die;
}
if (!is_null($row['viewed_date'])) {
    $result = ['status' => 'err', 'msg' => 'Sorry this message has already been viewed and deleted'];
    print(json_encode($result, true));
    die;
}
if ($row['expiry_time'] <= time()) {
    $result = ['status' => 'err', 'msg' => 'Sorry this message has expired'];
    print(json_encode($result, true));
    die;
}


$password = $secretKey . '$' . $plain_passphrase;

$plain_msg = decrypt($row["msg"], $password, $iv);

$sql = "UPDATE messages SET msg = '', viewed_date = '" . date('Y-m-d H:i:s') . "' WHERE url = '$url'";
$result = $db->sqlRun($sql);

$result = ['status' => 'ok', 'msg' => $plain_msg];
print(json_encode($result, true));
die;
