<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  </head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
                <?php
                if(isset($success)){ ?>
                <div class="alert alert-success">
                    <?php  echo $success;?>
                </div>
                <?php  } ?>
              <form action="{{ route('login') }}" method="POST" class="pt-3">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="inputEmail" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="inputPassword" placeholder="Password">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
            </form>
                <a href="{{ route('register') }}" class="" style="color: #4B49AC;float:right;">Create a account</a>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->


  <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting normally

      // Get the input values
      var email = document.getElementById('inputEmail').value;
      var password = document.getElementById('inputPassword').value;

      // Send a POST request to your API endpoint
      fetch('https://daylogs.in/APIs/employee/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          email: email,
          password: password
        }),
      })
      .then(response => {
        if (response.ok) {
          // Handle successful login (e.g., redirect to another page)
            localStorage.setItem('user_email', email);
            window.location.href = '{{ route("layout") }}'; // Assuming 'dashboard' is your dashboard route name        
            // Show success message
            var successMessage = document.createElement('div');
            successMessage.classList.add('alert', 'alert-success');
            successMessage.textContent = 'Successfully logged in. Welcome!';
            document.body.appendChild(successMessage);
        } else {
          // Handle login error (e.g., display error message)
          console.error('Login failed');
        }
      })
      .catch(error => {
        // Handle network error
        console.error('Network error:', error);
      });
    });
  </script>
</body>
</html>
