<?php
// Include necessary files
require_once "../app_include/session.php";
require_once "../app_include/function.php";
require_once "class/operations-class.php";
$token = $_SESSION["token"];

try {
    $postData = json_decode(file_get_contents("php://input"), true);

    if (isset($postData['status'])) {
        $u_id = $_SESSION['u_id'];
        $s_msg = $postData['status'];
        $cid=$_SESSION['cid'];

        $currentDateTime = date('Y-m-d H:i:s');
        $date = date('Y-m-d', strtotime($currentDateTime));
        $time = date('H:i:s', strtotime($currentDateTime));

        $op = new Operations();
        $row = $op->updateStatus($cid,$u_id, $s_msg, $date, $time,);

        if ($row > 0) {
            echo json_encode(array("valid" => 1, "message" => "Status updated successfully"));
        } else {
            echo json_encode(array("valid" => 0, "message" => "Failed to update status"));
        }
    } else {
        throw new Exception("Status parameter missing");
    }
} catch (Exception $e) {
    echo json_encode(array("success" => false, "message" => $e->getMessage()));
}

?>