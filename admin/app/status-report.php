<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$u_id = $_GET['u_Id'];
$get_status = $listing->get_all_status($u_id);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Status</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                        <h3 class="card-title">Status</h3>
                        <!-- <div class="card-tools">
                            <a href="#" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary"></a>
                        </div> -->
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.N<?php echo $u_id ?></th>
                                                <th>Status Message</th>
                                                <th>Status Date</th>
                                                <th>Status Time</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while ($row = $get_status->fetch(PDO::FETCH_ASSOC)) {
                                                $i++;
                                                $id = $row['u_id'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <?php
                                                        if (isset($row['s_msg'])) {
                                                            if ($row['s_msg'] === 'Not Available') {
                                                                echo '<span class="text-sm text-warning"><i class="fas fa-circle"></i> Not Available</span>';
                                                            } elseif ($row['s_msg'] === 'Working') {
                                                                echo '<span class="text-sm text-success"><i class="fas fa-circle"></i> Working</span>';
                                                            } elseif ($row['s_msg'] === 'Meeting') {
                                                                echo '<span class="text-sm text-danger"><i class="fas fa-circle"></i> Meeting</span>';
                                                            } else {
                                                                echo "<marquee style='color:#17a2b8'>{$row['s_msg']}</marquee>";
                                                            }
                                                        } else {
                                                            echo '---'; // Display "---" if s_msg is not available
                                                        }

                                                        ?>
                                                    </td>
                                                    
                                                    <td><?php echo $row['s_date'] ?>
                                                    </td>
                                                    <td><?php echo $row['s_time'] ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <!--  -->
                                    </table>



                                </div>
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
        $(function () {
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
        function getStatus(userId) {
            console.log(userId);
            fetch('action/getStatus.php?userId=' + userId, {
                method: 'GET',
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received data:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
    23



    <script>
        $(document).ready(function () {
            $('#submitReview').click(function () {
                var u_id = $('#u_id').val();
                var rating = $('#rating').val();
                var review = $('#review').val();
                var c_id = $('#c_id').val();
                $.ajax({
                    url: 'action/submit_review.php',
                    type: 'post',
                    data: {
                        u_id: u_id,
                        rating: rating,
                        review: review,
                        c_id: c_id
                    },
                    success: function (data) {
                        console.log('Received data:', data); // Log the received data
                        try {
                            var responseData = JSON.parse(data);
                            if (responseData.valid == 1) {
                                success_noti(responseData.message);
                                setTimeout(function () {
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