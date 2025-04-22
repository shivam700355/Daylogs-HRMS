<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/count-class.php'; ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>

<?php is_logged_in(); ?>
<?php
$count = new Count();
$listing = new Listing();
$announcement = $listing->announcement($_SESSION["cid"]);
$wd_count = $count->working_days_count($_SESSION["u_id"]);
$happinessIndexes = $count->happiness_indexes($_SESSION["u_id"]);
$rating = $count->avg_user_rating($_SESSION["u_id"]);
$project = $count->project_count($_SESSION["u_id"]);

if (($count->user_session($_SESSION['u_id'], $_SESSION['daylogs_session'])) < 1) {
  session_destroy();
  header('Location: https://daylogs.in');
  exit;
}


$current_month_name = date('F');
date_default_timezone_set('Asia/Calcutta');
$date = date("Y-m-d");

$today_attendance  = $listing->get_today_attendance($_SESSION["u_id"], $date);
$today_total_break = $listing->get_day_total_break($_SESSION["u_id"], $date);
//$today_break_time  = $listing->get_today_break_time($_SESSION["u_id"], $date);


$attendance_id = $checkin = $checkout = $break = 0;

if (count($today_attendance) > 0) {

  $attendance_id = $today_attendance[0]['id'];
  $checkin_timestamp  = strtotime($today_attendance[0]['checkin_time']);
  $checkout_timestamp = strtotime($today_attendance[0]['checkout_time']);
  $break              = $today_attendance[0]['break'];

  $checkin = 1;
  $checkout = ($today_attendance[0]['checkout_time'] !== '00:00:00') ? 1 : 0;

  if ($checkout == 1) {
    $time_difference_seconds = $checkout_timestamp - $checkin_timestamp;
    $hours = floor($time_difference_seconds / 3600);
    $minutes = floor(($time_difference_seconds % 3600) / 60);
    $seconds = $time_difference_seconds % 60;
    $time_difference = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
  }
}

// Calculate total happiness and total count
$totalHappiness = $happinessIndexes['h_index'] ?? 0;
$totalHappinessCount = $happinessIndexes['count'] ?? 0;
// Calculate average happiness
$averageHappiness = ($totalHappinessCount > 0) ? round($totalHappiness / $totalHappinessCount, 2) : 0;

// Average rating
$avg_rating = isset($rating['total_avg_rating']) ? number_format($rating['total_avg_rating'], 2) : "N/A";



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

  <!-- Favicon -->
  <link rel="shortcut icon" href="../app-assets/icons/fav.png">

  <style>
    .emoji-container {
      display: flex;
      justify-content: space-around;
    }

    .emoji-btn {
      font-size: 36px;
      margin: 0 10px;
      border: none;
      background-color: transparent;
      cursor: pointer;
      filter: grayscale(100%);
    }

    .selected {
      filter: none;
    }
  </style>



</head>


<body class="hold-transition sidebar-mini">

  <div class="wrapper">

    <?php include 'app_include/app_navbar.php'; ?>

    <?php include 'app_include/app_sidebar.php'; ?>

    <div class="content-wrapper">

      <section class="content-header">

        <div class="card-tools card card-default">


          <div class="card-header d-flex justify-content-between align-items-center flex-column flex-md-row">
            <!-- checkin button -->
            <div class="col-md-4">
              <button class="btn btn-success" data-toggle="modal" data-target="#checkinModal" <?php echo ($checkin == 1) ? 'disabled' : ''; ?>>
                <?php echo ($checkin > 0) ? "Check In: " . date("h:i A", $checkin_timestamp) : "Check In"; ?>
              </button>
            </div>

            <!-- break button -->
            <div class="col-md-4 position-relative text-center">
              <button class="btn btn-primary" data-toggle="modal" data-target="#breakModal" <?php if ($checkout == 1 || $checkin == 0) echo 'disabled'; ?>>
                <i class="fa fa-<?php echo ($break == 1 || $checkout == 1 || $checkin == 0) ? 'play' : 'pause'; ?>">

                  <?php if ($checkout == 1) : ?>
                    <span><?php echo $time_difference; ?></span>
                  <?php elseif ($break == 1) : ?>
                    <span><?php echo "On Break"; ?></span>
                  <?php else : ?>
                    <span id="timer"><?php echo '00:00:00'; ?></span>
                  <?php endif; ?>

                </i>
              </button>
            </div>

            <!-- checkout button -->
            <div class="col-md-4 text-md-right">
              <button class="btn bg-danger" data-toggle="modal" data-target="#checkoutModal" <?php echo ($checkout == 1) ? 'disabled' : ''; ?> <?php echo ($break == 1) ? 'disabled' : ''; ?>>
                <?php echo ($checkout > 0) ? "Check Out: " . date("h:i A", $checkout_timestamp) : "Check Out"; ?>
              </button>
            </div>

          </div>


          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-lg-3 col-6">
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3><?php echo $project; ?></h3>
                              <p>Assigned Projects</p>
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
                              <h3><?php echo $averageHappiness; ?></h3>
                              <p>Happiness Index</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="attendance" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-3 col-6">
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3><?php echo $avg_rating; ?></h3>
                              <p>Average Rating</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="rating" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <div class="col-lg-3 col-6">
                          <div class="small-box bg-info">
                            <div class="inner">
                              <h3><?php echo $wd_count; ?></h3>
                              <p>Monthly Attendance</p>
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
              </div>

            </div>
            <div class="row">
              <!-- <div class="col-12">
                <h1 id="u_id">User Id <?php echo $_SESSION["u_id"]; ?></h1>
              </div>
              <div class="col-12">
                <h1 id="dn">divice Name</h1>
              </div>
              <div class="col-12">
                <h1 id="bn">browser Name</h1>
              </div> -->
            </div>






          </div>

          <!-- checkinModal -->
          <div class="modal fade" id="checkinModal" tabindex="-1" role="dialog" aria-labelledby="checkinModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Check In</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h6 class="modal-title" id="checkoutModalLabel">Are you ready to begin your work?</h6>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <!-- <button id="checkinButton" onclick="checkin();" type="button" class="btn btn-primary">Check In</button> -->
                  <button id="checkinButton" onclick="markCheckIn();" type="button" class="btn btn-primary">Check
                    In</button>

                </div>
              </div>
            </div>
          </div>

          <!-- breakModal -->
          <div class="modal fade" id="breakModal" tabindex="-1" role="dialog" aria-labelledby="breakModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title" id="checkoutModalLabel">Are you ready to <?php if ($break == 1) : ?>
                      Stop Break
                    <?php else : ?>
                      Take Break
                      <?php endif; ?>?</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <div class="col-lg-12 col-md-4 col-sm-12">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <tbody>
                          <tr>
                            <th colspan="2"><a href="#">Break Details</a></th>
                          </tr>

                          <tr>
                            <th scope="col">Total Duration</th>
                            <td><?php echo $today_total_break; ?></td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button id="breakButton" onclick="markBreak();" type="button" class="btn btn-primary">
                    <?php if ($break == 1) : ?>
                      Stop Break
                    <?php else : ?>
                      Take Break
                    <?php endif; ?>
                  </button>

                </div>
              </div>
            </div>
          </div>

          <!-- checkoutModal -->
          <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title">How was your day at work?</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="emoji-container">
                    <button class="emoji-btn" onclick="selectEmoji(0)">😎</button>
                    <button class="emoji-btn" onclick="selectEmoji(1)">😊</button>
                    <button class="emoji-btn" onclick="selectEmoji(2)">😅</button>
                    <button class="emoji-btn" onclick="selectEmoji(3)">😌</button>
                    <button class="emoji-btn" onclick="selectEmoji(4)">😩</button>
                  </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button id="checkoutButton" onclick="markCheckOut();" type="button" class="btn btn-primary" disabled>Check Out</button>
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

                          <td><?php echo date('j M, y  D', strtotime($row['a_date'])); ?></td>
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
                <h3 class="card-title"> <i class="fas fa-birthday-cake"></i> Event <strong>(<?php echo $current_month_name; ?>)</strong></h3>
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
                        $active      = $row['u_status'];
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

  <!-- Toastr -->
  <script src="../app-assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
  <script src="toast.js"></script>

  <script>
    let selectedEmojiIndex = -1;
    const checkoutButton = document.getElementById('checkoutButton');

    function selectEmoji(index) {
      // Remove selected class from previously selected emoji
      if (selectedEmojiIndex !== -1) {
        document.getElementsByClassName('emoji-btn')[selectedEmojiIndex].classList.remove('selected');
      }
      // Add selected class to the newly selected emoji
      document.getElementsByClassName('emoji-btn')[index].classList.add('selected');
      selectedEmojiIndex = index;

      // Enable the checkout button
      checkoutButton.removeAttribute('disabled');
    }

    function markCheckOut() {
      const h_index = 5 - selectedEmojiIndex;
      const c_id = "<?php echo $_SESSION['cid']; ?>";
      const u_id = "<?php echo $_SESSION['u_id']; ?>";
      const att_id = "<?php echo $attendance_id; ?>";

      if (c_id && u_id && h_index !== '') {
        $.ajax({
          url: "action/checkout",
          method: 'POST',
          data: {
            c_id,
            u_id,
            h_index,
            att_id
          },
          success: function(data) {
            data = jQuery.parseJSON(data);
            if (data.valid == 1 || data.valid == 2) {
              success_noti(data.message, data.uname);
              setTimeout(function() {
                $('#checkoutModal').modal('hide');
                location.href = 'home';
                if (data.valid == 1) startTimer();
              }, 1000);
            } else {
              warning_noti(data.message, data.message);
            }
          }
        });
      } else {
        info_noti("Field can't be empty.");
        setTimeout(function() {
          location.reload();
        }, 1000);
      }
    }


    function markCheckIn() {
      const c_id = "<?php echo $_SESSION['cid']; ?>";
      const u_id = "<?php echo $_SESSION['u_id']; ?>";

      if (c_id && u_id) {
        $.ajax({
          url: "action/checkin",
          method: 'POST',
          data: {
            c_id,
            u_id
          },
          success: function(data) {
            data = jQuery.parseJSON(data);
            if (data.valid == 1 || data.valid == 2) {
              success_noti(data.message, data.uname);
              setTimeout(function() {
                $('#checkinModal').modal('hide');
                location.href = 'home';
                if (data.valid == 1) startTimer();
              }, 1000);
            } else {
              warning_noti(data.message, data.message);
            }
          }
        });
      } else {
        info_noti("Field can't be empty.");
        setTimeout(function() {
          location.reload();
        }, 1000);
      }
    }

    function markBreak() {
      const c_id = "<?php echo $_SESSION['cid']; ?>";
      const u_id = "<?php echo $_SESSION['u_id']; ?>";
      const breaks = "<?php echo $break; ?>";

      if (c_id && u_id) {
        $.ajax({
          url: "action/break",
          method: 'POST',
          data: {
            c_id,
            u_id,
            breaks
          },
          success: function(data) {
            data = jQuery.parseJSON(data);
            if (data.valid == 1 || data.valid == 2) {
              success_noti(data.message, data.uname);
              setTimeout(function() {
                $('#breakModal').modal('hide');
                location.href = 'home';
                if (data.valid == 1) startTimer();
              }, 1000);
            } else {
              warning_noti(data.message, data.message);
            }
          }
        });
      } else {
        info_noti("Field can't be empty.");
        setTimeout(function() {
          location.reload();
        }, 1000);
      }
    }
  </script>

  <script>
    // Function to update the timer
    function updateTimer() {

      // Get the current timestamp
      var currentTimestamp = Math.floor(Date.now() / 1000);

      // Calculate the time difference
      var timeDifference = currentTimestamp - <?php echo $checkin_timestamp; ?>;

      // Calculate hours, minutes, and seconds
      var hours = Math.floor(timeDifference / 3600);
      var minutes = Math.floor((timeDifference % 3600) / 60);
      var seconds = timeDifference % 60;

      // Format the time components to ensure they have leading zeros if necessary
      hours = ('0' + hours).slice(-2);
      minutes = ('0' + minutes).slice(-2);
      seconds = ('0' + seconds).slice(-2);

      // Update the content of the timer div
      document.getElementById('timer').innerHTML = hours + ':' + minutes + ':' + seconds;
    }

    // Update the timer every second
    setInterval(updateTimer, 1000);
  </script>




  <script>
    const windowName = document.title;

    // Get current browser name from user agent string
    let browserName = "Unknown";
    const userAgent = navigator.userAgent;
    if (userAgent.includes("Firefox")) {
      browserName = "Firefox";
    } else if (userAgent.includes("Chrome")) {
      browserName = "Chrome";
    } else if (userAgent.includes("Safari")) {
      browserName = "Safari";
    } else if (userAgent.includes("Edge")) {
      browserName = "Edge";
    } else if (userAgent.includes("MSIE")) {
      browserName = "Internet Explorer";
    }

    // Get device name from user agent string
    let deviceName = "Unknown";
    if (userAgent.includes("iPhone")) {
      deviceName = "iPhone";
    } else if (userAgent.includes("iPad")) {
      deviceName = "iPad";
    } else if (userAgent.includes("Android")) {
      deviceName = "Android";
    } else if (userAgent.includes("Windows Phone")) {
      deviceName = "Windows Phone";
    } else if (userAgent.includes("Mac")) {
      deviceName = "Mac";
    } else if (userAgent.includes("Windows")) {
      deviceName = "Windows PC";
    }
    const u_id = "<?php echo $_SESSION['u_id']; ?>";
    const browserInfo = `${browserName}`;
    const deviceInfo = ` ${deviceName}`;

    document.getElementById("u_id").innerHTML = u_id;
    document.getElementById("dn").innerHTML = deviceInfo;
    document.getElementById("bn").innerHTML = browserInfo;
  </script>


</body>

</html>