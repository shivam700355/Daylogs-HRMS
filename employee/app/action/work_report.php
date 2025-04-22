<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['u_id']) && isset($_POST['w_date']) && isset($_POST['w_desc'])) {
        $u_id = $_POST['u_id'];
        $w_date = $_POST['w_date'];
        $w_desc = $_POST['w_desc'];
        $c_id = $_SESSION['cid'];


        $op = new Operations();
        $result = $op->add_work_report($c_id, $u_id, $w_date, $w_desc);
        if ($result) {
            echo json_encode(array('valid' => 1, 'message' => 'Work report submitted successfully'));

            $messsage = "Work report has been submitted successfully with work id #" . $result;
            $type = "Work Report";

            $row = $op->create_activity($type, $messsage, $u_id);


        } else {
            echo json_encode(array('valid' => 0, 'message' => 'Failed to submit work report. Please try again.'));
        }
    } else {
        echo json_encode(array('valid' => 0, 'message' => 'Incomplete form data'));
    }
} else {
    echo json_encode(array('valid' => 0, 'message' => 'Invalid request'));
}
