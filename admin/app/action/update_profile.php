<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['u_name'], $_POST['u_mobile'], $_POST['u_email'], $_POST['u_address'], $_POST['u_district'], $_POST['u_state'], $_POST['u_pincode'], $_POST['u_id'])) {
        $u_name = $_POST['u_name'];
        $u_mobile = $_POST['u_mobile'];
        $u_email = $_POST['u_email'];
        $u_address = $_POST['u_address'];
        $u_district = $_POST['u_district'];
        $u_state = $_POST['u_state'];
        $u_dob = $_POST['u_dob'];
        $u_doj = $_POST['u_doj'];

        $u_pincode = $_POST['u_pincode'];
        $u_id = $_POST['u_id'];




        $op = new Operations();

        $result = $op->update_profile($u_name, $u_mobile, $u_email, $u_address, $u_district, $u_doj, $u_dob, $u_state, $u_pincode, $u_id);
        if ($result) {
            $_SESSION['temp_uid'] = $u_id;
            echo json_encode(array("valid" => 1, "message" => "Profile Information updated successfully."));

            $messsage = "Profile Information updated successfully #";
            $type = "Profile Information";
            $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);


        } else {
            echo json_encode(array("valid" => 0, "message" => "Failed to update Profile Information."));
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