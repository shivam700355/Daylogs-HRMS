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
    $designation = $_POST['designation'];
    $dob = $_POST['dob'];
    $doj = $_POST['doj'];
    $cid = $_POST['c_id'];
    $work_station = $_POST['work_station'];


    $u_id = $_SESSION['u_id'];
    $u_name = $_SESSION['name'];




    $op = new Operations();

    $check = $op->check_user($mobile, $email);

    if ($check == 0) {

        $row = $op->add_new_user($name, $mobile, $email, $password, $address, $district, $state, $pincode, $role, $designation, $dob, $doj, $work_station, $cid, $u_id);

        if ($row > 0) {
            echo json_encode(
                array(
                    "valid" => 1,
                    "message" => "User has been added successfully."
                )
            );

            $messsage = "User has been added successfully.id #" . $row;
            $type = "User added";
            $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

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