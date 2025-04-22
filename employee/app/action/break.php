<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php

if (isset($_POST['c_id'])) {


    $c_id     = $_POST['c_id'];
    $u_id     = $_POST['u_id'];
    $break     = $_POST['breaks'];

    date_default_timezone_set('Asia/Calcutta');
    $c_date = date("Y-m-d");
    $c_time = date("H:i:s");


    $op = new Operations();

    $check = $op->check_checkin($c_id, $u_id, $c_date);

    if ($check > 0) {
        if($break=='0'){
            $row = $op->break_in($u_id, $c_date, $c_time);
        }
        if($break=='1'){
            $row = $op->break_out($u_id, $c_date, $c_time);
        }

        if ($row) {
            echo json_encode(array("valid" => 1, "message" => "Updated successfully."));
        } else {
            echo json_encode(array("valid" => 0, "message" => "Something went wrong."));
        }



    }
    else if($check==0) {
        echo json_encode(array("valid" => 2, "message" => "Checkin not found"));
    }
}

else {
    echo json_encode(array("valid" => 0, "message" => "Variable missing"));
}
?>