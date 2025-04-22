<?php include "../app_include/session.php"; ?>
<?php include "../app_include/function.php"; ?>
<?php include 'class/operations-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php

if (isset($_POST['u_id'])) {

    $u_id        = $_POST['u_id'];
    $c_id        = $_POST['c_id'];
    $doc_type    = $_POST['doc_type'];
    $doc_number  = $_POST['doc_number'];

    $u_id        = $_SESSION['u_id'];
    $u_name      = $_SESSION['name'];

    $msg = "Document " . $doc_type . " uploaded ";
    $type = "Document added";

    $target_dir = "../../app-assets/documents/";

    $fileName="";

    $fileName = $u_id.'_'.strtolower(str_replace(' ', '_', $doc_type) . '.' . strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION)));

    $target_file = $target_dir . $fileName;

    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $op = new Operations();

    $document = $op->add_document($c_id, $u_id, $doc_type, $doc_number, $fileName);

    if ($document > 0) {
        echo json_encode(array("valid" => 1,"message" => "Document has been added successfully"));

        $messsage ="Document has been uploaded successfully with document id #".$document;
        $msg_type = "Document Upload" ;
        $row   = $op->create_activity($msg_type, $messsage, $u_id);
        
    } else {
        echo json_encode(array("valid" => 0,"message" => "Something went wrong."));
    }
} else {
    echo json_encode(array(
        "valid" => 0,
        "message" => "Variable missing"
    ));
}
?>