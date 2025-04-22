<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Validate the input dates
    $startDate = $_GET["startDate"];
    $endDate = $_GET["endDate"];
    header("Location: ../attendance-report.php?startDate=" . urlencode($startDate) . "&endDate=" . urlencode($endDate));
    exit();
}
?>