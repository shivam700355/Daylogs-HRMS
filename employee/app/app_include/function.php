<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function is_logged_in()
{
    if (!isset($_SESSION['daylogs_session'])) {
        session_destroy();
        echo "<script>window.location = 'login';</script>";
    }
}

