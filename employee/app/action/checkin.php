<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php

if (isset($_POST['c_id'])) {


    $c_id     = $_POST['c_id'];
    $u_id     = $_POST['u_id'];

    date_default_timezone_set('Asia/Calcutta');
    $c_date = date("Y-m-d");
    $c_time = date("H:i:s");


    $op = new Operations();

    $check = $op->check_checkin($c_id, $u_id, $c_date);

    if ($check == 0) {

        $row = $op->checkin($c_id, $u_id, $c_date, $c_time);

        if ($row > 0) {

            
            $ip = $_SERVER['REMOTE_ADDR'];

            $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));

            $log_type = "Check in";
            $log_address = $geo['geoplugin_city'] . ', ' . $geo['geoplugin_region'] ?? "Browser";
            $log_lat_long = $geo['geoplugin_latitude'] . ', ' . $geo['geoplugin_longitude'] ?? "0.0.0";
            
            $log = $op->attendance_log($row, $log_type, $log_address, $log_lat_long);


            echo json_encode(array("valid" => 1, "message" => "Checkin successfully."));
        } else {
            echo json_encode(array("valid" => 0, "message" => "Something went wrong."));
        }
    } else if ($check > 0) {
        echo json_encode(array("valid" => 2, "message" => "Already Checked In"));
    }
} else {
    echo json_encode(array("valid" => 0, "message" => "Variable missing"));
}
?>