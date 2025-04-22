<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php include 'action/class/count-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$count = new Count();
$user = $listing->active_user_list($_SESSION["cid"]);
$c_id = $_SESSION["cid"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Review List</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                        <h3 class="card-title">Review List</h3>
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
                                                <th>S.N</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Checkout ⭐</th>
                                                <th>Work ⭐</th>
                                                <th>User ⭐</th>
                                                <th>Average ⭐</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while ($row = $user->fetch(PDO::FETCH_ASSOC)) {
                                                $i++;
                                                $active = $row['u_status'];
                                                $id = $row['u_id'];

                                                // Fetch rating data for the user
                                                $ratings = $count->avg_user_rating($id);

                                                $checkout_avg = $ratings['checkout_avg'] ?? "--";
                                                $work_avg = $ratings['work_avg'] ??  "--";
                                                $rating_avg = $ratings['rating_avg'] ??  "--";
                                                $total_avg_rating = $ratings['total_avg_rating'] ??  "--";
                                                
                                                


                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['u_name']; ?></td>
                                                    <td><?php echo $row['u_email']; ?></td>
                                                    <td><?php echo $row['u_mobile']; ?></td>
                                                    <td><?php echo $checkout_avg; ?></td>
                                                    <td><?php echo $work_avg; ?></td>
                                                    <td><?php echo $rating_avg; ?></td>
                                                    <td><?php echo ($total_avg_rating > 0) ? str_repeat("&#9733;", $total_avg_rating) . "($total_avg_rating)" : "--"; ?></td>
                                                    <td>
                                                        <a onclick="setUserId(<?php echo $row['u_id']; ?>, '<?php echo $row['u_name']; ?>')" data-toggle="modal" data-target="#reviewmodal" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-star"></i></a>
                                                        <a href="user_dashboard?id=<?php echo $row['u_id']; ?>" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="reviewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        <?php echo "Rating/Review"; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="reviewform">
                                                        <input type="hidden" id="u_id" name="u_id" value="">
                                                        <input type="hidden" id="c_id" name="c_id" value="<?php echo $c_id; ?>">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-group">Name</label>
                                                            <input type="text" class="form-control" id="name" value="" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="rating" class="form-group">Rating</label>
                                                            <select name="rating" id="rating" class="form-control">
                                                                <option value="1">⭐</option>
                                                                <option value="2">⭐⭐</option>
                                                                <option value="3">⭐⭐⭐</option>
                                                                <option value="4">⭐⭐⭐⭐</option>
                                                                <option value="5">⭐⭐⭐⭐⭐</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="review" class="form-group">Remark</label>
                                                            <textarea name="review" id="review" rows="4" cols="50" class="form-control"></textarea>
                                                        </div>
                                                        <div class="mb-3 d-flex justify-content-center">
                                                            <button type="button" id="submitReview" class="btn btn-primary">Submit</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
        $(function() {
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
        function setUserId(userId, name) {
            document.getElementById('u_id').value = userId;
            document.getElementById('name').value = name;

        }
    </script>

    <script>
        $(document).ready(function() {
            $('#submitReview').click(function() {
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
                    success: function(data) {
                        console.log('Received data:', data); // Log the received data
                        try {
                            var responseData = JSON.parse(data);
                            if (responseData.valid == 1) {
                                success_noti(responseData.message);
                                setTimeout(function() {
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