<?php require_once('./admin/app/app_include/session.php'); ?>
<?php $token = $_SESSION["token"]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Daylogs | Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="web/assets/img/favicon.png" rel="icon">
    <link href="web/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="web/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="web/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="web/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="web/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="web/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">


    <!-- Main CSS File -->
    <link href="web/assets/css/main.css" rel="stylesheet">

</head>


<body class="index-page">

    <?php include 'web/include/header.php'; ?>
    <main class="main">

        <!-- Password Reset 1 - Bootstrap Brain Component -->
        <section style="background-color: #F9FBFC;">
            <div class="bg-light py-5 py-md-5 mt-5" style="background-color: #F9FBFC;">
                <div class="container py-5">
                    <div class="row justify-content-md-center">
                        <div class="col-12 col-md-4">
                            <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                                <div class="text-center">
                                    <a href="#!">
                                        <img src="https://daylogs.in/web/assets/img/logo.png" alt="BootstrapBrain Logo" width="50" height="46">
                                    </a>


                                    <h4 class="mt-1 mb-3 pb-1">Daylogs</h4>

                                </div>
                                <div class="row gy-3 gy-md-4 overflow-hidden mt-2">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" id="email">
                                            <div class="error"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="number" class="form-label">Enter Aadhar Number <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="error"></div>
                                            <input type="number" class="form-control" name="aadharNumber" id="aadharNumber">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg" type="submit" onclick="validate()" style="background-color: #388DA8;">Change</button>
                                        </div>


                                    </div>
                                </div>
                                <hr class="my-4 border-secondary-subtle">
                                <div class="text-center">
                                    <a href="#!" class="link-secondary text-decoration-none">Log In</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php include 'web/include/footer.php'; ?>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->



    <!-- Vendor JS Files -->

    <script src="web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="web/assets/vendor/php-email-form/validate.js"></script>
    <script src="web/assets/vendor/aos/aos.js"></script>
    <script src="web/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="web/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/admin/app-assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>

    <script src="/admin/app-assets/toast.js"></script>
    <script>
        function validate() {
            var emailField = document.getElementById('email');
            var aadharField = document.getElementById('aadharNumber');
            var email = emailField.value.trim();
            var aadharNumber = aadharField.value.trim();
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email === '' || aadharNumber === '') {
                emailField.style.borderColor = 'red';
                aadharField.style.borderColor = 'red';
                alert("Please fill all the fields");
                return false;
            } else if (!emailPattern.test(email)) {
                emailField.style.borderColor = 'red';
                aadharField.style.borderColor = 'green';
                alert("Please enter a valid email address");
                return false;
            } else if (aadharNumber.length !== 12) {
                emailField.style.borderColor = 'green';
                aadharField.style.borderColor = 'red';
                alert("Aadhar Number must be 12 digits long");
                return false;
            } else {
                emailField.style.borderColor = '#DEE2E6';
                aadharField.style.borderColor = '#DEE2E6';
                alert("Password Reset Link Sent Successfully");
                window.location.href = 'reset.php';
                // Add further validation or processing here
            }
        }
    </script>













</body>

</html>