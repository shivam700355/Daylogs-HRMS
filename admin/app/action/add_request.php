<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php

if (isset($_POST['u_id'])) {


    $r_type = $_POST['r_type'];
    $r_date = $_POST['r_date'];
    $r_title = $_POST['r_title'];
    $r_desc = $_POST['r_desc'];

    $c_id = $_SESSION['cid'];
    $u_id = $_POST['u_id'];
    $added_by=$_SESSION['u_id'];
   



    $op = new Operations();

    $row = $op->add_request($c_id, $u_id, $r_type, $r_date, $r_title, $r_desc,$added_by);

    if ($row > 0) {
        echo json_encode(
            array(
                "valid" => 1,
                "message" => "Request has been added successfully"
            )
        );

        $messsage = "Request has been created successfully with request id #" . $row;
        $type = "Create Request";

        $row = $op->create_activity($type, $messsage, $added_by);

    } else {
        echo json_encode(
            array(
                "valid" => 0,
                "message" => "Something went wrong."
            )
        );
    }
} else {
    echo json_encode(
        array(
            "valid" => 0,
            "message" => "Variable missing"
        )
    );
}
?>