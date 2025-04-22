<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php is_logged_in(); ?>
<?php $op = new Operations(); ?>
<?php
$request = $_POST['request'];

if ($request == 'Session') {

    $u_id = $_POST['u_id'];
    $u_session = $_POST['u_session'];


    $row = $op->logout($u_id, $u_session);
    if ($row != null) {
        echo json_encode(array("valid" => 1, "message" => "Session deleted successfully."));

        $messsage = "Session deleted successfully.id #" . $row;
        $type = "Session deleted";
        $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

    } else {
        echo json_encode(array("valid" => 0, "message" => "Something went wrong."));
    }
}

?>