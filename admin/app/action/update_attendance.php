<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
$token = $_SESSION["token"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['u_id']) && isset($_POST['checkin_date']) && isset($_POST['checkin_time'])) {
        $u_id = $_POST['u_id'];
        $checkin_date = $_POST['checkin_date'];
        $checkin_time = $_POST['checkin_time'];
        $cid = $_SESSION['cid'];
        $loged_by = $_SESSION['u_id'];

        $op = new Operations();
        $check_attendance = $op->check_attendance($u_id, $checkin_date);
        if ($check_attendance) {
            echo json_encode(array("valid" => 0, "message" => "Attendance already marked for " . $checkin_date));

            $messsage = "Attendance already marked for.id #" . $result;
            $type = "Attendance already";
            $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);



        } else {
            $result = $op->update_attendance($u_id, $checkin_date, $checkin_time, $cid, $loged_by);
            if ($result) {

                $ip = $_SERVER['REMOTE_ADDR'];

                $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));

                $log_type = "Check in";
                $log_address = $geo['geoplugin_city'] . ', ' . $geo['geoplugin_region'] ?? "Browser";
                $log_lat_long = $geo['geoplugin_latitude'] . ', ' . $geo['geoplugin_longitude'] ?? "0.0.0";

                $log = $op->attendance_log($result, $log_type, $log_address, $log_lat_long);

                echo json_encode(array("valid" => 1, "message" => "Attendance marked successfully"));

                $messsage = "Attendance marked successfully.id #" . $result;
                $type = "Attendance marked";
                $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);


            } else {
                echo json_encode(array("valid" => 0, "message" => "Failed to mark attendance"));
            }
        }
    } else {
        // Return missing field error
        echo json_encode(array("valid" => 0, "message" => "All fields are required."));
    }
} else {
    // Return method not allowed error
    echo json_encode(array("valid" => 0, "message" => "Method not allowed."));
}
