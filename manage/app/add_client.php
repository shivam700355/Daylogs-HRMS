<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$state = $listing->state_list();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Add Client </title>
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

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include 'app_include/app_navbar.php'; ?>

        <?php include 'app_include/app_sidebar.php'; ?>

        <div class="content-wrapper">


            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Client Registration</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <form id="reg_form">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" id="c_name" name="c_name"
                                                placeholder="Enter Company Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Short Name</label>
                                            <input type="text" class="form-control" id="ca_name" name="ca_name"
                                                placeholder="Enter Company Short Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Contact Number</label>
                                            <input type="text" class="form-control" id="c_contact" name="c_contact"
                                                placeholder="Enter Company Contact Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Email</label>
                                            <input type="email" class="form-control" id="c_email" name="c_email"
                                                placeholder="Enter Company Email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Website</label>
                                            <input type="text" class="form-control" id="c_website" name="c_website"
                                                placeholder="Enter Company Website">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Upload Company Logo</label>
                                            <input type="file" class="form-control" id="file" name="file">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company PAN Number</label>
                                            <input type="text" class="form-control" id="c_pan" name="c_pan"
                                                placeholder="Enter Company PAN Number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company GSTIN Number</label>
                                            <input type="text" class="form-control" id="c_gst" name="c_gst"
                                                placeholder="Enter Company GSTIN Number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Address</label>
                                            <input type="text" class="form-control" id="c_address" name="c_address"
                                                placeholder="Enter Company Address">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select class="form-control" name="c_state" id="c_state"
                                                style="width: 100%;">
                                                <option value="">Select State</option>
                                                <?php
                                                while ($row = $state->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row["state"] . '">' . $row["state"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>District</label>
                                            <select class="form-control" name="c_district" id="c_district"
                                                style="width: 100%;">
                                                <option value="">Select District</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pincode</label>
                                            <input type="text" class="form-control" id="c_pincode" name="c_pincode"
                                                placeholder="Enter Pincode" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>

    <!-- script for post request -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $('#reg_form')[0].reset();
            $(document).on('submit', '#reg_form', function (e) {
                e.preventDefault();
                $("#spinner-div").show();
                var c_name = $('#c_name').val();
                var ca_name = $('#ca_name').val();
                var c_contact = $('#c_contact').val();
                var c_email = $('#c_email').val();
                var c_website = $('#c_website').val();
                var file = $('#file').val();
                var c_pan = $('#c_pan').val();
                var c_gst = $('#c_gst').val();
                var c_address = $('#c_address').val();
                var c_district = $('#c_district').val();
                var c_state = $('#c_state').val();
                var c_pincode = $('#c_pincode').val();

                if (c_name != '') {
                    $.ajax({
                        url: "action/add_client",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            var data = jQuery.parseJSON(data);
                            if (data.valid == 1) {
                                success_noti(data.message, data.uname);
                                setTimeout(function () {
                                    location.href = 'client';
                                }, 1000);
                                return false;
                            } else {
                                warning_noti(data.message, data.uname);
                                return false;
                            }
                        }
                    });
                } else {
                    info_noti("Name can't be empty.");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                    return false;
                }
            });
        });
    </script>

    <script>
        // Add an event listener to the State select element
        document.getElementById('c_state').addEventListener('change', function () {
            // Get the selected state value
            const selectedState = this.value;

            // Send an AJAX request to a PHP script to fetch districts based on the selected state
            // You can use libraries like jQuery or fetch API for AJAX requests

            // Example using jQuery:
            $.ajax({
                url: 'get_districts.php', // Replace with the actual URL of your PHP script
                method: 'POST',
                data: {
                    state: selectedState
                },
                success: function (data) {
                    // Update the District select options with the data received from the server
                    $('#c_district').html(data);
                }
            });
        });
    </script>








</body>

</html>