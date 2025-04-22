<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
$token = $_SESSION["token"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['p_name']) && isset($_POST['ps_name']) && isset($_POST['s_date']) && isset($_POST['e_date']) && isset($_POST['p_desc'])) {
        $p_name = $_POST['p_name'];
        $ps_name = $_POST['ps_name'];
        $s_date = $_POST['s_date'];
        $e_date = $_POST['e_date'];
        $p_desc = $_POST['p_desc'];
        $c_id = $_SESSION["cid"];
        $added_by = $_SESSION["u_id"];

        $op = new Operations();

        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
            $targetDir = "../../app-assets/images/projects/";
            $fileExtension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $fileName = $c_id . "-" . str_replace(" ", "-", strtolower($ps_name)) . "." . $fileExtension;
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                $result = $op->add_project($p_name, $ps_name, $s_date, $e_date, $p_desc, $c_id, $added_by, $fileName);

                if ($result) {
                    echo json_encode(array("valid" => 1, "message" => "Project added successfully."));

                    $messsage = "Project added successfully..id #" . $result;
                    $type = "Project added";
                    $row = $op->create_activity($type, $messsage, $added_by);


                } else {
                    echo json_encode(array("valid" => 0, "message" => "Failed to add project."));
                }
            } else {
                echo json_encode(array("valid" => 0, "message" => "Sorry, there was an error uploading your file."));
            }
        } else {
            $result = $op->add_project($p_name, $ps_name, $s_date, $e_date, $p_desc, $c_id, $added_by, "daylogs.png");
            if ($result) {

                $messsage = "Project added successfully..id #" . $result;
                $type = "Project added";
                $row = $op->create_activity($type, $messsage, $added_by);

                echo json_encode(array("valid" => 1, "message" => "Project added successfully."));
            } else {
                echo json_encode(array("valid" => 0, "message" => "Failed to add project."));
            }
        }
    } else {
        echo json_encode(array("valid" => 0, "message" => "All fields are required."));
    }
} else {
    echo json_encode(array("valid" => 0, "message" => "Method not allowed."));
}

?>