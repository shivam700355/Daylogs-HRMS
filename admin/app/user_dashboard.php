<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>

<?php
$id = $_GET['id'];
$listing = new Listing();
$profile = $listing->user_profile($id);
$row = $profile->fetch(PDO::FETCH_ASSOC);
$u_id = $row['u_id'];


$salary_list = $listing->salary_list($u_id);

$activity = $listing->user_activity($id);
$document = $listing->user_document($id);
$attendance = $listing->user_attendance($id);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Employee Dashboard </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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

    <!-- Favicon -->
    <link rel="shortcut icon" href="../app-assets/icons/fav.png">

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
                    <div class="card-header" style="text-align: left;">
                        <h5 class="card-title">User Dashboard</h5>
                        <a style="float: right;" data-toggle="modal" data-target="#ProfileInformation"><i
                                class='fas fa-edit'></i></a>

                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="true">Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="attendance-tab" data-toggle="tab" href="#attendance" role="tab"
                                aria-controls="attendance" aria-selected="false">Attendance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="document-tab" data-toggle="tab" href="#document" role="tab"
                                aria-controls="document" aria-selected="false">Document</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab"
                                aria-controls="activity" aria-selected="false">Activity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="activity-tab" data-toggle="tab" href="#salary" role="tab"
                                aria-controls="activity" aria-selected="false">Salary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="activity-tab" data-toggle="tab" href="#account" role="tab"
                                aria-controls="activity" aria-selected="false">Account</a>
                        </li>

                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th colspan="2" style="text-align: left;">
                                                            <a href="#">Profile Information</a>

                                                        </th>

                                                    </tr>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <td><?php echo $row['u_id']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <td><?php echo $row['u_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Mobile</th>
                                                        <td><?php echo $row['u_mobile']; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td><?php echo $row['u_email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Role</th>
                                                        <td><?php echo $row['u_role']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Status</th>
                                                        <td><?php echo $row['u_status']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-body">
                                        <div class="table-responsive-sm">
                                            <table class="table table-lg table-bordered table-striped">
                                                <tbody>
                                                    <tr>

                                                        <th colspan="2" style="text-align: left;">
                                                            <a href="#">Other Information</a>

                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Address</th>
                                                        <td><?php echo $row['u_address']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">District</th>
                                                        <td><?php echo $row['u_district']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">State</th>
                                                        <td><?php echo $row['u_state']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Pincode</th>
                                                        <td><?php echo $row['u_pincode']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Added By</th>
                                                        <td><?php echo $row['u_added_by']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Added On</th>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="modal fade" id="ProfileInformation" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Profile Update</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="profileupdate" class="form">
                                                <input type="hidden" name="u_id" id="u_id"
                                                    value="<?php echo $row['u_id']; ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="u_name">Name</label>
                                                            <input type="text" class="form-control" id="u_name"
                                                                name="u_name" value="<?php echo $row['u_name']; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="u_mobile">Mobile</label>
                                                            <input type="text" class="form-control" id="u_mobile"
                                                                name="u_mobile" value="<?php echo $row['u_mobile']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="u_district">District</label>
                                                            <input type="text" class="form-control" id="u_district"
                                                                name="u_district"
                                                                value="<?php echo $row['u_district']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="u_dob">Date of birth</label>
                                                            <input type="date" class="form-control" id="u_dob"
                                                                name="u_dob" value="<?php echo $row['u_dob']; ?>">
                                                        </div>


                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="u_email">Email</label>
                                                            <input type="email" class="form-control" id="u_email"
                                                                name="u_email" value="<?php echo $row['u_email']; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="u_state">State</label>
                                                            <input type="text" class="form-control" id="u_state"
                                                                name="u_state" value="<?php echo $row['u_state']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="u_address">Address</label>
                                                            <input type="text" class="form-control" id="u_address"
                                                                name="u_address"
                                                                value="<?php echo $row['u_address']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="u_doj">Date of joining</label>
                                                            <input type="date" class="form-control" id="u_doj"
                                                                name="u_doj" value="<?php echo $row['u_doj']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="u_pincode">Pincode</label>
                                                            <input type="text" class="form-control" id="u_pincode"
                                                                name="u_pincode"
                                                                value="<?php echo $row['u_pincode']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="tab-pane" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="9"><a href="#">Attendance</a></th>
                                                    </tr>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>ID</th>
                                                        <th>Date</th>
                                                        <th>Check-in</th>
                                                        <th>Check-out</th>
                                                        <th>Working Hours</th>
                                                        <th>😊 Index</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    while ($row = $attendance->fetch(PDO::FETCH_ASSOC)) {
                                                        $i++;
                                                        $id = $row['id'];
                                                        $active = $row['status'];

                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['id']; ?></td>
                                                            <td><?php echo $row['checkin_date']; ?></td>
                                                            <td><?php echo $row['checkin_time']; ?></td>
                                                            <td><?php echo $row['checkout_time']; ?></td>
                                                            <td><?php echo "--:--"; ?></td>
                                                            <td><?php echo $row['h_index']; ?></td>
                                                            <td><label class="switch">
                                                                    <?php
                                                                    $activeText = "";
                                                                    if ($active == 0) {
                                                                        $activeText = " ";
                                                                    } else {
                                                                        $activeText = "checked";
                                                                    }
                                                                    ?>
                                                                    <input type="checkbox" <?php echo $activeText; ?>
                                                                        class="active"
                                                                        id='<?php echo $id . '_' . $active ?>'><span
                                                                        class="slider round"></span></label>
                                                            </td>
                                                            <td>
                                                                <a href="#?id=<?php echo $row['id']; ?>" target="_blank"
                                                                    class="btn btn-tbl-edit btn-xs btn-primary">
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
                        </div>

                        <div class="tab-pane" id="document" role="tabpanel" aria-labelledby="document-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="9" style="text-align: left;">
                                                            <a href="#">Activity</a>
                                                            <a style="float: right;" data-toggle="modal"
                                                                data-target="#fileupload"><i class="fa fa-upload"
                                                                    aria-hidden="true"></i></a>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>File</th>
                                                        <th>Documnet</th>
                                                        <th>Number</th>

                                                        <th>Date</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    while ($row = $document->fetch(PDO::FETCH_ASSOC)) {
                                                        $i++;
                                                        $id = $row['id'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td>
                                                                <img src="../../employee/app-assets/documents/<?php echo $row['doc_file']; ?>"
                                                                    alt="<?= $row['doc_file']; ?>"
                                                                    style="height: 40px;width: 40px; border-radius: 50%;">
                                                            </td>

                                                            <td><?php echo $row['doc_type']; ?></td>
                                                            <td><?php echo $row['doc_number']; ?></td>


                                                            <td><?php echo $row['created_at']; ?></td>

                                                            <td>
                                                                <a href="../../employee/app-assets/documents/<?php echo $row['doc_file']; ?>"
                                                                    target="_blank"
                                                                    class="btn btn-tbl-edit btn-xs btn-primary">
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
                                <div class="modal fade" id="fileupload" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="fileUploadForm" enctype="multipart/form-data">
                                                    <input type="hidden" name="u_id" id="u_id"
                                                        value="<?php echo $u_id; ?>">
                                                    <div class="form-group">
                                                        <label for="doc_type">Document Type</label>
                                                        <select class="form-control" id="doc_type" name="doc_type">
                                                            <option value="" disabled selected>Select </option>
                                                            <option value="aadhaar">Aadhaar</option>
                                                            <option value="pan">PAN</option>
                                                            <option value="resume">Resume</option>
                                                            <option value="offerletter">Offer Letter</option>
                                                            <option value="Resignation">Resignation Letter</option>
                                                            <option value="relievingletter">Relieving Letter</option>
                                                            <!-- Add more options as needed -->
                                                        </select>
                                                    </div>
                                                    <div class="form-group" id="doc_number_group">
                                                        <label for="doc_number">Document Number</label>
                                                        <input type="text" class="form-control" id="doc_number"
                                                            name="doc_number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="file">Choose File</label>
                                                        <input type="file" class="form-control-file" id="file"
                                                            name="file">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="9"><a href="#">Activity</a></th>
                                                    </tr>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>AID</th>
                                                        <th>Activity</th>
                                                        <th>Message</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    while ($row = $activity->fetch(PDO::FETCH_ASSOC)) {
                                                        $i++;
                                                        $id = $row['id'];
                                                        $active = $row['status'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['id']; ?></td>
                                                            <td><?php echo $row['type']; ?></td>
                                                            <td><?php echo $row['message']; ?></td>
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
                                                                    <input type="checkbox" <?php echo $activeText; ?>
                                                                        class="active"
                                                                        id='<?php echo $id . '_' . $active ?>'><span
                                                                        class="slider round"></span></label>
                                                            </td>
                                                            <td>
                                                                <a href="applicant_dashboard?id=<?php echo $row['id']; ?>"
                                                                    target="_blank"
                                                                    class="btn btn-tbl-edit btn-xs btn-primary">
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
                        </div>

                        <div class="tab-pane" id="salary" role="tabpanel" aria-labelledby="activity-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="9" style="text-align: left;">
                                                            <a href="#">Salary Information</a>
                                                            <a style="float: right;" data-toggle="modal"
                                                                data-target="#salaryadd"><i class="fa fa-upload"
                                                                    aria-hidden="true"></i></a>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>Salary Year</th>
                                                        <th>Salary Month</th>
                                                        <th>Salary Amount</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    while ($row = $salary_list->fetch(PDO::FETCH_ASSOC)) {
                                                        $i++;
                                                        $id = $row['id'];
                                                        $active = $row['status'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>

                                                            <td><?php echo $row['s_year']; ?></td>
                                                            <td><?php echo $row['s_month']; ?></td>
                                                            <td><?php echo $row['s_amount']; ?></td>


                                                        </tr>
                                                    <?php }
                                                    ?>
                                                </tbody>
                                                <div class="modal fade" id="salaryadd" tabindex="-1" role="dialog"
                                                    aria-labelledby="bankinfoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="bankinfoModalLabel">Add
                                                                    Salary</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="addsalary">
                                                                    <div class="form-row">
                                                                        <input type="hidden" name="u_id" id="u_id"
                                                                            value="<?php echo $id; ?>">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="s_year">Salary Year</label>
                                                                            <select class="form-control" id="s_year"
                                                                                name="s_year">
                                                                                <option value="2022">2022</option>
                                                                                <option value="2023">2023</option>
                                                                                <option value="2024">2024</option>
                                                                                <!-- Add more years as needed -->
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="s_month">Salary Month</label>
                                                                            <select class="form-control" id="s_month"
                                                                                name="s_month">
                                                                                <option value="January">January</option>
                                                                                <option value="February">February
                                                                                </option>
                                                                                <option value="March">March</option>
                                                                                <!-- Add more months as needed -->
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label for="s_amount">Salary Amount</label>
                                                                            <input type="number" class="form-control"
                                                                                id="s_amount" name="s_amount"
                                                                                placeholder="S_AMOUNT">
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="account" role="tabpanel" aria-labelledby="document-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="9" style="text-align: left;">
                                                            <a href="#">Account Information</a>
                                                            <a style="float: right;" data-toggle="modal"
                                                                data-target="#accountmodal"><i class="fa fa-upload"
                                                                    aria-hidden="true"></i></a>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>S.N</th>
                                                        <th>Bank Name</th>
                                                        <th>Account Number</th>
                                                        <th>Branch</th>

                                                        <th>IFSC Code</th>

                                                        <th>Account Holder Name</th>
                                                        <th>Account Type</th>
                                                        <th>Account Opening Date</th>

                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="accountmodal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Account Information
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="accountform">
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label for="bank_name">Bank Name</label>
                                                            <input type="text" class="form-control" id="bank_name"
                                                                name="bank_name" required>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="account_number">Account Number</label>
                                                            <input type="text" class="form-control" id="account_number"
                                                                name="account_number" required>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="branch">Branch</label>
                                                            <input type="text" class="form-control" id="branch"
                                                                name="branch" required>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="ifsc_code">IFSC Code</label>
                                                            <input type="text" class="form-control" id="ifsc_code"
                                                                name="ifsc_code" required>
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label for="holder_name">Account Holder Name</label>
                                                            <input type="text" class="form-control" id="holder_name"
                                                                name="holder_name" required>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="account_type">Account Type</label>
                                                            <select class="form-control" id="account_type"
                                                                name="account_type" required>
                                                                <option value="Savings">Savings</option>
                                                                <option value="Current">Current</option>
                                                                <option value="Fixed Deposit">Fixed Deposit</option>
                                                                <!-- Add more account types as needed -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label for="opening_date">Account Opening Date</label>
                                                            <input type="date" class="form-control" id="opening_date"
                                                                name="opening_date" required>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>



        </div>

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

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('submit', '#profileupdate', function (e) {
                e.preventDefault();
                $("#spinner-div").show();
                var u_id = $('#u_id').val();
                var u_name = $('#u_name').val();
                var u_mobile = $('#u_mobile').val();
                var u_email = $('#u_email').val();
                var u_address = $('#u_address').val();
                var u_district = $('#u_district').val();
                var u_state = $('#u_state').val();
                var u_doj = $('#u_doj').val();
                var u_dob = $('#u_dob').val();
                var u_pincode = $('#u_pincode').val();

                if (u_name !== '' && u_mobile !== '' && u_email !== '' && u_address !== '' && u_district !== '' && u_state !== '' && u_pincode !== '' && u_id !== '') {
                    $.ajax({
                        url: "action/update_profile.php",
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function (data) {
                            var responseData = JSON.parse(data);
                            if (responseData.valid == 1) {
                                success_noti(responseData.message, responseData.uname);
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            } else {
                                warning_noti(responseData.message, responseData.uname);
                            }
                        },
                        error: function () {
                            error_noti("Failed to update profile.");
                        }
                    });
                } else {
                    info_noti("All fields are required.");
                }

                return false; // Prevent the form from submitting normally
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('submit', '#fileUploadForm', function (e) {
                e.preventDefault();
                $("#spinner-div").show();
                var u_id = $('#u_id').val();
                var c_id = $('#c_id').val();
                var doc_type = $('#doc_type').val();
                var doc_number = $('#doc_number').val();
                var formData = new FormData($(this)[0]);

                if (u_id !== '' && doc_type !== '' && doc_number !== '') {
                    $.ajax({
                        url: 'action/upload_file.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var responseData = JSON.parse(response);
                            if (responseData.valid == 1) {
                                success_noti(responseData.message, responseData.uname);
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            } else {
                                warning_noti(responseData.message, responseData.uname);

                            }
                        },
                        error: function () {
                            console.log('Error uploading file.');
                        },
                        complete: function () {
                            $("#spinner-div").hide();
                        }
                    });
                } else {
                    console.log('Please fill in all fields.');
                    // Optionally, provide user feedback here
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('submit', '#addsalary', function (e) {
                e.preventDefault();
                $("#spinner-div").show();
                var formData = new FormData(this); // Directly pass the form element

                if (formData.get('s_year') !== '' && formData.get('s_month') !== '' && formData.get('s_amount') !== '') {
                    $.ajax({
                        url: 'action/addsalary.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var responseData = JSON.parse(response);
                            if (responseData.success) {
                                success_noti(responseData.message);
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            } else {
                                warning_noti(responseData.message);
                            }
                        },
                        error: function () {
                            console.log('Error add salary.');
                        },
                        complete: function () {
                            $("#spinner-div").hide();
                        }
                    });
                } else {
                    alert('Please fill in all fields.');
                }
            });
        });
    </script>



</body>

</html>