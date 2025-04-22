<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>

<?php
$listing = new Listing();
$u_id = $_SESSION['u_id'];
$c_id = $_SESSION['cid'];

$profile = $listing->user_profile($u_id);
$c_profile = $listing->company_profile($c_id);


$up = $profile->fetch(PDO::FETCH_ASSOC);
$cp = $c_profile->fetch(PDO::FETCH_ASSOC);

$imagename = $up['u_pic'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Profile </title>
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
                        <h5 class="card-title">Profile</h5>
                        <a style="float: right;" data-toggle="modal" data-target="#ProfileInformation"><i class='fas fa-edit'></i></a>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="user-profile-tab" data-toggle="tab" href="#user-profile" role="tab" aria-controls="user-profile" aria-selected="true">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="company-profile-tab" data-toggle="tab" href="#company-profile" role="tab" aria-controls="company-profile" aria-selected="false">Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="setting-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false">Setting</a>
                        </li>

                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="user-profile" role="tabpanel" aria-labelledby="user-profile-tab">
                            <div class="row">

                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th colspan="2"><a href="#">Profile Information #<?php echo $up['u_id']; ?></a></th>
                                                    </tr>
                                                    <!-- <tr>
                                                        <th scope="col">Image</th>
                                                        <td>
                                                            <img src="../app-assets/images/profile/<?php echo $up['u_pic'] ?>" alt="logo" height="40px" width="40px" style="border-radius:50%;">
                                                        </td>
                                                    </tr> -->

                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <td><?php echo $up['u_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Mobile</th>
                                                        <td><?php echo $up['u_mobile']; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td><?php echo $up['u_email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Designation</th>
                                                        <td><?php echo $up['u_designation']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Date Of Birth</th>
                                                        <td><?php echo $up['u_dob']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Date of Joining</th>
                                                        <td><?php echo $up['u_doj']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Role</th>
                                                        <td><?php echo $up['u_role']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th colspan="2"><a href="#">Other Information</a></th>
                                                    </tr>

                                                    <tr>
                                                        <th scope="col">Address</th>
                                                        <td><?php echo $up['u_address']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">District</th>
                                                        <td><?php echo $up['u_district']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">State</th>
                                                        <td><?php echo $up['u_state']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Pincode</th>
                                                        <td><?php echo $up['u_pincode']; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Added By</th>
                                                        <td><?php echo $up['u_added_by']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Added On</th>
                                                        <td><?php echo $up['created_at']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Status</th>
                                                        <td><?php echo $up['u_status']; ?></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="ProfileInformation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <input type="hidden" name="u_id" id="u_id" value="<?php echo $up['u_id']; ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="u_name">Name</label>
                                                            <input type="text" class="form-control" id="u_name" name="u_name" value="<?php echo $up['u_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="u_mobile">Mobile</label>
                                                            <input type="text" class="form-control" id="u_mobile" name="u_mobile" value="<?php echo $up['u_mobile']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="u_email">Email</label>
                                                            <input type="email" class="form-control" id="u_email" name="u_email" value="<?php echo $up['u_email']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="u_address">Address</label>
                                                            <input type="text" class="form-control" id="u_address" name="u_address" value="<?php echo $up['u_address']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="u_state">State</label>
                                                            <input type="text" class="form-control" id="u_state" name="u_state" value="<?php echo $up['u_state']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="u_district">District</label>
                                                            <input type="text" class="form-control" id="u_district" name="u_district" value="<?php echo $up['u_district']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="u_pincode">Pincode</label>
                                                            <input type="text" class="form-control" id="u_pincode" name="u_pincode" value="<?php echo $up['u_pincode']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="company-profile" role="tabpanel" aria-labelledby="company-profile-tab">
                            <div class="row">

                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th colspan="2"><a href="#">Company Information #<?php echo $cp['id']; ?></a></th>
                                                    </tr>
                                                    <!-- <tr>
                                                        <th scope="col">Image</th>
                                                        <td>
                                                            <img src="../app-assets/images/profile/<?php echo $cp['u_pic'] ?>" alt="logo" height="40px" width="40px" style="border-radius:50%;">
                                                        </td>
                                                    </tr> -->

                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <td><?php echo $cp['name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Mobile</th>
                                                        <td><?php echo $cp['mobile']; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td><?php echo $cp['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Website</th>
                                                        <td><?php echo $cp['website']; ?></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-4 col-sm-12">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th colspan="2"><a href="#">Other Information</a></th>
                                                    </tr>

                                                    <tr>
                                                        <th scope="col">Address</th>
                                                        <td><?php echo $cp['address']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">District</th>
                                                        <td><?php echo $cp['district']; ?></td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">State</th>
                                                        <td><?php echo $cp['state']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Pincode</th>
                                                        <td><?php echo $cp['pincode']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-12 p-3">
                                    <div class="card">
                                        <div class="card-header">Profile Picture</div>
                                        <div class="card-body text-center align-items-center">
                                            <div class="container">
                                                <div class="row mt-2 justify-content-center">
                                                    <div class="profile-pic">
                                                        <img src="../app-assets/images/profile/<?php echo $imagename ?>" id="output" width="200" height="200" style="border-radius: 50%;" />
                                                    </div>
                                                </div>
                                                <form id="updateu_pic" enctype="multipart/form-data">
                                                    <div class="row mt-2 justify-content-center">
                                                        <input id="u_pic" type="file" name="u_pic" class="form-control" onchange="loadFile(event)" />
                                                    </div>
                                                    <div class="row mt-2 justify-content-center">
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-12 p-3">
                                    <div class="card">
                                        <div class="card-header">Change Password</div>

                                        <div class="card-body">
                                            <form id="resetPasswordForm">
                                                <div class="form-group">
                                                    <label for="oldPassword">Old Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                                                        <button type="button" class="btn btn-outline-secondary" id="toggleOldPassword">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="newPassword">New Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                                        <button type="button" class="btn btn-outline-secondary" id="toggleNewPassword">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirmNewPassword">Confirm New Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                                                        <button type="button" class="btn btn-outline-secondary" id="toggleConfirmNewPassword">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mt-2 justify-content-center">
                                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                                </div>

                                            </form>
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
    <script>
        var loadFile = function(event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        function togglePasswordVisibility(inputId, buttonId) {
            var input = document.getElementById(inputId);
            var button = document.getElementById(buttonId);
            if (input.type === "password") {
                input.type = "text";
                button.innerHTML = ' <i class="fa fa-eye-slash"></i>';
            } else {
                input.type = "password";
                button.innerHTML = '<i class="fa fa-eye"></i>';
            }
        }
        document.getElementById("toggleOldPassword").addEventListener("click", function() {
            togglePasswordVisibility("oldPassword", "toggleOldPassword");
        });
        document.getElementById("toggleNewPassword").addEventListener("click", function() {
            togglePasswordVisibility("newPassword", "toggleNewPassword");
        });
        document.getElementById("toggleConfirmNewPassword").addEventListener("click", function() {
            togglePasswordVisibility("confirmNewPassword", "toggleConfirmNewPassword");
        });
    </script>
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
        $(document).ready(function() {
            $(document).on('submit', '#profileupdate', function(e) {
                e.preventDefault();
                $("#spinner-div").show();
                var u_id = $('#u_id').val();
                var u_name = $('#u_name').val();
                var u_mobile = $('#u_mobile').val();
                var u_email = $('#u_email').val();
                var u_address = $('#u_address').val();
                var u_district = $('#u_district').val();
                var u_state = $('#u_state').val();
                var u_pincode = $('#u_pincode').val();

                if (u_name !== '' && u_mobile !== '' && u_email !== '' && u_address !== '' && u_district !== '' && u_state !== '' && u_pincode !== '' && u_id !== '') {
                    $.ajax({
                        url: "action/update_profile.php",
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                            if (responseData.valid == 1) {
                                success_noti(responseData.message, responseData.uname);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                warning_noti(responseData.message, responseData.uname);
                            }
                        },
                        error: function() {
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#resetPasswordForm').submit(function(e) {
                e.preventDefault();
                $("#spinner-div").show();
                var oldPassword = $('#oldPassword').val();
                var newPassword = $('#newPassword').val();
                var confirmNewPassword = $('#confirmNewPassword').val();

                if (oldPassword !== '' && newPassword !== '' && confirmNewPassword !== '') {
                    if (newPassword !== confirmNewPassword) {
                        warning_noti("New password and confirm new password do not match.");
                        return false;
                    }
                    $.ajax({
                        url: "action/update_password.php",
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                            if (responseData.valid == 1) {
                                success_noti(responseData.message, responseData.uname);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                warning_noti(responseData.message, responseData.uname);
                            }
                        },
                        error: function() {
                            error_noti("Failed to update password.");
                        },
                        complete: function() {
                            $("#spinner-div").hide();
                        }
                    });
                } else {
                    info_noti("All fields are required.");
                }

                return false; // Prevent the form from submitting normally
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#updateu_pic').submit(function(e) {
                e.preventDefault();
                $("#spinner-div").show();
                var formData = new FormData(this);

                if (formData.get('u_pic').name == null) {
                    info_noti("Please select an image.");
                    $("#spinner-div").hide();
                    return false;
                }

                $.ajax({
                    url: "action/update_profile_pic.php",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var responseData = JSON.parse(data);
                        if (responseData.valid == 1) {
                            success_noti(responseData.message, responseData.uname);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            warning_noti(responseData.message, responseData.uname);
                        }
                    },
                    error: function() {
                        error_noti("Failed to update profile picture.");
                    },
                    complete: function() {
                        $("#spinner-div").hide();
                    }
                });

                return false; // Prevent the form from submitting normally
            });
        });
    </script>



</body>

</html>