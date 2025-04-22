<?php
require_once("app_include/session.php");
include 'action/class/operations-class.php';

include 'action/class/count-class.php';

$op = new Operations();
$row = $op->logout($_SESSION['u_id'], $_SESSION['daylogs_session']);


if ($row) {
    //destroy all sessions canceling the login session
    session_destroy();
    //Redirect with success message
    header('Location: https://daylogs.in');
}
else{
    
}

?>
