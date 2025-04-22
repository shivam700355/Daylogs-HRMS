<?php
// Include necessary files and start session
include "../app_include/session.php";
include "../app_include/function.php";
include 'class/operations-class.php';

// Validate session token
$token = $_SESSION["token"];

// Sanitize and validate the userId input
$u_id = filter_input(INPUT_GET, 'userId', FILTER_VALIDATE_INT);
if ($u_id === false) {
    // Invalid userId, return an error message
    echo json_encode(['success' => false, 'message' => 'Invalid userId']);
    exit; // Stop further execution
}

// Initialize the Listing class
$listing = new Listing();

// Get user status based on userId
$user = $listing->get_all_status($u_id);

// Check if user status was found
if ($user !== false) {
    // Return success and user data
    echo json_encode(['success' => true, 'data' => $user]);
} else {
    // Return error message if user status not found
    echo json_encode(['success' => false, 'message' => 'User not found']);
}
?>
