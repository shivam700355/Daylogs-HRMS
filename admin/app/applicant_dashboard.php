<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php
function sendMessage($code, $message)
{
    http_response_code($code);
    echo json_encode(array('message' => $message));
    die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['app_id'])) {
        sendMessage(400, 'Missing Application ID');
    }
    $id = $_POST['app_id'];
    if (!isset($_POST['l_amt'])) {
        sendMessage(400, 'Missing Amount');
    }
    $amt = $_POST['l_amt'];
    if (!isset($_POST['int'])) {
        sendMessage(400, 'Missing Interest Rate');
    }
    $int = $_POST['int'];
    if (!isset($_POST['mnths'])) {
        sendMessage(400, 'Missing EMI Tenure');
    }
    $time = $_POST['mnths'];
    if (!isset($_POST['date'])) {
        sendMessage(400, 'Missing EMI Start Date');
    }
    $date = date_create($_POST['date']);

    function emi_calculator($p, $r, $t)
    {
        $r = $r / (12 * 100);
        $emi = ($p * $r * pow(1 + $r, $t)) / (pow(1 + $r, $t) - 1);
        return $emi;
    }

    $emi = emi_calculator($amt, $int, $time);
    $listing  = new Listing();
    $outstanding = $amt;
    for ($i = 1; $i <= $time; $i++) {
        $start_date = date_add($date, date_interval_create_from_date_string('1 month'));
        $interest = $outstanding * ($int / (12 * 100));
        $insert = $listing->createEMI($id, $i, round($emi, 2), round($interest, 2), $int, round($outstanding, 2), date_format($start_date, 'Y-m-d'), date_format(date_add($start_date, date_interval_create_from_date_string('15 days')), 'Y-m-d'));
        if (!$insert) {
            sendMessage(500, 'Error creating EMI');
        }
        $outstanding =  (($outstanding) * (1 + ($int / (12 * 100)))) - $emi;
        $date = $start_date;
        $date = date_sub($date, date_interval_create_from_date_string('15 days'));
    }

    sendMessage(200, 'EMI Created Successfully');
}
?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>

<?php
$a_id = $_GET['id'];
$listing  = new Listing();
$profile    = $listing->applicant_profile($a_id);
$row       = $profile->fetch(PDO::FETCH_ASSOC);

$applications = $listing->applicant_application_list($a_id);
$kyc         = $listing->applicant_kyc_list($a_id);
$bank         = $listing->applicant_bank_list($a_id);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VCREDIL | Applicant Dashboard </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../app-assets/plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../app-assets/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../app-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../app-assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../app-assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../app-assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../app-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../app-assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="../app-assets/plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="../app-assets/plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../app-assets/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../app-assets/dist/img/vcredil-round-logo.png">

    <style type="text/css">
        #spinner-div {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 450px;
            right: 0;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);

        }
    </style>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 30px;
            /* Reduced width */
            height: 17px;
            /* Reduced height */
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
            /* Make it round */
            height: 100%;
            /* Fill the height of the switch */
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 11px;
            /* Reduced height */
            width: 11px;
            /* Reduced width */
            left: 3px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(13px);
            /* Adjusted for smaller switch */
            -ms-transform: translateX(13px);
            /* Adjusted for smaller switch */
            transform: translateX(13px);
            /* Adjusted for smaller switch */
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include 'app_include/app_navbar.php'; ?>

        <?php include 'app_include/app_sidebar.php'; ?>

        <div class="content-wrapper">

            <section class="content">
                <div class="card card-default">
                    <div class="card-header">
                        <h5 class="card-title">Aplicant Dashboard</h5>
                    </div>

                    <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th colspan="2"><a href="#">Profile Information</a></th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <td><?php echo $row['name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mobile</th>
                                                    <td><?php echo $row['mobile']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email</th>
                                                    <td><?php echo $row['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Status</th>
                                                    <td><?php echo $row['status']; ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th colspan="2"><a href="#">KYC Information</a></th>
                                                </tr>

                                                <tr>
                                                    <th scope="row">PAN</th>
                                                    <td><?php echo $row['pan']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Aadhaar</th>
                                                    <td><?php echo $row['aadhar']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">KYC Status</th>
                                                    <td><?php echo $row['kyc_status']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">E-Mendate</th>
                                                    <td><?php echo $row['kyc_status']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-lg table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th colspan="2"><a href="#">Address Information</a></th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Address</th>
                                                    <td><?php echo $row['address']; ?></td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">District</th>
                                                    <td><?php echo $row['district']; ?></td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">State</th>
                                                    <td><?php echo $row['state']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">State</th>
                                                    <td><?php echo $row['pincode']; ?></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                          
                        </div>
                    </div>


                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">KYC Form</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="kyc-form" enctype="multipart/form-data">
                                        <input type="number" name="id" id="id" value="<?= $a_id; ?>" hidden>
                                        <input type="number" name="verified_by" id="verified_by" value="<?= $_SESSION['id']; ?>" hidden>
                                        <div class="mb-3">
                                            <select class="form-control" name="doc_type" id="doc_type" required>
                                                <option selected disabled hidden value="none">Select Document Type</option>
                                                <option value="Aadhaar">Aadhaar</option>
                                                <option value="PAN">PAN</option>
                                            </select>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="doc_number" id="doc_number" placeholder="Document Number" required>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="verified_comment" id="verified_comment" placeholder="Comment" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Document</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file" accept="image/*, application/pdf" required>
                                                <label class="custom-file-label" for="file">Choose file</label>
                                            </div>
                                        </div>
                                        <div id="message">

                                        </div>
                                        <input type="submit" value="submit" class="btn btn-primary">
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div id="emiModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="spinner-border text-primary" role="status" style="display:none;" id="loader">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div id="success" style="display:none;">
                                        <i class="fa fa-check fa-solid" aria-hidden="true" style="font-size:24px;color:green;"></i>
                                    </div>
                                    <h4 class="modal-title">EMI Creation Form</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="emi-form" enctype="application/x-www-form-urlencoded">
                                        <div class="mb-2">
                                            <label for="app_id" class="form-label">Application Id</label>
                                            <input type="text" class="form-control" name="app_id" id="app_id" readonly>
                                        </div>
                                        <div class="mb-2">
                                            <label for="l_type" class="form-label">Loan Type</label>
                                            <input type="text" class="form-control" name="l_type" id="l_type" readonly>
                                        </div>
                                        <div class="mb-2">
                                            <label for="l_amt" class="form-label">Loan Amount</label>
                                            <input type="text" class="form-control" name="l_amt" id="l_amt" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="int" class="form-label">Interest Rate</label>
                                            <select class="form-control" name="int" id="int" required>
                                                <option selected hidden disabled>Select</option>
                                                <option value="15">15%</option>
                                                <option value="20">20%</option>
                                                <option value="25">25%</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="mnths" class="form-label">Tenure(in months)</label>
                                            <input type="number" class="form-control" name="mnths" id="mnths" min="1" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="date" class="form-label">EMI Start Date</label>
                                            <input type="date" class="form-control" name="date" id="date" required>
                                        </div>
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                   
                    <section class="content">
                        <div class="card card-default">
                            <div class="card-header">
                                <h5 class="card-title">Aplicant Dashboard</h5>
                            </div>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Application</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Bank</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">KYC</a>
                                </li>
                            </ul>
                            <!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">KYC Form</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="kyc-form" enctype="multipart/form-data">
                                                <input type="number" name="id" id="id" value="<?= $a_id; ?>" hidden>
                                                <input type="number" name="verified_by" id="verified_by" value="<?= $_SESSION['id']; ?>" hidden>
                                                <div class="mb-3">
                                                    <select class="form-control" name="doc_type" id="doc_type" required>
                                                        <option selected disabled hidden value="none">Select Document Type</option>
                                                        <option value="Aadhaar">Aadhaar</option>
                                                        <option value="PAN">PAN</option>
                                                    </select>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="doc_number" id="doc_number" placeholder="Document Number" required>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="verified_comment" id="verified_comment" placeholder="Comment" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Document</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file" accept="image/*, application/pdf" required>
                                                        <label class="custom-file-label" for="file">Choose file</label>
                                                    </div>
                                                </div>
                                                <div id="message">

                                                </div>
                                                <input type="submit" value="submit" class="btn btn-primary">
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div id="emiModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="spinner-border text-primary" role="status" style="display:none;" id="loader">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <div id="success" style="display:none;">
                                                <i class="fa fa-check fa-solid" aria-hidden="true" style="font-size:24px;color:green;"></i>
                                            </div>
                                            <h4 class="modal-title">EMI Creation Form</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="emi-form" enctype="application/x-www-form-urlencoded">
                                                <div class="mb-2">
                                                    <label for="app_id" class="form-label">Application Id</label>
                                                    <input type="text" class="form-control" name="app_id" id="app_id" readonly>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="l_type" class="form-label">Loan Type</label>
                                                    <input type="text" class="form-control" name="l_type" id="l_type" readonly>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="l_amt" class="form-label">Loan Amount</label>
                                                    <input type="text" class="form-control" name="l_amt" id="l_amt" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="int" class="form-label">Interest Rate</label>
                                                    <select class="form-control" name="int" id="int" required>
                                                        <option selected hidden disabled>Select</option>
                                                        <option value="15">15%</option>
                                                        <option value="20">20%</option>
                                                        <option value="25">25%</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="mnths" class="form-label">Tenure(in months)</label>
                                                    <input type="number" class="form-control" name="mnths" id="mnths" min="1" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="date" class="form-label">EMI Start Date</label>
                                                    <input type="date" class="form-control" name="date" id="date" required>
                                                </div>
                                                <input type="submit" value="Submit" class="btn btn-primary">
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="2"><a href="#">Profile Information</a></th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Name</th>
                                                                <td><?php echo $row['name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Mobile</th>
                                                                <td><?php echo $row['mobile']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Email</th>
                                                                <td><?php echo $row['email']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Status</th>
                                                                <td><?php echo $row['status']; ?></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="2"><a href="#">KYC Information</a></th>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">PAN</th>
                                                                <td><?php echo $row['pan']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Aadhaar</th>
                                                                <td><?php echo $row['aadhar']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">KYC Status</th>
                                                                <td><?php echo $row['kyc_status']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">E-Mendate</th>
                                                                <td><?php echo $row['kyc_status']; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card-body">
                                                <div class="table-responsive-sm">
                                                    <table class="table table-lg table-bordered table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="2"><a href="#">Address Information</a></th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Address</th>
                                                                <td><?php echo $row['address']; ?></td>

                                                            </tr>
                                                            <tr>
                                                                <th scope="row">District</th>
                                                                <td><?php echo $row['district']; ?></td>

                                                            </tr>
                                                            <tr>
                                                                <th scope="row">State</th>
                                                                <td><?php echo $row['state']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">State</th>
                                                                <td><?php echo $row['pincode']; ?></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="10"><a href="#">Loan Applications</a></th>
                                                            </tr>
                                                            <tr>
                                                                <th>S.N</th>
                                                                <th>AID</th>
                                                                <th>Loan Type</th>
                                                                <th>Loan Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Accepted</th>
                                                                <th>Released</th>
                                                                <th>Applied Date</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i = 0;
                                                            while ($row = $applications->fetch(PDO::FETCH_ASSOC)) {
                                                                $i++;
                                                                $id = $row['id'];
                                                                $active      = $row['status'];
                                                            ?>
                                                                <tr id="<?php echo $row['id']; ?>">
                                                                    <td><?php echo $i; ?></td>
                                                                    <td id="app_id"><?php echo 'VC#' . $row['id']; ?></td>
                                                                    <td id="type"><?php echo $row['type']; ?></td>
                                                                    <td id="amt"><?php echo $row['r_amount']; ?></td>
                                                                    <td id="ramt"><?php echo $row['p_amount']; ?></td>
                                                                    <td id="accepted"><?php echo $row['accepted']; ?></td>
                                                                    <td id="released"><?php echo $row['released']; ?></td>
                                                                    <td id="c_at"><?php echo $row['created_at']; ?></td>
                                                                    <td><label class="switch">
                                                                            <?php
                                                                            $activeText = "";
                                                                            if ($active == 0) {
                                                                                $activeText = " ";
                                                                            } else {
                                                                                $activeText = "checked";
                                                                            }
                                                                            ?>
                                                                            <input type="checkbox" <?php echo $activeText; ?> class="active" id='<?php echo $id . '_' . $active ?>'><span class="slider round"></span></label>
                                                                    </td>
                                                                    <td>
                                                                        <button href="applicant_dashboard?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary" onclick="createEMI('<?php echo $row['id']; ?>')">
                                                                            <i class="fa fa-eye"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="10"><a href="#">Loan Applications</a></th>
                                                            </tr>
                                                            <tr>
                                                                <th>S.N</th>
                                                                <th>AID</th>
                                                                <th>Loan Type</th>
                                                                <th>Loan Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Accepted</th>
                                                                <th>Released</th>
                                                                <th>Applied Date</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i = 0;
                                                            while ($row = $applications->fetch(PDO::FETCH_ASSOC)) {
                                                                $i++;
                                                                $id = $row['id'];
                                                                $active      = $row['status'];
                                                            ?>
                                                                <tr id="<?php echo $row['id']; ?>">
                                                                    <td><?php echo $i; ?></td>
                                                                    <td id="app_id"><?php echo 'VC#' . $row['id']; ?></td>
                                                                    <td id="type"><?php echo $row['type']; ?></td>
                                                                    <td id="amt"><?php echo $row['r_amount']; ?></td>
                                                                    <td id="ramt"><?php echo $row['p_amount']; ?></td>
                                                                    <td id="accepted"><?php echo $row['accepted']; ?></td>
                                                                    <td id="released"><?php echo $row['released']; ?></td>
                                                                    <td id="c_at"><?php echo $row['created_at']; ?></td>
                                                                    <td><label class="switch">
                                                                            <?php
                                                                            $activeText = "";
                                                                            if ($active == 0) {
                                                                                $activeText = " ";
                                                                            } else {
                                                                                $activeText = "checked";
                                                                            }
                                                                            ?>
                                                                            <input type="checkbox" <?php echo $activeText; ?> class="active" id='<?php echo $id . '_' . $active ?>'><span class="slider round"></span></label>
                                                                    </td>
                                                                    <td>
                                                                        <button href="applicant_dashboard?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary" onclick="createEMI('<?php echo $row['id']; ?>')">
                                                                            <i class="fa fa-eye"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                    <div class="col-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="10"><a href="#">Bank Information</a></th>
                                                            <th colspan="1"><a href="#" data-toggle="modal" data-target="#myModal">Add <i class="fa fa-plus"></i></a> </th>
                                                        </tr>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>BID</th>
                                                            <th>Name</th>
                                                            <th>Branch Code</th>
                                                            <th>Account Number</th>
                                                            <th>IFSC</th>
                                                            <th>Default</th>
                                                            <th>E-Mendate</th>
                                                            <th>Added On</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        while ($row = $bank->fetch(PDO::FETCH_ASSOC)) {
                                                            $i++;
                                                            $id = $row['id'];
                                                            $active      = $row['status'];
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo 'VC#' . $row['id']; ?></td>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['branch_code']; ?></td>
                                                                <td><?php echo $row['a_number']; ?></td>
                                                                <td><?php echo $row['ifsc']; ?></td>
                                                                <td><?php echo $row['default_status']; ?></td>
                                                                <td><?php echo $row['verified']; ?></td>

                                                                <td><?php echo $row['created_at']; ?></td>
                                                                <td><label class="switch">
                                                                        <?php
                                                                        $activeText = "";
                                                                        if ($active == 0) {
                                                                            $activeText = " ";
                                                                        } else {
                                                                            $activeText = "checked";
                                                                        }
                                                                        ?>
                                                                        <input type="checkbox" <?php echo $activeText; ?> class="active" id='<?php echo $id . '_' . $active ?>'><span class="slider round"></span></label>
                                                                </td>
                                                                <td>
                                                                    <a href="applicant_dashboard?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary">
                                                                        <i class="fa fa-eye"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                    <div class="col-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="8"><a href="#">KYC Information</a></th>
                                                            <th colspan="1"><a href="#" data-toggle="modal" data-target="#myModal">Add <i class="fa fa-plus"></i></a> </th>
                                                        </tr>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>KID</th>
                                                            <th>Document</th>
                                                            <th>Number</th>
                                                            <th>Verify By</th>
                                                            <th>Comment</th>
                                                            <th>Verify On</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        while ($row = $kyc->fetch(PDO::FETCH_ASSOC)) {
                                                            $i++;
                                                            $id = $row['id'];
                                                            $active      = $row['status'];
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo 'VC#' . $row['id']; ?></td>
                                                                <td><?php echo $row['doc_type']; ?></td>
                                                                <td><?php echo $row['doc_number']; ?></td>
                                                                <td><?php echo $row['verified_by']; ?></td>
                                                                <td><?php echo $row['verified_comment']; ?></td>
                                                                <td><?php echo $row['created_at']; ?></td>
                                                                <td><label class="switch">
                                                                        <?php
                                                                        $activeText = "";
                                                                        if ($active == 0) {
                                                                            $activeText = " ";
                                                                        } else {
                                                                            $activeText = "checked";
                                                                        }
                                                                        ?>
                                                                        <input type="checkbox" <?php echo $activeText; ?> class="active" id='<?php echo $id . '_' . $active ?>'><span class="slider round"></span></label>
                                                                </td>
                                                                <td>
                                                                    <a href="applicant_dashboard?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary">
                                                                        <i class="fa fa-eye"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12 mx-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
        <script>
            const loader = document.getElementById('loader');
            const success = document.getElementById('success');
            const form = document.getElementById('emi-form');
            const message = document.getElementById('message');
            async function createEMI(id) {
                const row = document.getElementById(id);
                form.querySelector('#app_id').value = id;
                form.querySelector('#l_type').value = row.querySelector('#type').textContent;
                form.querySelector('#l_amt').value = row.querySelector('#amt').textContent;
                loader.style.display = 'none';
                success.style.display = 'none';
                message.textContent = '';
                $('#emiModal').modal('show');
            }
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                loader.style.display = '';
                const response = await fetch('applicant_dashboard.php', {
                    method: 'POST',
                    body: new FormData(form)
                });
                loader.style.display = 'none';
                const data = await response.json();
                if (response.ok) {
                    success.style.display = '';
                    message.textContent = data.message;
                    form.reset();
                } else {
                    message.textContent = data.message ?? 'Something went wrong';
                }
            });
        </script>

        <?php include 'app_include/app_footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>

    </div>

    <!-- jQuery -->
    <script src="../app-assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../app-assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="../app-assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../app-assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="../app-assets/plugins/moment/moment.min.js"></script>
    <script src="../app-assets/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="../app-assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="../app-assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../app-assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="../app-assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="../app-assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="../app-assets/plugins/dropzone/min/dropzone.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../app-assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../app-assets/dist/js/demo.js"></script>
    <!-- Page specific script -->

    <!-- Toastr -->
    <script src="../app-assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
    <script src="toast.js"></script>






</body>

</html>