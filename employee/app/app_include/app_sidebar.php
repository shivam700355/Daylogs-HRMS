<?php
// Start session
session_start();

// Get current page URL
$current_page = basename($_SERVER['PHP_SELF']);

// Default values for company logo and name
$companyLogo = (!isset($_SESSION['pic']) || empty($_SESSION['pic'])) ? "daylogs.png" : $_SESSION['pic'];
$companyname = (!isset($_SESSION['name']) || empty($_SESSION['name'])) ? "DayLogs" : $_SESSION['name'];

// Function to check if a given page is active
function isPageActive($pageName, $current_page)
{
    return ($pageName == $current_page) ? 'active' : '';
}

// Function to check if a given dropdown menu is open
function isMenuOpen($pageName, $current_page)
{
    return ($pageName == $current_page) ? 'menu-open' : '';
}
?>



<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <a href="home" class="brand-link">
        <img src="../app-assets/images/profile/<?php echo $companyLogo; ?>" alt="Pic" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $companyname; ?> </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item menu-open">
                    <a href="home" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if (($_SESSION['role'] == 'Employee')) {
                ?>

                    <!-- Attendance Items -->
                    <li class="nav-item <?php echo isMenuOpen('attendance.php', $current_page); ?>">
                        <a href="attendance" class="nav-link <?php echo isPageActive('attendance.php', $current_page); ?>">
                            <i class="far fa-regular fa-clock nav-icon"></i>
                            <p>Attendance</p>
                        </a>
                    </li>

                    <!-- Status Items -->
                    <li class="nav-item <?php echo isMenuOpen('status.php', $current_page); ?>">
                        <a href="status" class="nav-link <?php echo isPageActive('status.php', $current_page); ?>">
                            <i class="far fa fa-laptop nav-icon nav-icon"></i>
                            <p>Status</p>
                        </a>
                    </li>

                    <!-- Work Items -->
                    <li class="nav-item <?php echo isMenuOpen('work.php', $current_page); ?>">
                        <a href="work" class="nav-link <?php echo isPageActive('work.php', $current_page); ?>">
                            <i class="far fa-regular fa-clipboard nav-icon"></i>
                            <p>Work</p>
                        </a>
                    </li>

                    <!-- Request Items -->
                    <li class="nav-item <?php echo isMenuOpen('request.php', $current_page); ?>">
                        <a href="request" class="nav-link <?php echo isPageActive('request.php', $current_page); ?>">
                            <i class="far fa-regular fa fa-envelope nav-icon"></i>
                            <p>Request</p>
                        </a>
                    </li>

                    <!-- Project Items -->
                    <li class="nav-item <?php echo isMenuOpen('project.php', $current_page); ?>">
                        <a href="project" class="nav-link <?php echo isPageActive('project.php', $current_page); ?>">
                            <i class="far fa-regular fa-envelope nav-icon"></i>
                            <p>Project</p>
                        </a>
                    </li>

                    <!-- Announcement Items -->
                    <li class="nav-item <?php echo isMenuOpen('announcement.php', $current_page); ?>">
                        <a href="announcement" class="nav-link <?php echo isPageActive('announcement.php', $current_page); ?>">
                            <i class="far fa-regular fa-bell nav-icon"></i>
                            <p>Announcement</p>
                        </a>
                    </li>

                    <!-- Documents Items -->
                    <li class="nav-item <?php echo isMenuOpen('document.php', $current_page); ?>">
                        <a href="document" class="nav-link <?php echo isPageActive('document.php', $current_page); ?>">
                            <i class="far fa-regular fa-file-pdf nav-icon"></i>
                            <p>Documents</p>
                        </a>
                    </li>

                    <!-- Holiday Items -->
                    <li class="nav-item <?php echo isMenuOpen('holiday.php', $current_page); ?>">
                        <a href="holiday" class="nav-link <?php echo isPageActive('holiday.php', $current_page); ?>">
                            <i class="far fa-regular fa-calendar nav-icon"></i>
                            <p>Holiday</p>
                        </a>
                    </li>

                    <!-- Review Items -->
                    <li class="nav-item <?php echo isMenuOpen('review.php', $current_page); ?>">
                        <a href="review" class="nav-link <?php echo isPageActive('review.php', $current_page); ?>">
                            <i class="far fa-regular fa-star nav-icon"></i>
                            <p>Review</p>
                        </a>
                    </li>

                    <!-- Team Items -->
                    <li class="nav-item <?php echo isMenuOpen('team.php', $current_page); ?>">
                        <a href="team" class="nav-link <?php echo isPageActive('team.php', $current_page); ?>">
                            <i class="far fa-regular fa-address-card nav-icon"></i>
                            <p>Team</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-regular fa fa-cogs nav-icon"></i>
                            <p>Setting <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="activity" class="nav-link <?php echo isPageActive('activity.php', $current_page); ?>">
                                    <i class="far fa-regular fa fa-history nav-icon"></i>
                                    <p>Activity</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="session" class="nav-link <?php echo isPageActive('session.php', $current_page); ?>">
                                    <i class="far fa-regular fa fa-history nav-icon"></i>
                                    <p>Session</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="profile" class="nav-link <?php echo isPageActive('profile.php', $current_page); ?>">
                                    <i class="far fa-regular fa-user nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                <?php } ?>



                <li class="nav-item menu-open">
                    <a href="logout" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- /.sidebar -->
</aside>