<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/front-class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $contact = new Front();
    $contact_details = $contact->contact_insert($name, $mobile, $email, $subject, $message);
    if ($contact_details) {
        echo json_encode(
            array(
                "valid" => 1,
                "message" => "Contact added successfully."
            )
        );
    } else {
        echo json_encode(
            array(
                "valid" => 0,
                "message" => "Failed to add contact."
            )
        );
    }
} else {
    echo json_encode(
        array(
            "valid" => 0,
            "message" => "Invalid request method."
        )
    );
}
?>
