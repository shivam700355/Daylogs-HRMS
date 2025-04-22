<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php is_logged_in();
$u_id     = $_SESSION['u_id'];
$u_name   = $_SESSION['name'];
$op = new Operations();
?>
<?php
$request = $_POST['request'];


if ($request == 'UserStatus') {

    $status    = $_POST['active'];
    $user_id   = $_POST['user_id'];

    $row   = $op->update_user_status($user_id, $status);

    if ($row != null) {
        echo json_encode(array("valid" => 1, "message" => "User status has been updated successfully."));

        $msg = "User status has been updated as " . $status;
        $type = "User Status";

        $row   = $op->create_activity($user_id, $msg, $type, $u_id);
    } else {
        echo json_encode(array("valid" => 0, "message" => "Something went wrong."));
    }
}




?>