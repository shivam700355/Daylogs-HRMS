<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
$token = $_SESSION["token"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['p_id']) && isset($_POST['u_id'])) {
        $u_id = $_POST['u_id'];
        $p_id = $_POST['p_id'];
        $op = new Operations();
        foreach ($u_id as $id) {
            $result = $op->assign_project($id, $p_id);
            if (!$result) {
                echo json_encode(array("valid" => 0, "message" => "Failed to assign project to user ID: $id"));

            }
        }
        echo json_encode(array("valid" => 1, "message" => "Project assigned successfully."));

        $messsage = "Project assigned successfully.id #" . $result;
        $type = "Project assigned";
        $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

    } else {
        echo json_encode(array("valid" => 0, "message" => "Project name and user ID are required."));
    }
} else {
    echo json_encode(array("valid" => 0, "message" => "Method not allowed."));
}
?>