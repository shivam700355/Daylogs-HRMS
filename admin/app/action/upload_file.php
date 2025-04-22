<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["u_id"]) && isset($_POST["doc_type"]) && isset($_POST["doc_number"]) && isset($_FILES["file"])) {
        $u_id = $_POST["u_id"];
        $c_id = $_SESSION["u_id"];
        $doc_type = $_POST["doc_type"];
        $doc_number = $_POST["doc_number"];
        $file = $_FILES["file"];

        if ($file["error"] === UPLOAD_ERR_OK) {
            $uploadDir = "../../app-assets/documents/";
            $fileName = strtolower(str_replace(' ', '_', $doc_type) . '.' . strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION)));
            $uploadPath = $uploadDir . $fileName;
            if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
                $op = new Operations();
                $filedata = $op->uploadFile($c_id, $u_id, $doc_type, $doc_number, $fileName);
                echo json_encode(array("success" => true, "message" => "File uploaded successfully"));

                $messsage = "File uploaded successfully. #" . $filedata;
                $type = "File uploaded";
                $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

            } else {
                echo json_encode(array("success" => false, "message" => "Failed to move uploaded file"));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "File upload error: " . $file["error"]));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Missing required fields"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
exit;
?>