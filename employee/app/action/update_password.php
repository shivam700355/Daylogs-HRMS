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

    $hashPassword = $op->get_password($u_Id);
    if (password_verify($oldPassword, $hashPassword)) {
        $op->update_password($u_Id, password_hash($newPassword, PASSWORD_DEFAULT));
        echo json_encode(array("valid" => 1, "message" => "Password reset successfully"));


        $messsage = "Password has been changed successfully.";
        $type = "Password Changed" ;
    
    
        $row   = $op->create_activity($type, $messsage, $u_Id);
    } else {
        echo json_encode(array("valid" => 0, "message" => "Incorrect current password"));
        exit;
    }

} else {
    echo json_encode(array("valid" => 0, "message" => "Invalid request"));
    exit;
}
?>