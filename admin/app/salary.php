<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();

$start_date = $_GET['start_date'] ?? "";
$end_date = $_GET['end_date'] ?? "";
$twd = $_GET['twd'] ?? "";

// Check if start_date and end_date are present in the URL parameters
if ($start_date && $end_date) {
    
    $start_date_obj = new DateTime($start_date);
    $end_date_obj = new DateTime($end_date);

    // Calculate the difference between two dates
    $interval = $start_date_obj->diff($end_date_obj);

    // Get the difference in days
    $days_difference = $interval->days + 1;
}

// Assign employee based on condition
$employee = ($start_date && $end_date) ? $listing->active_user_list($_SESSION['cid']) : $listing->active_user_list($_SESSION['cid']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Salary</title>

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
                        <?php if (isset($_GET['start_date']) && isset($_GET['end_date'])) : ?>
                            <h3 class="card-title">Salary Report
                                (<strong><?php echo isset($start_date) && isset($end_date) ? $start_date . ' to ' . $end_date : '<strong>' . date('F Y') . '</strong>'; ?></strong>)
                            </h3>
                        <?php else : ?>
                            <h3 class="card-title">Salary Report</h3>
                        <?php endif; ?>


                        <div class="card-tools">
                            <div class="card-tools">
                                <a href="#" class="btn btn-tbl-edit btn-xs btn-primary" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter"></i></a>
                            </div>
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
                                                <th>CTC</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Total Days</th>
                                                <th>Week of Day</th>
                                                <th>Checkin Days</th>
                                                <th>Salary</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while ($row = $employee->fetch(PDO::FETCH_ASSOC)) {
                                                $i++;

                                                $checkin_days = $listing->get_checkin_count_between_date($row['u_id'], $start_date, $end_date) ?? 0;

                                                $calculated_salary = ($days_difference > 0 && $checkin_days > 0) ? ($row['u_salary'] / $days_difference) *($twd+$checkin_days) : 0;

                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['u_name']; ?></td>
                                                    <td>₹ <?php echo number_format($row['u_salary'],2); ?></td>

                                                    <td><?php echo $start_date; ?></td>

                                                    <td><?php echo $end_date ?></td>
                                                    <td><?php echo $days_difference; ?></td>
                                                    <td><?php echo $twd; ?></td>
                                                    <td><?php echo $checkin_days; ?></td>

                                                    <td> ₹<?php echo number_format($calculated_salary, 2); ?></td>
                                                    <td>
                                                        <a href="print?name=<?php echo urlencode($row['u_name']); ?>&salary=<?php echo $row['u_salary']; ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>&days_difference=<?php echo $days_difference; ?>&checkin_days=<?php echo $checkin_days; ?>&calculated_salary=<?php echo $calculated_salary; ?>" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Attendance Report</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="filterForm">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="start_date">Start Date</label>
                                                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="end_date">End Date</label>
                                                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="total_w_d">Week of Days</label>
                                                                <input type="text" class="form-control" id="total_w_d"
                                                                    name="total_w_d" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="submit" class="btn btn-primary">View
                                                    </button>
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


    <script>
        $(document).ready(function() {
            $('#filterForm').submit(function(e) {
                e.preventDefault();

                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                var total_w_d = $('#total_w_d').val();


                // AJAX request to filter attendance data
                $.ajax({
                    url: 'attendance', // Replace with the URL of the PHP file handling the filter
                    type: 'POST', // Change method to POST
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                        total_w_d: total_w_d

                    },
                    success: function(data) {
                        // Reload the page with filtered data
                        //location.reload();
                        window.location.href = 'salary?start_date=' + start_date + '&end_date=' + end_date+ '&twd=' + total_w_d;
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>


    <script>
        document.getElementById('start_date').addEventListener('change', function() {
            // Get selected start date
            var startDate = this.value;

            // Set minimum date of end date input to selected start date
            document.getElementById('end_date').min = startDate;
        });
    </script>


</body>

</html>