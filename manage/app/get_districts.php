<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php
if (isset($_POST['state'])) {
    $selectedState = $_POST['state'];

    $listing = new Listing();
    $result = $listing->state_district_list($selectedState);

    $options = '<option value="">Select District</option>';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $options .= '<option value="' . $row["district"] . '">' . $row["district"] . '</option>';
    }

    echo $options;
} else {
    echo '<option value="">Select District</option>';
}
?>
