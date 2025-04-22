<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$user = $listing->employee_list($_SESSION['cid']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | Team</title>

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
            <h3 class="card-title">Team Members</h3>
            <div class="card-tools">
              <a href="#" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-plus"></i></a>
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
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>District</th>
                        <th>Designation</th>
                        <th>Rating</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      while ($row = $user->fetch(PDO::FETCH_ASSOC)) {
                        $i++;

                        $id = $row['u_id'];

                        $avg_rating = $listing->employee_rating($id);
                        $rating = number_format($avg_rating['rating'], 2, '.', '') ?? "N/A";


                      ?>
                        <tr>

                          <td><?php echo $i; ?></td>
                          <td><img src="https://daylogs.in/employee/app-assets/images/profile/<?php echo $row['u_pic']; ?>" alt="<?= $row['u_pic']; ?>" style="height: 30px;width: 30px; border-radius: 50%;""></td>
                          <td><?php echo $row['u_name']; ?></td>
                          <td><?php echo $row['u_email']; ?></td>
                          <td><?php echo '+91 xxxxxxxx' . substr($row['u_mobile'], -2); ?></td>
                          <td><?php echo $row['u_district']; ?></td>
                          <td><?php echo $row['u_designation']; ?></td>
                          <td><?php echo $rating; ?></td>
                          <td>
                            <?php if ($row['u_id'] != $_SESSION['u_id']) { ?>
                              <a onclick="setUserId(<?php echo $row['u_id']; ?>, '<?php echo $row['u_name']; ?>')" data-toggle="modal" data-target="#reviewmodal" class="btn btn-tbl-edit btn-xs btn-primary">
                                <i class="fa fa-star" aria-hidden="true"></i>
                              </a>
                            <?php } else { ?>
                              <a class="btn btn-tbl-edit btn-xs btn-primary disabled">
                                <i class="fa fa-star" aria-hidden="true"></i>
                              </a>
                            <?php } ?>
                            <a href="#" class="btn btn-tbl-edit btn-xs btn-primary" onclick="showEmployeeModal('<?php echo htmlentities(json_encode($row)); ?>')">
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
        <div class="modal fade" id="reviewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="requestModalLabel">Review & Rating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="reviewform">
                  <input type="hidden" id="u_id" name="u_id" value="">
                  <div class="mb-3">
                    <label for="name" class="form-group">Name</label>
                    <input type="text" class="form-control" id="name" value="" disabled>
                  </div>
                  <div class="mb-3">
                    <label for="rating" class="form-group">Rating</label>
                    <select name="rating" id="rating" class="form-control">
                      <option value="1">⭐</option>
                      <option value="2">⭐⭐</option>
                      <option value="3">⭐⭐⭐</option>
                      <option value="4">⭐⭐⭐⭐</option>
                      <option value="5">⭐⭐⭐⭐⭐</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="review" class="form-group">Remark</label>
                    <textarea name="review" id="review" rows="5" cols="50" class="form-control"></textarea>
                  </div>
                  <div class="modal-footer justify-content-center">
                  <button type="button" id="submitReview" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Employee Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Employee details will be displayed here -->
                <form id="employeeDetailsForm">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="empName">Name:</label>
                        <input type="text" class="form-control" id="empName" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="empEmail">Email:</label>
                        <input type="email" class="form-control" id="empEmail" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="empMobile">Mobile:</label>
                        <input type="text" class="form-control" id="empMobile" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="empDistrict">District:</label>
                        <input type="text" class="form-control" id="empDistrict" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="empState">State:</label>
                        <input type="text" class="form-control" id="empState" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="empDesignation">Designation:</label>
                        <input type="text" class="form-control" id="empDesignation" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="empDoj">Date of Joining:</label>
                        <input type="text" class="form-control" id="empDoj" disabled>
                      </div>
                    </div>
                  </div>
                </form>

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
    function setUserId(userId, name) {
      document.getElementById('u_id').value = userId;
      document.getElementById('name').value = name;

    }
  </script>
  <script>
    function showEmployeeModal(employee) {
      employee = JSON.parse(employee);
      document.getElementById('empName').value = employee.u_name;
      document.getElementById('empEmail').value = employee.u_email;
      document.getElementById('empMobile').value = "+91 xxxxxxxx" + employee.u_mobile.slice(-2);
      document.getElementById('empDistrict').value = employee.u_district;
      document.getElementById('empState').value = employee.u_state;
      document.getElementById('empDesignation').value = employee.u_designation;
      document.getElementById('empDoj').value = employee.u_doj;
      $('#employeeModal').modal('show');
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
      $('#submitReview').click(function() {
        var u_id = $('#u_id').val();
        var rating = $('#rating').val();
        var review = $('#review').val();
        $.ajax({
          url: 'action/submit_review.php',
          type: 'post',
          data: {
            u_id: u_id,
            rating: rating,
            review: review,
          },
          success: function(data) {
            console.log('Received data:', data); // Log the received data
            try {
              var responseData = JSON.parse(data);
              if (responseData.valid == 1) {
                success_noti(responseData.message);
                setTimeout(function() {
                  location.reload();
                }, 1000);
                return false;
              } else {
                warning_noti(responseData.message);
                return false;
              }
            } catch (e) {
              console.error('Error parsing JSON:', e);
            }
          }
        });
      });
    });
  </script>
 
  
</body>

</html>