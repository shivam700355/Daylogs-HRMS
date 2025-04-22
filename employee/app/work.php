<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>

<?php
$listing = new Listing();
$work = $listing->work_report($_SESSION['u_id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | Work</title>

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
            <h3 class="card-title">Work</h3>
            <div class="card-tools">
              <a data-toggle="modal" data-target="#addWorkMpdal" class="btn btn-tbl-edit btn-xs btn-primary"><i
                  class="fa fa-plus"></i></a>
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
                        <th>Date</th>
                        <th>Day</th>
                        <th>Work</th>
                        <th>Added On</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      while ($row = $work->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo date('j M, y', strtotime($row['w_date'])); ?></td>
                          <td><?php echo date('l', strtotime($row['w_date'])); ?></td>
                          <td>
                            <?php echo str_word_count($row['w_desc']) > 15 ? implode(' ', array_slice(explode(' ', $row['w_desc']), 0, 15)) . '......' : $row['w_desc']; ?>
                          </td>
                          <td><?php echo date('d-m-Y h:i A', strtotime($row['created_at'])); ?></td>
                          <td>
                            <a href="#" class="btn btn-tbl-edit btn-xs btn-primary"
                              onclick="showWork('<?php echo date('j F, Y l', strtotime($row['w_date'])); ?>','<?php echo str_replace("\n", "  ", addslashes($row['w_desc'])); ?>')">
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
        </div>
      </section>

      <div class="modal fade" id="addWorkMpdal" tabindex="-1" role="dialog" aria-labelledby="addWorkMpdalLable"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addWorkMpdalLable">Work Report</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="workreport">
                <input type="hidden" name="u_id" id="u_id" value="<?php echo $_SESSION['u_id']; ?>">
                <div class="form-group">
                  <label for="w_date">Work Date</label>
                  <input type="date" class="form-control" id="w_date" name="w_date" value="<?php echo date('Y-m-d'); ?>"
                    required min="<?php echo date('Y-m-d', strtotime('-2 days')); ?>"
                    max="<?php echo date('Y-m-d', strtotime('+2 days')); ?>">
                </div>
                <div class="form-group" id="doc_number_group">
                  <label for="w_desc">Remark</label>
                  <textarea class="form-control" id="w_desc" name="w_desc" rows="6" required></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="workModal" tabindex="-1" role="dialog" aria-labelledby="workModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="workModalLabel">Work Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="workModalBody"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>


    <?php include 'app_include/app_footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>

  </div>



  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var today = new Date();
      var twoDaysBefore = new Date(today);
      twoDaysBefore.setDate(today.getDate() - 2);
      var twoDaysAfter = new Date(today);


      var minDate = twoDaysBefore.toISOString().split('T')[0];
      var maxDate = twoDaysAfter.toISOString().split('T')[0];

      var dateInput = document.getElementById('w_date');
      dateInput.min = minDate;
      dateInput.max = maxDate;
      dateInput.disabled = false;
    });
  </script>


  <script>
    function showWork(date, description) {
      description = description.replace(/\n/g, '<br>'); // Replace newlines with <br> for display in HTML
      var modalContent = document.getElementById("workModalBody");
      modalContent.innerHTML = `
        <form>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="date">Date:</label>
                    <input type="text" class="form-control" id="date" value="${date}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" rows="4" disabled style="white-space: pre-line;">${description}</textarea>
            </div>
        </form>
    `;
      $('#workModal').modal('show');
    }

  </script>
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
    $(document).ready(function () {
      $(document).on('submit', '#workreport', function (e) {
        e.preventDefault();
        $("#spinner-div").show();
        var formData = {
          u_id: $("#u_id").val(),
          w_date: $("#w_date").val(),
          w_desc: $("#w_desc").val()
        };
        $.ajax({
          url: 'action/work_report.php',
          type: 'POST',
          data: formData,
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
            warning_noti('Error submitting work report.');
          },
          complete: function () {
            $("#spinner-div").hide();
          }
        });
      });
    });
  </script>

</body>

</html>