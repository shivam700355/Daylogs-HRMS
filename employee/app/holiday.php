<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php include 'action/class/operations-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$user = $listing->holiday($_SESSION["cid"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | Holiday List</title>

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
            <h3 class="card-title">Holiday List</h3>
            <div class="card-tools">
              <div class="card-tools">
                <!-- <a href="#" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary" data-toggle="modal"
                  data-target="#"><i class="fa fa-plus"></i></a> -->
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
                        <th>Holiday</th>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Leave Days</th>
                        <th>Type</th>
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
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['h_name']; ?></td>
                          <td><?php echo date('j M, y', strtotime($row['h_date'])); ?></td>
                          <td><?php echo date('l', strtotime($row['h_date'])); ?></td>
                          <td><?php echo $row['h_leaves']; ?></td>
                          <td <?php if ($row['h_type'] == 'Restricted Holiday')
                            echo 'style=" color: red;"'; ?>>
                            <?php echo $row['h_type']; ?>
                          </td>
                          <td><a href="#" class="btn btn-tbl-edit btn-xs btn-primary"
                              onclick="showHoliday('<?php echo $row['h_name']; ?>','<?php echo date('j F, Y', strtotime($row['h_date'])); ?>','<?php echo date('l', strtotime($row['h_date'])); ?>','<?php echo $row['h_leaves']; ?>','<?php echo $row['h_desc']; ?>')"><i
                                class="fa fa-eye"></i></a></td>
                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="modal fade" id="holidayModal" tabindex="-1" role="dialog" aria-labelledby="holidayModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="holidayModalLabel">Holiday Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="holidayModalBody">
                <!-- Content will be dynamically added here -->
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
    function showHoliday(name, date, day, leaves, h_desc) {
      document.getElementById('holidayModalLabel').innerText = name;
      var modalContent = document.getElementById("holidayModalBody");
      modalContent.innerHTML = `
        <form>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="holidayDate">Date:</label>
                    <input type="text" class="form-control" id="holidayDate" value="${date}" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="holidayDay">Day:</label>
                    <input type="text" class="form-control" id="holidayDay" value="${day}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="holidayLeaves">Leaves:</label>
                <input type="text" class="form-control" id="holidayLeaves" value="${leaves}" disabled>
            </div>
            <div class="form-group">
    <label for="holidayDescription">Holiday Description:</label>
    <textarea class="form-control" id="holidayDescription" rows="3" disabled>${h_desc}</textarea>
</div>
        </form>
    `;

      $('#holidayModal').modal('show'); // Show the modal using jQuery
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

</body>

</html>