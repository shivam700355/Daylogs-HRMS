<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php

if (isset($_POST['name'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $role = $_POST['role'];
    $cid = $_POST['company'];
    $u_id = $_SESSION['u_id'];
    $u_name = $_SESSION['name'];


    $msg = "Admin has been registered with name " . $name . " and mobile " . $mobile;
    $type = "Admin added.";

    $op = new Operations();

    $check = $op->check_user($mobile, $email);

    if ($check == 0) {

        $row = $op->add_user($name, $mobile, $email, $password, $address, $district, $state, $pincode, $role, $cid, $u_id);

        if ($row > 0) {
            echo json_encode(
                array(
                    "valid" => 1,
                    "message" => "Admin has been added successfully."
                )
            );
            // $row   = $op->create_activity($row, $msg, $type, $u_id);

        } else {
            echo json_encode(
                array(
                    "valid" => 0,
                    "message" => "Something went wrong."
                )
            );
        }
    } elseif ($check > 0) {
        echo json_encode(
            array(
                "valid" => 0,
                "message" => "Email or Mobile number already registered"
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