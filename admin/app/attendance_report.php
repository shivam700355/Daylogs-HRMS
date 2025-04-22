<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();

// Check if start_date and end_date are present in the URL parameters
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
  $start_date = $_GET['start_date'];
  $end_date = $_GET['end_date'];

  // Call user_attendance_filter function with start_date and end_date parameters
  $attendance = $listing->attendance_filter_all($_SESSION['cid'], $start_date, $end_date);
} else {
  // Default to current month and year
  $currentMonth = date('m');
  $currentYear = date('Y');

  // Call user_current_month_attendance function with current month and year parameters
  $attendance = $listing->current_month_attendance_all($_SESSION['cid'], $currentMonth, $currentYear);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | Attendance</title>

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
            <h3 class="card-title">Attendance
              (<strong><?php echo isset($start_date) && isset($end_date) ? $start_date . ' to ' . $end_date : '<strong>' . date('F Y') . '</strong>'; ?></strong>)
            </h3>

            <div class="card-tools">
              <div class="card-tools">
                <a href="#" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary" data-toggle="modal"
                  data-target="#filterModal"><i class="fa fa-filter"></i></a>
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
                        <th>Date</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Working Hours</th>
                        <th>Break Time</th>
                        <th>Happiness</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      while ($row = $attendance->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        $id = $row['u_id'];
                        $checkout_time = $working_hours = $break_time = '---';

                        $b_time = $listing->get_day_total_break($row["u_id"], $row['checkin_date']);


                        if ($row['checkout_time'] !== "00:00:00") {
                          $checkout_time = date('g:i A', strtotime($row['checkout_time']));
                          $checkin_timestamp = strtotime($row['checkin_time']);
                          $checkout_timestamp = strtotime($row['checkout_time']);
                          $time_diff_seconds = $checkout_timestamp - $checkin_timestamp;
                          $hours = floor($time_diff_seconds / 3600);
                          $minutes = floor(($time_diff_seconds % 3600) / 60);
                          $working_hours = $hours . ":" . str_pad($minutes, 2, '0', STR_PAD_LEFT) . ' Hours';
                        }

                        if ($b_time !== null) {
                          $break_time = $b_time;
                        }

                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['u_name']; ?></td>
                          <td <?php if ($row['logged_by'] > 0)
                            echo 'style="color: red;"'; ?>>
                            <?php echo date('j F, Y', strtotime($row['checkin_date'])); ?>
                          </td>
                          <td id="checkintime" <?php if ($row['logged_by'] > 0)
                            echo 'style="color: red;"'; ?>>
                            <?php echo date('g:i A', strtotime($row['checkin_time'])); ?>
                          </td>
                          <!-- <td><?php echo date('g:i A', strtotime($row['checkout_time'])); ?></td> -->
                          <td><?php echo $checkout_time; ?></td>
                          <td><?php echo $working_hours; ?></td>
                          <td><?php echo $break_time; ?></td>
                          <td><?php echo $row['h_index']; ?></td>
                          <td><a href="#" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="#"
                              onclick="attendancetime('<?php echo $row['id'] ?>','<?php echo $row['u_name'] ?>','<?php echo $row['checkin_time']; ?>')"
                              class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-cog"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>
                </div>
              </div>
              <div class="col-12">
                <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
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
                                <input type="date" class="form-control" id="start_date" name="start_date">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                  max="<?php echo date('Y-m-d'); ?>">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                          <button type="submit" class="btn btn-primary">View Attendance</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-12">
                <div class="modal fade" id="attendanceupdate" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="attendanceUpdate">
                          <input type="hidden" name="a_id" id="a_id" value="">
                          <div class="row">
                            <div class="form-group col-6">
                              <label for="u_id">Employee Name</label>
                              <input type="text" name="e_name" id="e_name" value="" class="form-control" readonly>

                            </div>

                            <div class="form-group col-6">
                              <label for="checkin_time">Time</label>
                              <input type="time" class="form-control" id="checkin_time" value="" name="checkin_time"
                                step="1" required>
                            </div>

                          </div>
                          <div class="modal-footer d-flex justify-content-center">

                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">

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
  <script>
    function attendancetime(id, name, time) {
      $('#e_name').val(name);
      $('#a_id').val(id);
      $('#checkin_time').val(time);
      $('#attendanceupdate').modal('show');
    }
  </script>


  <script type="text/javascript" language="javascript">
    $(document).ready(function () {
      $('#attendanceUpdate')[0].reset();
      $(document).on('submit', '#attendanceUpdate', function (e) {
        e.preventDefault();
        $("#spinner-div").show();
        var u_id = $('#u_id').val();
        var time = $('#checkin_time').val();
        if (u_id != '') {
          var formData = new FormData(this);
          formData.append('u_id', u_id);

          $.ajax({
            url: "action/update_att_time.php",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
              var data = jQuery.parseJSON(data);
              $('#updatattendance').modal('hide');
              if (data.valid == 1) {
                success_noti(data.message);
                setTimeout(function () {

                  location.href = 'attendance_report';
                  $('#checkintime').css('color', 'green');
                }, 1000);
              } else {
                warning_noti(data.message);
              }
            }
          });
        } else {
          info_noti("Name can't be empty.");
          setTimeout(function () {
            location.reload();
          }, 1000);
        }
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('#filterForm').submit(function (e) {
        e.preventDefault();

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        console.log("Start Date: " + start_date);
        console.log("End Date: " + end_date);

        // AJAX request to filter attendance data
        $.ajax({
          url: 'attendance', // Replace with the URL of the PHP file handling the filter
          type: 'POST', // Change method to POST
          data: {
            start_date: start_date,
            end_date: end_date
          },
          success: function (data) {
            // Reload the page with filtered data
            //location.reload();
            window.location.href = 'attendance_report?start_date=' + start_date + '&end_date=' + end_date;
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      });
    });
  </script>

  <script>
    document.getElementById('start_date').addEventListener('change', function () {
      // Get selected start date
      var startDate = this.value;

      // Set minimum date of end date input to selected start date
      document.getElementById('end_date').min = startDate;
    });
  </script>


</body>

</html>