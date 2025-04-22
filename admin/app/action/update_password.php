<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';

is_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $u_Id = $_SESSION["u_id"];


    $op = new Operations();

    $hashPassword = $op->get_password($u_Id); // Assuming this method retrieves the hashed password from the database
    if (password_verify($oldPassword, $hashPassword)) {
        // Update the password
        $op->update_password($u_Id, password_hash($newPassword, PASSWORD_DEFAULT));
        echo json_encode(array("valid" => 1, "message" => "Password reset successfully"));

        $messsage = "Password reset successfully.id #";
        $type = "Password reset";
        $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

    } else {
        echo json_encode(array("valid" => 0, "message" => "Incorrect current password"));
        exit;
    }

} else {
    echo json_encode(array("valid" => 0, "message" => "Invalid request"));
    exit;
}
?>