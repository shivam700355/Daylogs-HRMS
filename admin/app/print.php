<?php require_once ("app_include/session.php"); ?>
<?php require_once ("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DayLogs | print</title>

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
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            Invoice
                            <strong>01/01/01/2018</strong>
                            <a href="javascript:void(0);" onclick="window.print()" class="btn btn-default"><i
                                    class="fa fa-print"></i></a>

                        </div>
                        <div class="card-body">
                            <h3 class="text-center">PAYSLIP- August- 2023</h3>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Employee Code:</strong> VA/HRA/A0008/2022</p>
                                    <p><strong>Location:</strong> Lucknow</p>
                                    <p><strong>Name:</strong> Mr. Durgesh Chaudhary</p>
                                    <p><strong>Year:</strong> 2023</p>
                                    <p><strong>Designation:</strong> Sr. Software Developer</p>
                                    <p><strong>Date of Joining:</strong> 15/06/2022</p>
                                    <p><strong>Department:</strong> IT/ITECS</p>
                                    <p><strong>Pay Mode:</strong> Online</p>
                                </div>
                                <div class="col">
                                    <p><strong>Date of Birth:</strong> 03-08-1995</p>
                                    <p><strong>Account No.:</strong> 628101578161</p>
                                    <p><strong>Father/Husband Name:</strong> Rajendra Prasad Chaudhary</p>
                                    <p><strong>Bank:</strong> ICICI Bank</p>
                                    <p><strong>PAN No.:</strong> BDWPC0716M</p>
                                    <p><strong>IFS Code:</strong> ICIC0006281</p>
                                    <p><strong>ESI Account-Standard Days:</strong> 31</p>
                                    <p><strong>PF/UAN No.-Paid Days:</strong> 31</p>
                                </div>
                            </div>
                            <h3>Earnings Amount Rs.</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Earnings</th>
                                        <th scope="col">Amount Rs.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Basic Pay</td>
                                        <td>25,000</td>
                                    </tr>
                                    <tr>
                                        <td>HRA</td>
                                        <td>12,500</td>
                                    </tr>
                                    <tr>
                                        <td>Transport/Conveyance Allowance</td>
                                        <td>6,250</td>
                                    </tr>
                                    <tr>
                                        <td>Other Allowance</td>
                                        <td>6,250</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>50,000</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h3>Deduction Amount Rs.</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Deduction</th>
                                        <th scope="col">Amount Rs.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TDS</td>
                                        <td>500</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h2>Net Pay:</h2>
                            <p>In Words: Forty Nine Thousand Five Hundred only.</p>
                            <p>This is system generated payslip & not required for signature.</p>
                            <p>Confidential</p>
                            <p>Varion Advisors Analytics Pvt Ltd.</p>
                            <p>CIN No: U51109UP1974PLC003879</p>
                            <p>49,500</p>
                        </div>

                    </div>
                </div>
            </section>
        </div>
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





</body>

</html>