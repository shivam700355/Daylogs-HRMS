<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php include 'action/class/count-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$count = new Count();
$user = $listing->active_user_list($_SESSION["cid"]);
$employee = $listing->active_user_list($_SESSION["cid"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Leave</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../app-assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../app-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../app-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../app-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../app-assets/dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../app-assets/icons/fav.png">

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
                        <h3 class="card-title">Leave Report</h3>
                        <div class="card-tools">
                            <a data-toggle="modal" data-target="#add_request"
                                class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-plus"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Name</th>
                                                <th>Casual Leave</th>
                                                <th>Sick Leave</th>
                                                <th>Short Leave</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while ($row = $user->fetch(PDO::FETCH_ASSOC)) {
                                                $i++;
                                                $active = $row['u_status'];
                                                $id = $row['u_id'];

                                                // leave count
                                                $cl_count = $count->casual_leave_count($id);
                                                $sl_count = $count->sick_leave_count($id);
                                                $shl_count = $count->short_leave_count($id);

                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['u_name']; ?></td>
                                                    <td><?php echo $cl_count; ?></td>
                                                    <td><?php echo $sl_count; ?></td>
                                                    <td><?php echo $shl_count; ?></td>

                                                    <td>
                                                        <a href="user_dashboard?id=<?php echo $row['u_id']; ?>"
                                                            target="_blank" class="btn btn-tbl-edit btn-xs btn-primary">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>


                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal fade" id="add_request" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Request</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="req_form">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company</label>
                                                        <input type="text" class="form-control" id="cname" name="cname"
                                                            placeholder="Enter Company Name"
                                                            value="<?php echo htmlspecialchars($_SESSION["cname"]); ?>"
                                                            required disabled>
                                                    </div>
                                                    <!-- <input type="hidden" id="c_id" name="c_id" value="<?php echo htmlspecialchars($_SESSION["cid"]); ?>"> -->
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="u_id">Employee Name</label>
                                                        <select class="form-control" name="u_id" id="u_id"
                                                            style="width: 100%;" required>
                                                            <option selected hidden disabled>Select Employee</option>
                                                            <?php while ($row = $employee->fetch(PDO::FETCH_ASSOC)) { ?>
                                                                <option value="<?php echo $row['u_id']; ?>">
                                                                    <?php echo $row['u_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="r_type">Request Type</label>
                                                        <select class="form-control" name="r_type" id="r_type"
                                                            style="width: 100%;" required>
                                                            <option selected hidden disabled>Select Type</option>
                                                            <option value="Casual Leave">Casual Leave</option>
                                                            <option value="Sick Leave">Sick Leave</option>
                                                            <option value="Short Leave">Short Leave</option>
                                                            <option value="Attendance Log">Attendance Log</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="r_date">Request Date</label>
                                                        <input type="date" class="form-control" id="r_date"
                                                            name="r_date" placeholder="Select Date" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="r_title">Request Title</label>
                                                        <input type="text" class="form-control" id="r_title"
                                                            name="r_title" placeholder="Enter Request Title" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="r_desc">Message</label>
                                                        <textarea class="form-control" rows="3" id="r_desc"
                                                            name="r_desc" placeholder="Enter Description"
                                                            required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-5"></div>
                                                <div class="col-md-2">
                                                    <button type="submit"
                                                        class="btn bg-gradient-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer">

                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
    <!-- DataTables  & Plugins -->
    <script src="../app-assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../app-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../app-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../app-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../app-assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../app-assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../app-assets/plugins/jszip/jszip.min.js"></script>
    <script src="../app-assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../app-assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../app-assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../app-assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../app-assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#req_form')[0].reset();
            $(document).on('submit', '#req_form', function (e) {
                e.preventDefault();
                $("#spinner-div").show();

                if ($('#r_desc').val().trim() !== '') {
                    $.ajax({
                        url: "action/add_request",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            var response = jQuery.parseJSON(data);
                            if (response.valid == 1) {
                                success_noti(response.message, response.uname);
                                setTimeout(function () {
                                    location.href = 'leave';
                                }, 1000);
                            } else {
                                warning_noti(response.message, response.uname);
                            }
                        },
                        error: function () {
                            warning_noti('Error processing request. Please try again.');
                        }
                    });
                } else {
                    info_noti("Description can't be empty.");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            });
        });
    </script>

</body>

</html>