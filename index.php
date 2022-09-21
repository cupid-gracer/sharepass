<?php

include('controller/DB.php');
include('controller/Config.php');


// This is our router.
function router()
{
    $body = 'Sorry! Page not found';
    $isValid = true;
    $r = explode('/', $_SERVER['REQUEST_URI']);
    if ($r[2] == '' ) {
        $body = file_get_contents('./view/create.php');
    }
    if ($r[2] != '') {
        $msg = "";
        $hash = $r[2];

        $db = new DB();

        $sql = "SELECT * FROM messages WHERE url = '$hash' LIMIT 1 ";
        $result = $db->sqlRun($sql);
        $row = $result->fetch_assoc();
        if (is_null($row)) {
            $msg = 'Sorry this link is not valid';
            $isValid = false;
        }
        else if (!is_null($row['viewed_date'])) {
            $msg = 'Sorry this message has already been viewed and deleted';
            $isValid = false;
        }
        else if ($row['expiry_time'] <= time()) {
            $msg = 'Sorry this message has expired';
            $isValid = false;
            $sql = "UPDATE messages SET msg = '' WHERE url = '$hash'";
            $result = $db->sqlRun($sql);
        }
        if($isValid) $body = file_get_contents('./view/decrypt.php');
    }

    return require_once("./view/view.php");
}

// Execute the router with our list of routes.
router();
