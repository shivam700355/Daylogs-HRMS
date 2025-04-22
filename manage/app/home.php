<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/count-class.php'; ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$count = new Count();
$listing = new Listing();
$client_count = $count->client_count();
$user_count = $count->user_count();

$district   = $listing->district_list();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../app-assets/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../app-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../app-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../app-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../app-assets/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../app-assets/icons/fav.png">

</head>


<body class="hold-transition sidebar-mini">

  <div class="wrapper">

    <?php include 'app_include/app_navbar.php'; ?>

    <?php include 'app_include/app_sidebar.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <!-- Small Box -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3><?php echo  $client_count; ?></h3>
                      <p>Total Client</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="client" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3><?php echo  $user_count; ?></h3>
                      <p>Total User</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3><?php echo  "400000"; ?><sup style="font-size: 20px">INR</sup></h3>
                      <p>Total Revenue</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3><?php echo  "15000"; ?><sup style="font-size: 20px">INR</sup></h3>
                      <p>Pending Amount</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </section>
      <!-- Small Box -->

    </div>

    <!-- Footer -->
    <?php include 'app_include/app_footer.php'; ?>
    <!-- /Footer -->

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

</body>

</html>