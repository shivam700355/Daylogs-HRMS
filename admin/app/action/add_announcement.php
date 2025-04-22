<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
$token = $_SESSION["token"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['a_name']) && isset($_POST['a_date']) && isset($_POST['a_desc'])) {
        $a_name = $_POST['a_name'];
        $a_date = $_POST['a_date'];
        $a_desc = $_POST['a_desc'];
        $c_id = $_SESSION["cid"];
        $added_by = $_SESSION["u_id"];


        $op = new Operations();

        $result = $op->add_announcement($a_name, $a_date, $a_desc, $c_id, $added_by);
        if ($result) {

            $messsage = "New aanouncement has been added with id #" . $result;
            $type = "Create Aanouncement";


            $row = $op->create_activity($type, $messsage, $added_by);

            echo json_encode(array("valid" => 1, "message" => "Announcement added successfully."));


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