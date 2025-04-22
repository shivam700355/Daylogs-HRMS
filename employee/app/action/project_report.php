<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['u_id']) && isset($_POST['p_date']) && isset($_POST['remark']) && isset($_POST['p_id'])) {
        $p_id = $_POST['p_id'];
        $added_by = $_POST['u_id'];
        $p_date = $_POST['p_date'];
        $remark = $_POST['remark'];

        $op = new Operations();
        $result = $op->add_project_report($p_id, $p_date, $remark, $added_by);
        if ($result) {
            echo json_encode(array('valid' => 1, 'message' => 'Project report submitted successfully'));

            $message = "Project report has been submitted successfully with project id #" . $result;
            $type = "Project Report";

            $row = $op->create_activity($type, $message, $added_by);

        } else {
            echo json_encode(array('valid' => 0, 'message' => 'Failed to submit project report. Please try again.'));
        }
    } else {
        echo json_encode(array('valid' => 0, 'message' => 'Incomplete form data'));
    }
} else {
    echo json_encode(array('valid' => 0, 'message' => 'Invalid request'));
}
?>