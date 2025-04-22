<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_id = $_SESSION["u_id"];
    $targetDir = "../../app-assets/images/profile/";
    $fileName = $u_id . '_' . basename($_FILES["u_pic"]["name"]);
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["u_pic"]["size"] > 2000000) { // 2MB limit
        $uploadOk = 0;
        echo json_encode(array("valid" => 0, "message" => "Sorry, your file is too large max 2MB."));
        exit(); // Stop further execution
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
        echo json_encode(array("valid" => 0, "message" => "Sorry, only JPG, JPEG, PNG files are allowed."));
        exit(); // Stop further execution
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(array("valid" => 0, "message" => "Sorry, your file was not uploaded."));
        exit(); // Stop further execution
    }

    // Check if the file is an actual image
    if (!getimagesize($_FILES["u_pic"]["tmp_name"])) {
        echo json_encode(array("valid" => 0, "message" => "File is not an image."));
        exit(); // Stop further execution
    }

    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["u_pic"]["tmp_name"], $targetFile)) {
        $op = new Operations();
        $op->update_profile_pic($u_id, $fileName);
        echo json_encode(array("valid" => 1, "message" => "The file " . $fileName . " has been uploaded."));


        $messsage = "The file " . $fileName . " has been uploaded. #";
        $type = "Profile picture update";
        $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

    } else {
        echo json_encode(array("valid" => 0, "message" => "Sorry, there was an error uploading your file."));


    }
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Method Not Allowed"));
}
?>