<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
is_logged_in();

$op = new Operations();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $u_id = $_POST['u_id'];
    $id = $_POST['id'];



    $update_profile = $op->update_request_status($u_id, $status, $id);

    if ($update_profile != null) {
        echo json_encode(array("valid" => 1, "message" => "Request " . $status . " updated successfully."));


        $messsage = "Request updated successfully.id #" . $update_profile;
        $type = "Request  updated";
        $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

    } else {
        echo json_encode(array("valid" => 0, "message" => "Something went wrong."));
    }
    exit(); // Stop further execution
} else {
    echo json_encode(array("valid" => 0, "message" => "invalid request."));
}


?>