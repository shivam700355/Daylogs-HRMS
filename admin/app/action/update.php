<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php is_logged_in(); ?>
<?php
$u_id = $_SESSION['u_id'];
$u_name = $_SESSION['name'];
$op = new Operations();
?>
<?php

$request = $_POST['request'];


if ($request == 'UserStatus') {

    $status = $_POST['active'];
    $user_id = $_POST['user_id'];

    $update_profile = $op->update_user_status($user_id, $status);

    if ($update_profile != null) {
        echo json_encode(array("valid" => 1, "message" => "User status has been updated successfully."));

        $msg = "User status has been updated as " . $status . 'of user id # ' . $user_id;
        $type = "User Status";

        $activity_log = $op->create_activity($type, $msg, $u_id);

    } else {
        echo json_encode(array("valid" => 0, "message" => "Something went wrong."));
    }
}



?>