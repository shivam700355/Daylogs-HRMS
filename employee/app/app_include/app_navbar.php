<?php require_once (".../../app_include/session.php"); ?>
<?php require_once (".../../app_include/function.php"); ?>
<?php include '../../action/class/count-class.php'; ?>
<?php include '../../action/class/listing-class.php'; ?>
<?php
$listing = new Listing();
$status = $listing->get_status($_SESSION["u_id"]);

$employee = $listing->employee_list($_SESSION['cid']);

?>


<?php is_logged_in(); ?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->

    <li class="nav-item">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <?php
        $i = 0;
        while ($row = $status->fetch(PDO::FETCH_ASSOC)) {
          $i++;
          if ($row['s_msg'] === 'Not Available') {
            echo '<span class="float-right text-sm text-warning"><i class="fas fa-circle"></i> Not Available</span>';
          } elseif ($row['s_msg'] === 'Working') {
            echo '<span class="float-right text-sm text-success"><i class="fas fa-circle"></i> Working</span>';
          } elseif ($row['s_msg'] === 'Meeting') {
            echo '<span class="float-right text-sm text-danger"><i class="fas fa-circle"></i> Meeting</span>';
          } else {
            echo "<marquee style='color:#17a2b8 '>{$row['s_msg']}</marquee>";
          }
        }
        ?>

      </a>
    </li>
    <!-- Status Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa fa-laptop"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item" id="notAvailableOption">
          <div class="media">
            <h3 class="dropdown-item-title">
              <span class="float-right text-sm text-warning"><i class="fas fa-circle"></i> Not
                Available</span>
            </h3>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item" id="workingOption">
          <div class="media">
            <h3 class="dropdown-item-title">
              <span class="float-right text-sm text-success"><i class="fas fa-circle"></i> Working</span>
            </h3>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item" id="meetingOption">
          <div class="media">
            <h3 class="dropdown-item-title">
              <span class="float-right text-sm text-danger"><i class="fas fa-circle"></i> Meeting</span>
            </h3>
          </div>
        </a>

        <div class="dropdown-divider"></div>
        <form id="manualStatusForm" class="dropdown-item">
          <div class="input-group">
            <input id="manualStatusInput" type="text" class="form-control" placeholder="Enter manual status">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li> -->
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php while ($row = $employee->fetch(PDO::FETCH_ASSOC)) { 
          ?>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
            <img src="https://daylogs.in/employee/app-assets/images/profile/<?php echo $row['u_pic']; ?>" alt="<?= $row['u_pic']; ?>" style="height: 30px;width: 30px; border-radius: 50%;"">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                <?php echo $row['u_name']; ?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"><?php echo $rating; ?></i></span>
                </h3>
                <!-- <p class="text-sm">Call me whenever you can...</p> -->
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
        <?php } ?>
       
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <!-- <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<script>
  document.getElementById('notAvailableOption').addEventListener('click', function () {
    sendDataToServer('Not Available');
  });

  document.getElementById('workingOption').addEventListener('click', function () {
    sendDataToServer('Working');
  });

  document.getElementById('meetingOption').addEventListener('click', function () {
    sendDataToServer('Meeting');
  });

  document.getElementById('manualStatusForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    var manualStatus = document.getElementById('manualStatusInput').value;
    if (manualStatus.trim() !== '') {
      sendDataToServer(manualStatus);
    }
  });

  function sendDataToServer(status) {
    fetch('../app/action/active_status.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ status: status })
    })
      .then(function (response) {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Failed to update status');
        }
      })
      .then(function (responseData) {
        if (responseData.valid == 1) {
          success_noti(responseData.message, responseData.uname);
          setTimeout(function () {
            window.location.href = "home"
          }, 1000);
        } else {
          warning_noti(responseData.message, responseData.uname);
        }
      })
      .catch(function (error) {
        console.error(error.message);
        alert('Failed to update status');
      });
  }





</script>