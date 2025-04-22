<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$user = $listing->active_user_list($_SESSION["cid"]);
$active_user = $listing->active_user_list($_SESSION["cid"]);

?>

<?php
// Assuming $listing is an instance of the class containing the current_month_attendance() function

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Get the number of days in the current month
$numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// Generate an array of day names
$dayNames = array();
for ($day = 1; $day <= $numDays; $day++) {
    $dayNames[] = $day;
}

// Display the table headers
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Attendance</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                        <h3 class="card-title">Attendance
                            (<strong><?php echo '<strong>' . date('F Y') . '</strong>'; ?></strong>)</h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tbl-edit btn-xs btn-primary" data-toggle="modal" data-target="#updatattendance"><i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                            <a href="attendance_report" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-filter" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body">
                                    <div class="table-responsive"> <!-- Add this div for responsiveness -->
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S.N</th>
                                                    <th>Name</th>
                                                    <?php foreach ($dayNames as $day) : ?>
                                                        <th><?php echo $day . ' ' . date('M'); ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                while ($row = $active_user->fetch(PDO::FETCH_ASSOC)) {
                                                    $i++;
                                                    $id = $row['u_id'];

                                                    // Get current month's attendance for the user
                                                    $attendance = $listing->current_month_attendance($id);

                                                    // Initialize an array to store attendance information for each day
                                                    $attendanceInfo = array();
                                                    foreach ($attendance as $att) {
                                                        // Extract day from the checkin_date
                                                        $day = date('d', strtotime($att['checkin_date']));
                                                        // Mark present if attendance is marked for the date
                                                        $attendanceInfo[$day] = 'Present';
                                                    }

                                                    // Get the current month and year
                                                    $currentMonth = date('m');
                                                    $currentYear = date('Y');

                                                    // Get the number of days in the current month
                                                    $numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $row['u_name']; ?></td>
                                                        <?php
                                                        // Iterate over each day of the month
                                                        for ($day = 1; $day <= $numDays; $day++) {
                                                            // Format the day to match the database date format
                                                            $formattedDay = str_pad($day, 2, '0', STR_PAD_LEFT); // Ensure leading zero if necessary
                                                            $date = $currentYear . '-' . $currentMonth . '-' . $formattedDay;

                                                            // Check if the date is in the future
                                                            if (strtotime($date) > strtotime(date('Y-m-d'))) {
                                                                echo "<td>--</td>"; // Mark future dates as --
                                                            } else {
                                                                // Check if attendance is marked for the date
                                                                if (isset($attendanceInfo[$formattedDay])) {
                                                                    // Mark present as bold with green circle
                                                                    echo "<td><span style='font-weight: bold; display: inline-block; width: 20px; height: 20px; border-radius: 5px; text-align: center; line-height: 20px; color: #4CAF50;'>P</span></td>";
                                                                } else {
                                                                    // Mark absent as bold with red circle
                                                                    echo "<td><span style='font-weight: bold; display: inline-block; width: 20px; height: 20px; border-radius: 5px; text-align: center; line-height: 20px; color: red;'>A</span></td>";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </section>
            <div class="modal fade" id="updatattendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mark Attendance</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="attendanceUpdate">
                                <div class="form-group">
                                    <label for="u_id">Employee Name</label>
                                    <select class="form-control" id="u_id" name="u_id">
                                        <option value="" selected hidden disabled>Select Employee</option>
                                        <?php while ($row = $user->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['u_id'] ?>"><?php echo $row['u_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="checkin_date">Date</label>
                                        <input type="date" class="form-control" id="checkin_date" name="checkin_date" value="<?php echo date('Y-m-d'); ?>" required max="<?php echo date('Y-m-d', strtotime('+0 days')); ?>">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="checkin_time">Time</label>
                                        <input type="time" class="form-control" id="checkin_time" name="checkin_time" step="1" required>
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-center">

                                    <button type="submit" class="btn btn-primary">Mark Attendance</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

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
    <!-- script for post request -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {
            $('#attendanceUpdate')[0].reset();
            $(document).on('submit', '#attendanceUpdate', function(e) {
                e.preventDefault();
                $("#spinner-div").show();
                var u_id = $('#u_id').val();
                var date = $('#checkin_date').val();
                var time = $('#checkin_time').val();
                if (u_id != '') {
                    // Add u_id to the form data
                    var formData = new FormData(this);
                    formData.append('u_id', u_id);

                    $.ajax({
                        url: "action/update_attendance.php",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            var data = jQuery.parseJSON(data);
                            $('#updatattendance').modal('hide');
                            if (data.valid == 1) {
                                success_noti(data.message);
                                setTimeout(function() {

                                    location.href = 'attendance';
                                }, 1000);
                            } else {
                                warning_noti(data.message);
                            }
                        }
                    });
                } else {
                    info_noti("Name can't be empty.");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            });
        });
    </script>

    <script>
        $(function() {
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

</body>

</html>