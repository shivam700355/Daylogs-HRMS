<?php require_once("app_include/session.php");
     //destroy all sessions canceling the login session
     session_destroy();
     //Redirect with success message
     header('Location: ../index');
?>