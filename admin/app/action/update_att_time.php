<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';

$token = $_SESSION["token"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['a_id']) && isset($_POST['checkin_time'])) {
        $u_id = $_POST['a_id'];
        $checkin_time = $_POST['checkin_time'];

        $op = new Operations();

        $result = $op->update_attendance_time($u_id, $checkin_time);
        if ($result) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $geo = @unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));

            if ($geo && is_array($geo)) {
                $log_address = $geo['geoplugin_city'] . ', ' . $geo['geoplugin_region'] ?? "Browser";
                $log_lat_long = $geo['geoplugin_latitude'] . ', ' . $geo['geoplugin_longitude'] ?? "0.0.0";
            } else {
                $log_address = "Unknown";
                $log_lat_long = "0.0.0";
            }

            $log_type = "Check in";
            $log = $op->attendance_log($result, $log_type, $log_address, $log_lat_long);

            echo json_encode(array("valid" => 1, "message" => "Attendance Time Updated successfully"));

            $message = "Attendance Time Updated successfully. ID #" . $u_id;
            $type = "Attendance Time";
            $row = $op->create_activity($type, $message, $_SESSION['u_id']);
        } else {
            echo json_encode(array("valid" => 0, "message" => "Failed to mark attendance time"));
        }
    } else {
        // Return missing field error
        echo json_encode(array("valid" => 0, "message" => "All fields are required."));
    }
} else {
    // Return method not allowed error
    echo json_encode(array("valid" => 0, "message" => "Method not allowed."));
}
