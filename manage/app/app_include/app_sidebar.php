<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php
    session_start();
    $companyLogo = (!isset($_SESSION['cpic']) || empty($_SESSION['cpic'])) ? "daylogs.png" : $_SESSION['cpic'];
    $companyname = (!isset($_SESSION['cabbname']) || empty($_SESSION['cabbname'])) ? "DayLogs" : $_SESSION['cabbname'];

    ?>

    <a href="home.php" class="brand-link">
        <img src="../app-assets/images/client/<?php echo $companyLogo; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $companyname; ?></span>
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
                <?php if (($_SESSION['role'] == 'Super Admin')) {
                ?>

                    <li class="nav-item">
                        <a href="client" class="nav-link">
                            <i class="far fa-regular fa-user nav-icon"></i>
                            <p>Client</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="admin" class="nav-link">
                            <i class="far fa-regular fa-user nav-icon"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                
                    <!--User control Menu -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Other<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <!-- Menu items for User Control -->
                            <li class="nav-item">
                                <a href="contact" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Contact</p>
                                </a>
                                <a href="add_document" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Document</p>
                                </a>

                            </li>


                        </ul>
                    </li>
                    <!--/User control Menu -->



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