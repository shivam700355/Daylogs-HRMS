<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/count-class.php'; ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$count = new Count();
$listing = new Listing();


if(($count->user_session($_SESSION['u_id'], $_SESSION['daylogs_session'])) < 1) {
  session_destroy(); header('Location: https://daylogs.in'); exit;
}



$current_month_name = date('F');
$employee_count = $count->active_employee_count($_SESSION["cid"]);
$today_attendance_count = $count->today_attendance_count($_SESSION["cid"]);
$happiness_indexes = $count->happiness_indexes($_SESSION["cid"]);
$announcement = $listing->announcement($_SESSION["cid"]);

$project_count = $count->project_count($_SESSION["cid"]);

$presence_percentage = ($employee_count != 0) ? ($today_attendance_count / $employee_count) * 100 : 0;
$formatted_percentage = number_format($presence_percentage, 2);


// Fetch happiness indexes and counts
$happinessIndexes = $count->happiness_indexes($_SESSION["cid"]);

$totalHappiness = 0;
$totalCount = 0;

foreach ($happinessIndexes as $index) {
  // Calculate total happiness and total count
  $totalHappiness += $index['h_index'];
  $totalCount += $index['count'];
}

// Calculate average happiness
$averageHappiness = ($totalCount > 0) ? round($totalHappiness / $totalCount, 2) : 0;



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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../app-assets/icons/fav.png">

</head>


<body class="hold-transition sidebar-mini">

  <div class="wrapper">

    <?php include 'app_include/app_navbar.php'; ?>

    <?php include 'app_include/app_sidebar.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <!-- <div class="container-fluid">
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
        </div> -->
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
                      <h3><?php echo  $project_count; ?></h3>
                      <p>Total Project</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="project" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3><?php echo  $averageHappiness; ?></h3>
                      <p>Happiness Index</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="happiness" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3><?php echo  $employee_count; ?></h3>
                      <p>Active Employee</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3><?php echo  $formatted_percentage . ' %'; ?></h3>
                      <p>Today's Presence</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="attendance" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </section>
      <!-- Small Box -->

      <!-- Graph -->
      <section class="content">
        <div class="card">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-clock"></i> Attendance Log (<strong><?php echo $current_month_name; ?></strong>)</h3>
                <!-- <div class="card-tools">
                  <a href="attendance" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                </div> -->
              </div>
              <div class="card">
                <div class="card-body">
                  <canvas id="barChart" style="width:100%;max-width:100%; height:200px;"></canvas>
                  <script>
                    <?php
                    // Get the current month and year
                    $current_month = date('m');
                    $current_year = date('Y');

                    // Get the first and last day of the current month
                    $first_day_of_month = date('Y-m-01');
                    $last_day_of_month = date('Y-m-t');

                    // Fetch attendance data for the current month
                    $attendance_data = $listing->get_current_month_attendance_count($_SESSION["cid"], $first_day_of_month, $last_day_of_month);

                    // Initialize an array to store the count of users present on each date
                    $attendance_counts = array_fill(1, date('t'), 0); // Fill the array with 0 for each day of the month

                    // Loop through the attendance data and count the occurrences for each date
                    foreach ($attendance_data as $attendance) {
                      // Extract the date from the checkin_date field
                      $checkin_date = date('j', strtotime($attendance['checkin_date']));

                      // Increment the count for the corresponding date
                      $attendance_counts[$checkin_date]++;

                      $randomColor = "#" . substr(md5(rand()), 0, 6);
                      $barColors[] = $randomColor;
                    }

                    // Populate the yValues array with the attendance counts for each date
                    $yValues = array_values($attendance_counts);
                    ?>

                    // JavaScript code
                    new Chart("barChart", {
                      type: "bar",
                      data: {
                        labels: <?php echo json_encode(range(1, date('t'))); ?>, // Days of the month
                        datasets: [{
                          backgroundColor: <?php echo json_encode($barColors); ?>,
                          data: <?php echo json_encode($yValues); ?> // Attendance counts for each date
                        }]
                      },
                      options: {
                        legend: {
                          display: false
                        },
                        title: {
                          display: true,
                          text: "Attendance Log"
                        }
                      }
                    });
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card">
          <div class="row">
            <div class="col-lg-6">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-bullhorn"></i> Announcement</h3>
                <!-- <div class="card-tools">
                  <a href="attendance" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                </div> -->
              </div>
              <div class="card">
                <div class="card-body">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>S.N</th>
                        <th>Date</th>
                        <th>Title</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $annouc = $listing->announcement($_SESSION["cid"]);
                      $i = 0;
                      while ($row = $annouc->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        $id          = $row['id'];
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          
                          <td><?php echo $row['a_date']; ?></td>
                          <td><?php echo $row['a_title']; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-birthday-cake"></i> Event (<strong><?php echo $current_month_name; ?></strong>)</h3>
                <!-- <div class="card-tools">
                  <a href="attendance" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                </div> -->
              </div>
              <div class="card">
                <div class="card-body">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <th>Work Anniversary</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $current_month = date('m');
                      $user = $listing->events($_SESSION["cid"], $current_month);
                      $i = 0;
                      while ($row = $user->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        $id          = $row['u_id'];
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['u_name']; ?></td>
                          <td><?php
                              $birthday_month = date('m', strtotime($row['u_dob']));
                              if ($birthday_month == $current_month) {
                                echo $row['u_dob'];
                              } else {
                                echo '-----';
                              }
                              ?></td>
                          <td><?php
                              $anniversary_month = date('m', strtotime($row['u_doj']));
                              if ($anniversary_month == $current_month) {
                                echo $row['u_doj'];
                              } else {
                                echo '-----';
                              }
                              ?></td>
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
      <!-- /Graph -->

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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- AdminLTE App -->
  <script src="../app-assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../app-assets/dist/js/demo.js"></script>
  <!-- Page specific script -->

</body>

</html>