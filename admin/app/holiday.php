<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
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
            <h3 class="card-title">Holiday List</h3>
            <div class="card-tools">
              <div class="card-tools">
                <a href="#" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></a>
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
                        <th>Type</th>
                        <th>Leave Day</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      while ($row = $user->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        $active = $row['status'];
                        $id = $row['id'];
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['h_name']; ?></td>
                          <td><?php echo date("d M y, D", strtotime($row['h_date'])); ?></td>
                          <td><?php echo $row['h_type']; ?></td>
                          <td><?php echo $row['h_leaves']; ?></td>

                          <td>
                            <label class="switch">
                              <?php $activeText = ($active == 0) ? "" : "checked"; ?>
                              <input type="checkbox" <?php echo $activeText; ?> class="active" id='<?php echo $id . '_' . $active ?>'>
                              <span class="slider"></span>
                            </label>
                          </td>

                          <td>
                            <a href="#" class="btn btn-tbl-edit btn-xs btn-primary">
                              <i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-tbl-edit btn-xs btn-primary">
                              <i class="fa fa-eye"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>
                </div>
              </div>


              <div class="col-12">

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Holiday</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="holiday_form">
                          <div class="row">
                            <div class="mb-3 col-md-12">
                              <label for="h_name" class="form-label">Holiday Name</label>
                              <input type="text" class="form-control" id="h_name" name="h_name" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="h_date" class="form-label">Holiday Date</label>
                              <input type="date" class="form-control" id="h_date" name="h_date" required>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="h_leaves" class="form-label">Holiday Leaves</label>
                              <input type="number" class="form-control" id="h_leaves" name="h_leaves" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="mb-3 col-md-12">
                              <label for="h_type" class="form-label">Holiday Type</label>
                              <select class="form-control" id="h_type" name="h_type" required>
                                <option value="Holiday">Holiday</option>
                                <option value="Restricted Holiday">Restricted Holiday</option>
                              </select>
                            </div>
                          </div>

                          <div class="row">
                            <div class="mb-3 col-md-12">
                              <label for="h_desc" class="form-label">Holiday Description</label>
                              <textarea class="form-control" id="h_desc" name="h_desc" rows="3" required></textarea>
                            </div>
                          </div>

                          <div class="modal-footer d-flex justify-content-center">
                            
                            <button type="submit" class="btn btn-primary">Add</button>
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


  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      $('#holiday_form')[0].reset();
      $(document).on('submit', '#holiday_form', function(e) {
        e.preventDefault();
        $("#spinner-div").show();
        var h_name = $('#h_name').val();
        var h_date = $('#h_date').val();
        var h_leaves = $('#h_leaves').val();
        var h_type = $('#h_type').val();
        var h_desc = $('#h_desc').val();

        if (h_name != '' && h_date != '' && h_leaves != '' && h_type != '' && h_desc != '') {
          $.ajax({
            url: "action/add_holiday",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
              var data = jQuery.parseJSON(data);
              if (data.valid == 1) {
                success_noti(data.message, data.uname);
                setTimeout(function() {
                  location.href = 'holiday';
                }, 1000);
                return false;
              } else {
                warning_noti(data.message, data.uname);
                return false;
              }
            }
          });
        } else {
          info_noti("All fields are required.");
          setTimeout(function() {
            location.reload();
          }, 1000);
          return false;
        }
      });
    });
  </script>

</body>

</html>