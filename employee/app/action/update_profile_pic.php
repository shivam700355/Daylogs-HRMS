<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_id = $_SESSION["u_id"];
    $targetDir = "../../app-assets/images/profile/";

    $randomNumber = rand(111, 999);;

    // Get the original file extension
    $originalExtension = strtolower(pathinfo($_FILES["u_pic"]["name"], PATHINFO_EXTENSION));
    
    // Construct the new file name with the user ID and original extension
    $fileName = $u_id .'_'.$randomNumber. '.' . $originalExtension;
    $targetFile = $targetDir . $fileName;


    $messsage = "Profile image changed successfully with image name ". $fileName;
    $type = "Profile pic update";
    // Check file size

    // Check file size (2MB limit)
    if ($_FILES["u_pic"]["size"] > 2000000) {
        echo json_encode(array("valid" => 0, "message" => "Sorry, your file is too large (max 2MB)."));
        exit();
    }

    // Check if the file is an actual image
    if (!getimagesize($_FILES["u_pic"]["tmp_name"])) {
        echo json_encode(array("valid" => 0, "message" => "File is not an image."));
        exit();
    }

    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["u_pic"]["tmp_name"], $targetFile)) {
        $op = new Operations();
        $op->update_profile_pic($u_id, $fileName);
        echo json_encode(array("valid" => 1, "message" => "Profile image has been uploaded successfully"));
        $row   = $op->create_activity($type, $messsage, $u_id);
    } else {
        echo json_encode(array("valid" => 0, "message" => "Sorry, there was an error uploading your file."));
    }
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Method Not Allowed"));
}
?>
