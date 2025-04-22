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
        echo "<script>window.location = 'https://daylogs.in';</script>";
    }
}

function upload_image($location)
{
    if (isset($_FILES["file"])) {
        $extension = explode('.', $_FILES['file']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = $location . $new_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);
        return $new_name;
    }
}
