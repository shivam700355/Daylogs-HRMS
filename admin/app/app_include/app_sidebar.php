<?php
// Start session
session_start();

// Get current page URL
$current_page = basename($_SERVER['PHP_SELF']);

// Default values for company logo and name
$companyLogo = (!isset($_SESSION['cpic']) || empty($_SESSION['cpic'])) ? "daylogs.png" : $_SESSION['cpic'];
$companyname = (!isset($_SESSION['cabbname']) || empty($_SESSION['cabbname'])) ? "DayLogs" : $_SESSION['cabbname'];

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
        <img src="../app-assets/images/client/<?php echo $companyLogo; ?>" alt="Comapny"
            class="brand-image img-circle elevation-2" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $companyname; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item menu-open">
                    <a href="home" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- User Control -->
                <?php if (($_SESSION['role'] == 'Admin') || ($_SESSION['role'] == 'Human Resources') || ($_SESSION['role'] == 'Manager')) { ?>

                    <li class="nav-item <?php echo isMenuOpen('user.php', $current_page); ?>">
                        <a href="#" class="nav-link">
                            <i class="far fa-address-card nav-icon"></i>

                            <p>User Control<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="user" class="nav-link <?php echo isPageActive('user.php', $current_page); ?>">
                                    <i class="far fa-user nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="status" class="nav-link <?php echo isPageActive('status.php', $current_page); ?>">
                                    <i class="far fa-regular fa-eye nav-icon"></i>
                                    <p>Status</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="happiness"
                                    class="nav-link <?php echo isPageActive('happiness.php', $current_page); ?>">
                                    <i class="far fa-regular fa-smile nav-icon"></i>
                                    <p>Happiness Index</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="review" class="nav-link <?php echo isPageActive('review.php', $current_page); ?>">
                                    <i class="far fa-regular fa-star nav-icon"></i>
                                    <p>Rating</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Other Menu Items -->
                <li class="nav-item <?php echo isMenuOpen('attendance.php', $current_page); ?>">
                    <a href="attendance" class="nav-link <?php echo isPageActive('attendance.php', $current_page); ?>">
                        <i class="far fa-regular fa-clock nav-icon"></i>
                        <p>Attendance</p>
                    </a>
                </li>

                <!-- Other Menu Items -->
                <li class="nav-item <?php echo isMenuOpen('leave.php', $current_page); ?>">
                    <a href="leave" class="nav-link <?php echo isPageActive('leave.php', $current_page); ?>">
                        <i class="far fa-regular fa-envelope-open nav-icon"></i>
                        <p>Leave Report</p>
                    </a>
                </li>

                <li class="nav-item <?php echo isMenuOpen('request.php', $current_page); ?>">
                    <a href="request" class="nav-link <?php echo isPageActive('request.php', $current_page); ?>">
                        <i class="far fa-regular fa-envelope-open nav-icon"></i>
                        <p>Request</p>
                    </a>
                </li>
                <li class="nav-item <?php echo isMenuOpen('project.php', $current_page); ?>">
                    <a href="project" class="nav-link <?php echo isPageActive('project.php', $current_page); ?>">
                        <i class="far fa-regular fa-envelope nav-icon"></i>
                        <p>Project</p>
                    </a>
                </li>
                <li class="nav-item <?php echo isMenuOpen('holiday.php', $current_page); ?>">
                    <a href="holiday" class="nav-link <?php echo isPageActive('holiday.php', $current_page); ?>">
                        <i class="far fa-regular fa-calendar nav-icon"></i>
                        <p>Holiday</p>
                    </a>
                </li>
                <li class="nav-item <?php echo isMenuOpen('announcement.php', $current_page); ?>">
                    <a href="announcement"
                        class="nav-link <?php echo isPageActive('announcement.php', $current_page); ?>">
                        <i class="far fa-regular fa-bell nav-icon"></i>
                        <p>Announcement</p>
                    </a>
                </li>
                <li class="nav-item <?php echo isMenuOpen('document.php', $current_page); ?>">
                    <a href="document" class="nav-link <?php echo isPageActive('document.php', $current_page); ?>">
                        <i class="far fa-regular fa-file-pdf nav-icon"></i>
                        <p>Documents</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-regular fa fa-birthday-cake nav-icon"></i>
                        <p>Event <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="birthday"
                                class="nav-link <?php echo isPageActive('birthday.php', $current_page); ?>">
                                <i class="far fa-regular fa-circle nav-icon"></i>
                                <p>Birthday</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="anniversary"
                                class="nav-link <?php echo isPageActive('anniversary.php', $current_page); ?>">
                                <i class="far fa-regular fa-circle nav-icon"></i>
                                <p>Anniversary</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-regular fa fa-flag-checkered nav-icon"></i>
                        <p>Report <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="attendance_report"
                                class="nav-link <?php echo isPageActive('attendance_report.php', $current_page); ?>">
                                <i class="far fa-regular fa-circle nav-icon"></i>
                                <p>Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="work_report"
                                class="nav-link <?php echo isPageActive('work_report.php', $current_page); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Work</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="salary" class="nav-link <?php echo isPageActive('salary.php', $current_page); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Salary</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-regular fa fa-cogs nav-icon"></i>
                        <p>Setting <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="activity"
                                class="nav-link <?php echo isPageActive('activity.php', $current_page); ?>">
                                <i class="far fa-regular fa-circle nav-icon"></i>
                                <p>Activity</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="session"
                                class="nav-link <?php echo isPageActive('session.php', $current_page); ?>">
                                <i class="far fa-regular fa-circle nav-icon"></i>
                                <p>Session</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="profile"
                                class="nav-link <?php echo isPageActive('profile.php', $current_page); ?>">
                                <i class="far fa-regular fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- End Other Menu Items -->

                <!-- Logout -->
                <li class="nav-item menu-open">
                    <a href="logout" class="nav-link active">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>