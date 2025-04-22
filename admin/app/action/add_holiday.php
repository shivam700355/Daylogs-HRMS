<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
$token = $_SESSION["token"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['h_name']) && isset($_POST['h_date']) && isset($_POST['h_leaves']) && isset($_POST['h_type']) && isset($_POST['h_desc'])) {
        $h_name = $_POST['h_name'];
        $h_date = $_POST['h_date'];
        $h_leaves = $_POST['h_leaves'];
        $h_type = $_POST['h_type'];
        $h_desc = $_POST['h_desc'];
        $c_id = $_SESSION["cid"];
        $added_by = $_SESSION["u_id"];

        $msg = "Add holiday successfully" . $h_name;
        $type = "Add holidayt" . $c_id;

        $op = new Operations();

        $result = $op->add_holiday($h_name, $h_date, $h_leaves, $c_id, $h_type, $h_desc, $added_by);
        if ($result) {
            $messsage = "Holiday added successfully.id #" . $result;
            $type = "Holiday added";


            $row = $op->create_activity($type, $messsage, $added_by);

            echo json_encode(array("valid" => 1, "message" => "Holiday added successfully."));

        } else {
            echo json_encode(array("valid" => 0, "message" => "Failed to add holiday."));
        }
    } else {
        // Return missing field error
        echo json_encode(array("valid" => 0, "message" => "All fields are required."));
    }
} else {
    // Return method not allowed error
    echo json_encode(array("valid" => 0, "message" => "Method not allowed."));
}
?>