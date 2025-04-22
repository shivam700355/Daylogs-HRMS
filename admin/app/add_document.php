<?php require_once("app_include/session.php"); ?>
<?php require_once("app_include/function.php"); ?>
<?php include 'action/class/listing-class.php'; ?>
<?php $token = $_SESSION["token"]; ?>
<?php is_logged_in(); ?>
<?php
   $listing = new Listing();
   $contact = $listing->contact_list();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VCREDIL | Contact List</title>

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
  <link rel="shortcut icon" href="../app-assets/dist/img/vcredil-round-logo.png">

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

      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3>Contact</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-plus"></i>  Add</a></li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
         <div class="col-sm-4 col-md-12 col-lg-4">
            <div class="card card-box">
               <div class="card-head">
                  <header>Add Certificate</header>
               </div>
               <div class="card-body">
                  <form id="clientsadd" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="form-group col-md-12">
                          <label for="pt_type">Name</label>
                          <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Enter Certificate Name ">
                        </div>
                    </div>
                    <div class="row">
                       <div class="form-group col-md-12">
                          <label for="articles_discreption">Image</label>
                          <input type="file" class="form-control" name="file" id="file">
                          </textarea>
                       </div>
                    </div> 

                     <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
                     <button type="submit" id="submit"  class="btn btn-primary">Submit</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-sm-8 col-md-12 col-lg-8">
         <div class="card">
                <div class="card-body">
                  <!-- <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h1 class="card-title">User List</h1><a href="user_registration"><i class="fas fa-plus"></i>  Add</a>
                    </div>
                  </div> -->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      while ($row = $contact->fetch(PDO::FETCH_ASSOC)) {
                        $i++;
                        $active      = $row['status'];
                        
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['mobile']; ?></td>
                          <td><?php echo $row['subject']; ?></td>
                          <td><?php echo $row['message']; ?></td>
                          <td><label class="switch">
                              <?php
                              $activeText = "";
                              if ($active == 0) {
                                $activeText = " ";
                              } else {
                                $activeText = "checked";
                              }
                              ?>
                              <input type="checkbox" <?php echo $activeText; ?> class="active" id='<?php echo $id . '_' . $active ?>'><span class="slider"></span></label>
                          </td>
                          <td>
                            <button class="delete btn btn-tbl-delete btn-xs btn-danger" id="<?php echo $id; ?>">
                              <i class="fa fa-trash "></i></button>
                              <a href="user_dashboard?id=<?php echo $row['u_id']; ?>" target="_blank" class="btn btn-tbl-edit btn-xs btn-primary">
                              <i class="fa fa-eye"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>

                  </table>
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
        "buttons": ["csv", "excel", "pdf", "print", "colvis"]
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
  <script type="text/javascript" language="javascript">
    // Enable/Disable Tender.
    $('.active').click(function() {
      var id = this.id;
      var split_id = id.split("_");
      var status = split_id[1];
      var user_id = split_id[0];
      // Get active state
      var active = 0;
      if (status == 1) {
        active = 0;
      } else {
        active = 1;
      }
      // AJAX request
      $.ajax({
        url: 'action/user_status_update',
        type: 'post',
        data: {
          user_id: user_id,
          active: active,
          request: 1
        },


        success: function(data) {
          var data = jQuery.parseJSON(data);

          if (data.valid == 1) {
            success_noti(data.message);

            setTimeout(function() {
              location.reload();
            }, 1000);

            return false;
          } else {
            warning_noti(data.message);
            return false;
          }

        }
      });
    });
  </script>
  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      // delete Album
      $('.delete').click(function() {
        if (confirm('This action will delete this record. Are you sure?')) {
          var uid = this.id;
          // AJAX request
          $.ajax({
            url: 'action/user_status_update',
            type: 'post',
            data: {
              uid: uid,
              request: 2
            },

            success: function(data) {
              var data = jQuery.parseJSON(data);

              if (data.valid == 1) {
                success_noti(data.message);

                setTimeout(function() {
                  location.reload();
                }, 1000);

                return false;
              } else {
                warning_noti(data.message);
                return false;
              }

            }
          });
        }
      });

    });
  </script>
</body>

</html>