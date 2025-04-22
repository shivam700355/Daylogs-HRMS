<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["s_year"]) && isset($_POST["s_month"]) && isset($_POST["s_amount"])) {
        $c_id = $_SESSION["cid"];
        $u_id = $_POST["u_id"];
        $s_year = $_POST["s_year"];
        $s_month = $_POST["s_month"];
        $s_amount = $_POST["s_amount"];

        $op = new Operations();
        try {
            $salary = $op->addSalary($c_id, $u_id, $s_year, $s_month, $s_amount);
            echo json_encode(array("success" => true, "message" => "Salary added successfully"));

            $messsage = "Salary added successfully.id #" . $salary;
            $type = "Salary added";
            $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Missing required fields"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
exit;
?>