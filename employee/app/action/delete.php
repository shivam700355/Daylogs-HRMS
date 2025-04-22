<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php is_logged_in(); ?>
<?php $op = new Operations(); ?>
<?php
$request = $_POST['request'];

if ($request == 'Session') {
    $s_id   = $_POST['s_id'];

    $row   = $op->delete_session($s_id);
    if ($row != null) {
        echo json_encode(array("valid" => 1, "message" => "Session  has been deleted successfully"));
       
    } else {
        echo json_encode(array("valid" => 0, "message" => "Something went wrong."));
    }
}



?>