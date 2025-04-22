<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>

<?php
$id = $_GET['id'];
$listing    = new Listing();
$profile    = $listing->user_profile($id);
$row        = $profile->fetch(PDO::FETCH_ASSOC);

$activity = $listing->user_activity($id);
$document = $listing->user_document($id);
$attendance = $listing->user_attendance($id);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Client Dashboard </title>
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
                    <div class="card-header">
                        <h5 class="card-title">Client Dashboard</h5>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="attendance-tab" data-toggle="tab" href="#attendance" role="tab" aria-controls="attendance" aria-selected="false">Attendance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="document-tab" data-toggle="tab" href="#document" role="tab" aria-controls="document" aria-selected="false">Document</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="false">Activity</a>
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
                                                        <th colspan="2"><a href="#">Profile Information</a></th>
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
                                                        <th colspan="2"><a href="#">Other Information</a></th>
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
                                                        $active      = $row['status'];

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['id']; ?></td>
                                                            <td><?php echo $row['checkin_date']; ?></td>
                                                            <td><?php echo $row['checkin_time']; ?></td>
                                                            <td><?php echo $row['checkout_time']; ?></td>
                                                            <td><?php echo "--:--"; ?></td>
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
                                                                <a href="#?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary">
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
                                                        <th colspan="9"><a href="#">Activity</a></th>
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
                                                                <img src="../app-assets/documents/<?php echo $row['doc_file']; ?>" alt="<?= $row['doc_file']; ?>" style="height: 40px;width: 40px; border-radius: 50%;""></td>
                         
                                                            <td><?php echo $row['doc_type']; ?></td>
                                                            <td><?php echo $row['doc_number']; ?></td>
                                                        
                    
                                                            <td><?php echo $row['created_at']; ?></td>
                                                            
                                                            <td>
                                                                <a href=" #?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary">
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
                                                        $active      = $row['status'];
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo 'VC#' . $row['id']; ?></td>
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






</body>

</html>