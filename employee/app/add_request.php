<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>

<?php
session_start();
$listing = new Listing();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | New Request </title>
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
            <h3 class="card-title">New Request</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <form id="req_form">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="form-control" id="cname" name="cname" placeholder="Enter Company Name" value="<?php echo htmlspecialchars($_SESSION["cname"]); ?>" required disabled>
                  </div>
                  <!-- <input type="hidden" id="c_id" name="c_id" value="<?php echo htmlspecialchars($_SESSION["cid"]); ?>"> -->
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo htmlspecialchars($_SESSION["name"]); ?>" required disabled>
                  </div>
                  <!-- <input type="hidden" id="u_id" name="u_id" value="<?php echo htmlspecialchars($_SESSION["u_id"]); ?>"> -->
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Request Type</label>
                    <select class="form-control" name="r_type" id="r_type" style="width: 100%;" required>
                      <option value="">Select Type</option>
                      <option value="Casual Leave">Casual Leave</option>
                      <option value="Sick Leave">Sick Leave</option>
                      <option value="Short Leave">Short Leave</option>
                      <option value="Attendance Log">Attendance Log</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Request Date</label>
                    <input type="date" class="form-control" id="r_date" name="r_date" placeholder="Select Date" min="<?php echo date('Y-m-d'); ?>" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Request Title</label>
                    <input type="text" class="form-control" id="r_title" name="r_title" placeholder="Enter Request Title" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group"><label>Message</label><textarea class="form-control" rows="6" id="r_desc" name="r_desc" placeholder="Enter Description" required></textarea></div>
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
      $('#req_form')[0].reset();
      $(document).on('submit', '#req_form', function(e) {
        e.preventDefault();
        $("#spinner-div").show();
        var c_id = $('#c_id').val();
        var u_id = $('#u_id').val();
        var r_type = $('#r_type').val();
        var r_date = $('#r_date').val();
        var r_title = $('#r_title').val();
        var r_desc = $('#r_desc').val();
       
        if (r_desc != '') {
          $.ajax({
            url: "action/add_request",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
              var data = jQuery.parseJSON(data);
              if (data.valid == 1) {
                success_noti(data.message, data.uname);
                setTimeout(function() {
                  location.href = 'request';
                }, 1000);
                return false;
              } else {
                warning_noti(data.message, data.uname);
                return false;
              }
            }
          });
        } else {
          info_noti("Description can't be empty.");
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