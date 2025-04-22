<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php is_logged_in(); ?>
<?php $op = new Operations(); ?>
<?php
$request = $_POST['request'];

if ($request == 'User') {
    $uid      = $_POST['uid'];
    $u_id     = $_SESSION['u_id'];
    $u_name   = $_SESSION['name'];

    $msg = "User has been deleted by " . $u_name;
    $type = "User Deleted";

    $row   = $op->delete_user($uid);
    if ($row != null) {
        echo json_encode(array("valid" => 1, "message" => "User has been deleted successfully."));
        $row   = $op->create_activity($uid, $msg, $type, $u_id);
    } else {
        echo json_encode(array("valid" => 0, "message" => "Something went wrong."));
    }
}

?>