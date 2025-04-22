<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
$token = $_SESSION["token"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $u_id = $_POST["u_id"];
    $rating = $_POST["rating"];
    $review = $_POST["review"];
    $c_id = $_POST["c_id"];
    $added_by = $c_id;



    $op = new Operations();
    $result = $op->addReview($c_id, $u_id, $rating, $review, $added_by);

    if ($result) {
        echo json_encode(array("valid" => 1, "message" => "Review submitted successfully."));

        $messsage = "Review submitted successfully.id #" . $result;
        $type = "Review submitted";
        $row = $op->create_activity($type, $messsage, $_SESSION['u_id']);

    } else {
        echo json_encode(array("valid" => 0, "message" => "Error submitting review."));
    }
} else {

    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
}
?>