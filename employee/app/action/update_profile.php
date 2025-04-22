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
        $u_pincode = $_POST['u_pincode'];
        $u_id = $_POST['u_id'];

        $op = new Operations();

        $message = "Profile has been updated data:\n";
        foreach ($_POST as $key => $value) {
            $message .=str_replace('u_', '', $key) . ": " . $value . "\n"; // No capitalization
        }
        $type = "Profile Update";

        $result = $op->update_profile($u_name, $u_mobile, $u_email, $u_address, $u_district, $u_state, $u_pincode, $u_id);
        if ($result) {

            echo json_encode(array("valid" => 1, "message" => "Profile updated successfully."));
            $row   = $op->create_activity($type, $message, $u_id);
        } else {
            echo json_encode(array("valid" => 0, "message" => "Failed to update Profile."));
        }
    } else {
        // Return missing field error
        echo json_encode(array("valid" => 0, "message" => "All fields are required."));
    }
} else {
    // Return method not allowed error
    echo json_encode(array("valid" => 0, "message" => "Method not allowed."));
}
