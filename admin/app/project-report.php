<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>

<?php
$listing = new Listing();
$project_detail = $listing->project_details($_GET['id']);
$project = $listing->project_report($_GET['id']);

$pd = $project_detail->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | Project Report</title>

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
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

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
            <h3 class="card-title"><?php echo $pd['name']; ?> Report</h3>
            <div class="card-tools">
              <a data-toggle="modal" data-target="#projectreport" class="btn btn-tbl-edit btn-xs btn-primary"><i
                  class="fa fa-plus"></i></a>
              <a data-toggle="modal" data-target="#assignproject" class="btn btn-tbl-edit btn-xs btn-primary"><i
                  class="fa fa-user-plus"></i></a>
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
                        <th>Remark</th>
                        <th>Added By</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      while ($row = $project->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo date('j M, y  D', strtotime($row['p_date'])); ?></td>
                          <td><?php echo $row['remark']; ?></td>
                          <td><?php echo $row['u_name']; ?></td>
                          <td>
                            <a href="#" class="btn btn-tbl-edit btn-xs btn-primary"
                              onclick="showWork('<?php echo date('j F, Y l', strtotime($row['p_date'])); ?>','<?php echo str_replace("\n", "  ", addslashes($row['remark'])); ?>','<?php echo $row['u_name']; ?>')">
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
      <div class="modal fade" id="projectreport" tabindex="-1" role="dialog" aria-labelledby="projectreportMpdalLable"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="projectreportMpdalLable">Project Report</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="projectform">
                <input type="hidden" name="p_id" id="p_id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name="u_id" id="u_id" value="<?php echo $_SESSION['u_id'] ?>">
                <div class="form-group">
                  <label for="p_date">Project Date</label>
                  <input type="date" class="form-control" id="p_date" name="p_date" value="<?php echo date('Y-m-d'); ?>"
                    required min="<?php echo date('Y-m-d', strtotime('-7 days')); ?>"
                    max="<?php echo date('Y-m-d', strtotime('+0 days')); ?>">
                </div>
                <div class="form-group" id="doc_number_group">
                  <label for="remark">Remark</label>
                  <textarea class="form-control" id="remark" name="remark" rows="6" required></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              <div id="spinner-div" style="display:none;"> <!-- Add a hidden div for the spinner -->
                <i class="fa fa-spinner fa-spin"></i> Loading...
              </div>
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

      <div class="col-12">

        <div class="modal fade" id="assignproject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="assign_form">
                  <div class="row">

                    <div class="mb-3 col-md-12">
                      <label for="p_id" class="form-label">Project ID</label>
                      <input type="text" class="form-control" id="p_id" name="p_id" value="<?php echo $pd['id']; ?>"
                        readonly>
                    </div>
                    <div class="mb-3 col-md-12">
                      <label for="project_name" class="form-label">Project Name</label>
                      <input type="text" class="form-control" id="project_name" name="project_name"
                        value="<?php echo $pd['name']; ?>" readonly>
                    </div>
                    <div class="mb-3 col-md-12">
                      <label for="u_id" class="form-label">Employee Name</label>
                      <select class="form-control" name="u_id[]" id="u_id" multiple
                        aria-label="multiple select example">
                        <?php
                        $user = $listing->get_unassigned_project_employee($_SESSION["cid"], "2");
                        while ($row = $user->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $row['u_id']; ?>"><?php echo $row['u_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3 col-md-12">
                      <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                  </div>
                </form>
              </div>
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
  <!-- Toastr -->
  <script src="../app-assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>

  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

  <script src="toast.js"></script>
  <script>
    $(document).ready(function () {
      $('#u_id').multiselect({
        alert('iii');
        nonSelectedText: 'Select Employee',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '400px'
      });

    });
  </script>
  
  <script>
    function showWork(date, description, u_name) {
      description = description.replace(/\n/g, '<br>'); // Replace newlines with <br> for display in HTML
      var modalContent = document.getElementById("workModalBody");
      modalContent.innerHTML = `
        <form>
          <div class="form-row">
          <div class="form-group col-md-12">
              <label for="text">Employee Name</label>
              <input type="text" class="form-control" id="name" value="${u_name}" disabled>
            </div>
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

  <script>
    $(document).ready(function () {
      $(document).on('submit', '#projectform', function (e) {
        e.preventDefault();
        $("#spinner-div").show();
        var formData = {
          p_id: $("#p_id").val(),
          u_id: $("#u_id").val(),
          p_date: $("#p_date").val(),
          remark: $("#remark").val()
        };
        console.log(formData);
        $.ajax({
          url: 'action/add_project_report.php',
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
            $('#projectreport')[0].reset(); // Reset the form
          }
        });
      });
    });
  </script>
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

 
  <script type="text/javascript" language="javascript">
    $(document).ready(function () {
      $('#assign_form')[0].reset();
      $(document).on('submit', '#assign_form', function (e) {
        e.preventDefault();
        $("#spinner-div").show();
        var added_by = $('#added_by').val();
        var p_id = $('#p_id').val();
        var u_id = $('#u_id').val();
        if (added_by != '' && p_id != '' && u_id.length > 0) {
          console.log(u_id, p_id);

          $.ajax({
            url: "action/assign_project",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
              var data = jQuery.parseJSON(data);
              if (data.valid == 1) {
                success_noti(data.message, data.uname);
                setTimeout(function () {
                  location.href = 'project';
                }, 1000);
              } else {
                warning_noti(data.message, data.uname);
              }
            }
          });
        }
      });
    });
  </script>

</body>

</html>