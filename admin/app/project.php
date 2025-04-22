<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php include 'action/class/count-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$count = new Count();
$project = $listing->project($_SESSION["cid"]);
$id = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | Project</title>

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
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
            <h3 class="card-title">Project List</h3>
            <div class="card-tools">
              <div class="card-tools">
                <a href="#" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary" data-toggle="modal" data-target="#addproject"><i class="fa fa-plus"></i></a>
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
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Members</th>
                        <th>Competion</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      while ($row = $project->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        $active = $row['status'];
                        $id = $row['id'];
                        $members = $count->project_memeber_count($id);

                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><img src="https://daylogs.in/admin/app-assets/images/projects/<?php echo $row['image']; ?>" alt="<?= $row['image']; ?>" style="height: 30px;width: 30px; border-radius: 50%;"></td>
                          <td><?php echo $row['abb_name']; ?></td>
                          <td><?php echo date("d M y, D", strtotime($row['s_date'])); ?></td>
                          <td><?php echo date("d M y, D", strtotime($row['e_date'])); ?></td>
                          <td><?php echo $members; ?></td>

                          <td><?php echo $row['completion'] != 0 ? $row['completion'] . '%' : '---'; ?></td>


                          <td>
                            <label class=" switch">
                              <?php $activeText = ($active == 0) ? "" : "checked"; ?>
                              <input type="checkbox" <?php echo $activeText; ?> class="active" id='<?php echo $id . '_' . $active ?>'>
                              <span class="slider"></span>
                            </label>
                          </td>

                          <td>

                            <a href="#" class="btn btn-tbl-edit btn-xs btn-primary" data-toggle="modal" data-target="#assignproject" onclick="assignproject('<?php echo $row['abb_name']; ?>','<?php echo $id ?>');">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href=" project-report?id=<?php echo $row['id']; ?>" class="btn btn-tbl-edit btn-xs btn-primary">
                              <i class="fa fa-eye"></i>
                            </a>

                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>
                </div>
              </div>


              <div class="col-12">

                <div class="modal fade" id="addproject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="project_form" enctype="multipart/form-data">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="p_name" class="form-label">Project Name</label>
                              <input type="text" class="form-control" id="p_name" name="p_name" required>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="ps_name" class="form-label">Project Short Name</label>
                              <input type="text" class="form-control" id="ps_name" name="ps_name" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="s_date" class="form-label">Start Date</label>
                              <input type="date" class="form-control" id="s_date" name="s_date" required>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="e_date" class="form-label">End Date</label>
                              <input type="date" class="form-control" id="e_date" name="e_date" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="mb-3 col-md-12">
                              <label for="h_desc" class="form-label">Project Description</label>
                              <textarea class="form-control" id="h_desc" name="p_desc" rows="3" required></textarea>
                            </div>
                            <div class="mb-3 col-md-12">
                              <label for="file">Choose Logo</label>
                              <input type="file" class="form-control-file" id="file" name="file" accept=".png, .jpg, .jpeg, .pdf">
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
              <div class="col-12">

                <div class="modal fade" id="assignproject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <input type="text" class="form-control" id="p_id" name="p_id" value="" readonly>
                            </div>
                            <div class="mb-3 col-md-12">
                              <label for="project_name" class="form-label">Project Name</label>
                              <input type="text" class="form-control" id="project_name" name="project_name" value="" readonly>
                            </div>
                            <div class="mb-3 col-md-12">
                              <label for="u_id" class="form-label">Employee Name</label>
                              <select class="form-control" name="u_id[]" id="u_id" multiple aria-label="multiple select example">
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

  <!-- AdminLTE App -->
  <script src="../app-assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../app-assets/dist/js/demo.js"></script>
  <!-- Page specific script -->

  <!-- Toastr -->
  <script src="../app-assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
  <script src="toast.js"></script>

  <script>
    $(document).ready(function() {
      $('#u_id').multiselect({
        nonSelectedText: 'Select Employee',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '400px'
      });

    });
  </script>
  <script>
    function assignproject(name, id) {

      console.log(name, id);
      document.getElementById('project_name').value = name;
      document.getElementById('p_id').value = id;


      $('#assignproject').modal('show');
    }
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


  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      $('#project_form')[0].reset();
      $(document).on('submit', '#project_form', function(e) {
        e.preventDefault();
        $("#spinner-div").show();
        var p_name = $('#p_name').val();
        var ps_name = $('#ps_name').val();
        var s_date = $('#s_date').val();
        var e_date = $('#e_date').val();
        var p_desc = $('#h_desc').val();
        var file = $('#file').val();
        if (p_name != '' && ps_name != '' && s_date != '' && e_date != '' && p_desc != '') {

          $.ajax({
            url: "action/add_project", // Make sure this path is correct
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
              var data = jQuery.parseJSON(data);
              if (data.valid == 1) {
                success_noti(data.message, data.uname);
                setTimeout(function() {
                  location.href = 'project';
                }, 1000);
                return false;
              } else {
                warning_noti(data.message, data.uname);
                return false;
              }
            }
          });
        }
      });
    });
  </script>


  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      $('#assign_form')[0].reset();
      $(document).on('submit', '#assign_form', function(e) {
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
            success: function(data) {
              var data = jQuery.parseJSON(data);
              if (data.valid == 1) {
                success_noti(data.message, data.uname);
                setTimeout(function() {
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