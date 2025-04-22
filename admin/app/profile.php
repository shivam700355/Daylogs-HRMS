<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>

<?php
$listing = new Listing();
$profile = $listing->user_profile($_SESSION["u_id"]);
$u_id = $_SESSION['u_id'];
$row = $profile->fetch(PDO::FETCH_ASSOC);
$imagename = $row['u_pic'];

$activity = $listing->user_activity($_SESSION["u_id"]);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Profile </title>
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
                    <div class="card-header">
                        <h5 class="card-title">Profile</h5>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-12 p-3">
                            <div class="card">
                                <div class="card-header">Update Profile Image</div>
                                <div class="card-body text-center justify-content-center">
                                    <div class="container">
                                        <div class="row mt-2">
                                            <div class="profile-pic">
                                                <img src="../app-assets/images/profile/<?php echo $imagename ?>"
                                                    id="output" width="200" height="200" style="border-radius: 50%;" />
                                            </div>
                                        </div>
                                        <form id="updateu_pic" enctype="multipart/form-data">

                                            <div class="row mt-2">
                                                <input id="u_pic" type="file" name="u_pic" class="form-control"
                                                    onchange="loadFile(event)" />
                                            </div>
                                            <div class="row  mt-2">
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-12 p-3">
                            <div class="card">
                                <h5 class="card-title text-center mt-2">Password Reset</h5>
                                <hr>
                                <div class="card-body">

                                    <form id="resetPasswordForm">
                                        <div class="form-group">
                                            <label for="oldPassword">Old Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="oldPassword"
                                                    name="oldPassword" required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="toggleOldPassword">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassword">New Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="newPassword"
                                                    name="newPassword" required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="toggleNewPassword">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmNewPassword">Confirm New Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="confirmNewPassword"
                                                    name="confirmNewPassword" required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    id="toggleConfirmNewPassword">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Reset Password</button>
                                    </form>
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
        var loadFile = function (event) {
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
        document.getElementById("toggleOldPassword").addEventListener("click", function () {
            togglePasswordVisibility("oldPassword", "toggleOldPassword");
        });
        document.getElementById("toggleNewPassword").addEventListener("click", function () {
            togglePasswordVisibility("newPassword", "toggleNewPassword");
        });
        document.getElementById("toggleConfirmNewPassword").addEventListener("click", function () {
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
        $(document).ready(function () {
            $('#resetPasswordForm').submit(function (e) {
                e.preventDefault();
                $("#spinner-div").show();
                var oldPassword = $('#oldPassword').val();
                var newPassword = $('#newPassword').val();
                var confirmNewPassword = $('#confirmNewPassword').val();

                if (oldPassword !== '' && newPassword !== '' && confirmNewPassword !== '') {
                    if (newPassword !== confirmNewPassword) {
                        warning_noti("New password and confirm new password do not match.");
                        $("#spinner-div").hide();
                        return false;
                    }
                    $.ajax({
                        url: "action/update_password.php",
                        method: 'POST',
                        data: {
                            oldPassword: oldPassword,
                            newPassword: newPassword,
                            confirmNewPassword: confirmNewPassword
                        },
                        success: function (data) {
                            try {
                                var responseData = JSON.parse(data);
                                if (responseData.valid == 1) {
                                    success_noti(responseData.message, responseData.uname);
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    warning_noti(responseData.message, responseData.uname);
                                }
                            } catch (error) {
                                console.error("Error parsing JSON:", error);
                                warning_noti("Failed to update password.");
                            } finally {
                                $("#spinner-div").hide();
                            }
                        },
                        error: function () {
                            warning_noti("Failed to update password.");
                            $("#spinner-div").hide();
                        }
                    });
                } else {
                    warning_noti("All fields are required.");
                    $("#spinner-div").hide();
                }

                return false;
            });
        });
    </script>








    <script type="text/javascript">
        $(document).ready(function () {
            $('#updateu_pic').submit(function (e) {
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
                        error_noti("Failed to update profile picture.");
                    },
                    complete: function () {
                        $("#spinner-div").hide();
                    }
                });

                return false; // Prevent the form from submitting normally
            });
        });
    </script>



</body>

</html>