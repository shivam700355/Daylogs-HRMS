<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$request = $listing->request($_SESSION["cid"]);
$c_id = $_SESSION["cid"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | Request List</title>

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
                        <h3 class="card-title">Request List</h3>
                        <div class="card-tools">
                            <a data-toggle="modal" data-target="#exampleModal"
                                class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-plus"
                                    aria-hidden="true"></i></a>
                        </div>
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
                                                <th>Mobile</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Requested On</th>

                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
                                                $i++;
                                                $active = $row['status'];
                                                $id = $row['id'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['u_name']; ?></td>
                                                    <td><?php echo $row['u_mobile']; ?></td>
                                                    <td><?php echo $row['r_type']; ?></td>
                                                    <td><?php echo date("d M y, D", strtotime($row['r_date'])); ?></td>
                                                    <td><?php echo $row['r_title']; ?></td>
                                                    <td
                                                        style="color: <?php echo $row['r_action'] == 'Approved' ? 'green' : ($row['r_action'] == 'Rejected' ? 'red' : 'orange'); ?>">
                                                        <?php echo $row['r_action']; ?>
                                                    </td>

                                                    <td><?php echo date("Y-m-d h:i A", strtotime($row['r_date'])); ?></td>
                                                    <td>
                                                        <!-- Add a setting button with a data attribute to store user details -->
                                                        <a href="#" class="btn btn-tbl-edit btn-xs btn-primary view-request"
                                                            data-toggle="modal" data-target="#userModal"
                                                            data-details="<?php echo htmlspecialchars(json_encode($row)); ?>">
                                                            <i class="fa fa-cog"></i>
                                                        </a>
                                                        <a href="user_dashboard?id=9"
                                                            class="btn btn-tbl-edit btn-xs btn-primary"><i
                                                                class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>

                                </div>
                            </div>

                            <div class="modal fade" id="userModal" tabindex="-1" role="dialog"
                                aria-labelledby="userModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="userModalLabel">Request Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="updateform">
                                                <div class="row">
                                                    <input type="hidden" name="id" id="id">
                                                    <input type="hidden" name="u_id" id="u_id">

                                                    <div class="form-group col-6">
                                                        <label for="Name">User Name:</label>
                                                        <input type="text" class="form-control" id="Name" readonly>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="Mobile">Mobile:</label>
                                                        <input type="text" class="form-control" id="Mobile" readonly>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="Type">Type:</label>
                                                        <input type="text" class="form-control" id="Type" readonly>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="Date">Date:</label>
                                                        <input type="text" class="form-control" id="Date" readonly>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="Title">Title:</label>
                                                        <input type="text" class="form-control" id="Title" readonly>
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <label for="rating">Status</label>
                                                        <select name="rating" id="rating" class="form-control">
                                                            <option value="" selected hidden disabled>Select Status
                                                            </option>
                                                            <option value="Approved">Approved</option>
                                                            <option value="Rejected">Rejected</option>
                                                            <option value="Pending">Pending</option>

                                                        </select>
                                                    </div>
                                                </div>

                                            </form>

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
    <script>
        $(document).ready(function () {
            $('.dropdown-item').click(function (e) {
                e.preventDefault();
                var status = $(this).text().trim();
                $('#r_action').val(status);
                $('#form').submit();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const viewButtons = document.querySelectorAll('.view-request');

            viewButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const rowData = JSON.parse(this.getAttribute('data-details'));
                    document.getElementById('id').value = rowData.id;
                    document.getElementById('u_id').value = rowData.u_id;
                    document.getElementById('Name').value = rowData.u_name;
                    document.getElementById('Mobile').value = rowData.u_mobile;
                    document.getElementById('Type').value = rowData.r_type;
                    document.getElementById('Date').value = rowData.r_date;
                    document.getElementById('Title').value = rowData.r_title;
                    document.getElementById('Action').value = rowData.r_action == 'Pending' ? 'Approved' : rowData.r_action;

                    $('#userModal').modal('show');
                });
            });
        });
    </script>
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
        $(document).ready(function () {
            $('.view-request').click(function (e) {
                e.preventDefault();
                var details = JSON.parse($(this).data('details'));
                // Now you have access to all the row data

                console.log('Details:', details);
                $('#Name').text(details.u_name);
                $('#Mobile').text(details.u_mobile);
                $('#Type').text(details.r_type);
                $('#Date').text(details.r_date);
                $('#Title').text(details.r_title);
                $('#Action').text(details.r_action);
                $('#userModal').modal('show');
            });
        });
    </script>


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
        $(document).ready(function () {
            $('#requestlive').click(function () {
                var id = $('#id').val();
                var u_id = $('#u_id').val();
                var r_action = $('#r_action').val();
                var r_desc = $('#r_desc').val();
                var c_id = $('#c_id').val();
                $.ajax({
                    url: 'action/submit_request.php',
                    type: 'post',
                    data: {
                        id: id,
                        r_action: r_action,
                        r_desc: r_desc,
                        c_id: c_id
                    },
                    success: function (data) {
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
    <script>
        $(document).ready(function () {
            $('#rating').change(function () {
                var u_id = $('#u_id').val();
                var status = $(this).val();
                var id = $('#id').val();
                console.log('Selected value:', status);
                console.log('User ID:', u_id);

                $.ajax({
                    url: 'action/request_update.php',
                    method: 'POST',
                    data: {
                        u_id: u_id,
                        status: status,
                        id: id
                    },
                    success: function (response) {
                        try {
                            var responseData = JSON.parse(response);
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
                    },
                    error: function (xhr, status, error) {
                        console.error('Error sending data:', error);
                    }
                });
            });
        });

    </script>


</body>

</html>