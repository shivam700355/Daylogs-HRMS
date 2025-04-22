<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>

<?php
session_start();
$listing = new Listing();
$state = $listing->state_list();
$role = $listing->role_list();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | User Registration </title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../app-assets/plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../app-assets/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../app-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../app-assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../app-assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../app-assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../app-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../app-assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../app-assets/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../app-assets/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../app-assets/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../app-assets/icons/fav.png">

  <style type="text/css">
    #spinner-div {
      position: fixed;
      display: none;
      width: 100%;
      height: 100%;
      top: 450px;
      right: 0;
      text-align: center;
      background-color: rgba(255, 255, 255, 0.8);

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
            <h3 class="card-title">User Registration</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <form id="reg_form">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="form-control" id="cname" name="cname" placeholder="Enter Company Name" value="<?php echo htmlspecialchars($_SESSION["cname"]); ?>" required disabled>
                  </div>
                  <input type="hidden" id="c_id" name="c_id" value="<?php echo htmlspecialchars($_SESSION["cid"]); ?>">

                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role" id="role" style="width: 100%;" required>
                      <option value="">Select Role</option>
                      <?php
                      if ($_SESSION['role'] == 'Admin') {
                        while ($row = $role->fetch(PDO::FETCH_ASSOC)) {
                          echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
                        }
                      } else if ($_SESSION['role'] == 'Human Resources') {
                        echo '<option value="Employee">Employee</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Designation</label>
                    <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                      <div class="input-group-append">
                        <span class="input-group-text" id="togglePassword">
                          <i class="fa fa-eye" aria-hidden="true" onclick="togglePasswordVisibility()"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" placeholder="Select Date Of Birth" max="<?php echo date('Y-m-d'); ?>" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Date of Joining</label>
                    <input type="date" class="form-control" id="doj" name="doj" placeholder="Select Date Of Joining" required>
                  </div>
                </div>


                <div class="col-md-8">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" rows="2" id="address" name="address" placeholder="Enter Address" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode" required>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label>State</label>
                    <select class="form-control" name="state" id="state" style="width: 100%;">
                      <option value="">Select State</option>
                      <?php
                      while ($row = $state->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row["state"] . '">' . $row["state"] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>District</label>
                    <select class="form-control" name="district" id="district" style="width: 100%;">
                      <option value="">Select District</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Work Station</label>
                    <select class="form-control" name="work_station" id="work_station" style="width: 100%;" required>
                      <option value="">Select Work Station</option>
                      <option value="Office">Office</option>
                      <option value="Field">Field</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-md-5">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn bg-gradient-primary">Submit</button>
                </div>
              </div>
            </div>
          </form>
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
  <!-- Select2 -->
  <script src="../app-assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="../app-assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="../app-assets/plugins/moment/moment.min.js"></script>
  <script src="../app-assets/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="../app-assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="../app-assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../app-assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="../app-assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- BS-Stepper -->
  <script src="../app-assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <!-- dropzonejs -->
  <script src="../app-assets/plugins/dropzone/min/dropzone.min.js"></script>
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
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

    })
  </script>

  <!-- script for post request -->
  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      $('#reg_form')[0].reset();
      $(document).on('submit', '#reg_form', function(e) {
        e.preventDefault();
        $("#spinner-div").show();
        var name = $('#name').val();
        var mobile = $('#mobile').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var address = $('#address').val();
        var district = $('#district').val();
        var state = $('#state').val();
        var pincode = $('#pincode').val();
        var role = $('#role').val();
        var designation = $('#designation').val();
        var dob = $('#dob').val();
        var doj = $('#doj').val();
        var work_station = $('#work_station').val();

        if (name != '') {
          $.ajax({
            url: "action/add_user",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
              var data = jQuery.parseJSON(data);
              if (data.valid == 1) {
                success_noti(data.message, data.uname);
                setTimeout(function() {
                  location.href = 'user';
                }, 1000);
                return false;
              } else {
                warning_noti(data.message, data.uname);
                return false;
              }
            }
          });
        } else {
          info_noti("Name can't be empty.");
          setTimeout(function() {
            location.reload();
          }, 1000);
          return false;
        }
      });
    });
  </script>

  <script>
    // Add an event listener to the State select element
    document.getElementById('state').addEventListener('change', function() {
      // Get the selected state value
      const selectedState = this.value;

      // Send an AJAX request to a PHP script to fetch districts based on the selected state
      // You can use libraries like jQuery or fetch API for AJAX requests

      // Example using jQuery:
      $.ajax({
        url: 'get_districts.php', // Replace with the actual URL of your PHP script
        method: 'POST',
        data: {
          state: selectedState
        },
        success: function(data) {
          // Update the District select options with the data received from the server
          $('#district').html(data);
        }
      });
    });
  </script>



  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById('password');
      var eyeIcon = document.querySelector('#togglePassword i');

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    }
  </script>




</body>

</html>