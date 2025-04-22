<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php

if (isset($_POST['c_name'])) {

    $c_name = $_POST['c_name'];
    $ca_name = $_POST['ca_name'];
    $c_contact = $_POST['c_contact'];
    $c_email = $_POST['c_email'];
    $c_website = $_POST['c_website'];
    $c_pan = $_POST['c_pan'];
    $c_gst = $_POST['c_gst'];
    $c_address = $_POST['c_address'];
    $c_district = $_POST['c_district'];
    $c_state = $_POST['c_state'];
    $c_pincode = $_POST['c_pincode'];

    $u_id = $_SESSION['u_id'];
    $u_name = $_SESSION['name'];

    $msg = "Client has been registered with name " . $c_name . " and mobile " . $c_contact;
    $type = "Client added";


    if (!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {

    }

    $target_dir = "../../app-assets/images/client/";

    $image = strtolower(str_replace(' ', '_', $ca_name) . '.' . strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION)));

    $target_file = $target_dir . $image;

    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $op = new Operations();

    $check = $op->check_client($c_contact, $c_email);

    if ($check == 0) {

        $row = $op->add_client($c_name, $ca_name, $c_contact, $c_email, $c_website, $image, $c_pan, $c_gst, $c_address, $c_district, $c_state, $c_pincode);

        if ($row > 0) {

            $messsage = "Client has been added successfully. id #" . $result;
            $type = "Client added";


            $row = $op->create_activity($type, $messsage, $u_id);


            echo json_encode(
                array(
                    "valid" => 1,
                    "message" => "Client has been added successfully."
                )
            );


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
                "message" => "Mobile number already registered"
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