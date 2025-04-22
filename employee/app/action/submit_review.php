<?php
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';
$token = $_SESSION["token"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $u_id = $_POST["u_id"];
    $rating = $_POST["rating"];
    $review = $_POST["review"];


    $c_id = $_SESSION['cid'];
    $added_by = $_SESSION['u_id'];

    
    $op = new Operations();
    $result = $op->add_review_and_rating($c_id, $u_id, $rating, $review, $added_by);

    

    if ($result) {
        echo json_encode(array("valid" => 1, "message" => "Review submitted successfully"));

        $messsage = "Review and rating has been submitted with rating id #" . $result;
        $type = "Review & Rating";

        $row   = $op->create_activity($type, $messsage, $added_by);

    } else {
        echo json_encode(array("valid" => 0, "message" => "Error submitting review."));
    }
} else {

    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
}
?>