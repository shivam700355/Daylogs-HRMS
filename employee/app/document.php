<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
$listing = new Listing();
$document = $listing->user_document($_SESSION['u_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DayLogs | Document</title>

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
            <h3 class="card-title">Documents</h3>
            <div class="card-tools">
              <a data-toggle="modal" data-target="#addDocumentModal" class="btn btn-tbl-edit btn-xs btn-primary"><i class="fa fa-plus"></i></a>
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
                        <th>File</th>
                        <th>Type</th>
                        <th>Number</th>
                        <th>Added On</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      while ($row = $document->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        $active      = $row['u_status'];
                        $id          = $row['u_id'];
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td id="previewContainer">
                            <?php
                            $fileExtension = pathinfo($row['doc_file'], PATHINFO_EXTENSION);
                            if ($fileExtension === 'pdf') {
                              echo '<embed src="../app-assets/documents/' . $row['doc_file'] . '" type="application/pdf" style="height: 40px; width: 40px; border-radius: 50%;">';
                              echo '</div>';
                            } else {
                              echo '<img src="../app-assets/documents/' . $row['doc_file'] . '" alt="' . $row['doc_file'] . '" style="height: 40px; width: 40px; border-radius: 50%;">';
                            }
                            ?>
                          </td>


                          <td><?php echo $row['doc_type']; ?></td>
                          <td><?php echo $row['doc_number']; ?></td>
                          <td><?php echo date('d-m-Y h:i A', strtotime($row['created_at'])); ?></td>

                          <td>
                            <a href="../app-assets/documents/<?php echo $row['doc_file']; ?>" class="btn btn-tbl-edit btn-xs btn-primary view-document" data-file="<?php echo $row['doc_file']; ?>" target="_blank">
                              <i class="fa fa-eye"></i>
                            </a>
                          </td>


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

      <div class="modal fade" id="addDocumentModal" tabindex="-1" role="dialog" aria-labelledby="addDocumentModalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addDocumentModalModalLabel">Upload Document</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="DocUploadForm" enctype="multipart/form-data">
                <input type="hidden" name="u_id" id="u_id" value="<?php echo $_SESSION['u_id']; ?>">
                <input type="hidden" name="c_id" id="c_id" value="<?php echo $_SESSION['cid']; ?>">
                <div class="form-group">
                  <label for="doc_type">Document Type</label>
                  <select class="form-control" id="doc_type" name="doc_type">
                    <option value="" disabled selected>Select </option>
                    <option value="Aadhaar">Aadhaar</option>
                    <option value="PAN">PAN</option>
                    <option value="Resume">Resume</option>
                    <option value="Offer Letter">Offer Letter</option>
                    <option value="Resignation">Resignation Letter</option>
                    <option value="Relieving Letter">Relieving Letter</option>
                  </select>
                </div>
                <div class="form-group" id="doc_number_group">
                  <label for="doc_number">Document Number</label>
                  <input type="text" class="form-control" id="doc_number" name="doc_number">
                </div>
                <div class="form-group">
                  <label for="file">Choose File</label>
                  <input type="file" class="form-control-file" id="file" name="file" accept=".png, .jpg, .jpeg, .pdf">
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
              </form>
            </div>
          </div>
        </div>
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
    $(document).ready(function() {
      $(document).on('submit', '#DocUploadForm', function(e) {
        e.preventDefault();
        $("#spinner-div").show();
        var u_id = $('#u_id').val();
        var c_id = $('#c_id').val();
        var doc_type = $('#doc_type').val();
        var doc_number = $('#doc_number').val();
        var formData = new FormData($(this)[0]);

        if (u_id !== '' && doc_type !== '' && doc_number !== '') {
          $.ajax({
            url: 'action/upload_document.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

              var responseData = JSON.parse(response);
              if (responseData.valid == 1) {
                success_noti(responseData.message, responseData.uname);
                setTimeout(function() {
                  location.reload();
                }, 1000);
              } else {
                warning_noti(responseData.message, responseData.uname);

              }
            },
            error: function() {
              console.log('Error uploading file.');
            },
            complete: function() {
              $("#spinner-div").hide();
            }
          });
        } else {
          console.log('Please fill in all fields.');
          // Optionally, provide user feedback here
        }
      });
    });
  </script>


</body>

</html>