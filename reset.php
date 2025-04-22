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
        <section class="h-100 gradient-form" style="background-color: #F9FBFC;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-5">
                        <div class="card-body p-md-5 mx-md-4">
                            <form id="loginform" class="p-3 my-4 mb-5 bg-white rounded" style="box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                <div class="text-center">
                                    <div class="my-4">

                                    </div>
                                    <img src="web/assets/img/logo.png" style="width: 50px;" alt="logo">
                                    <h4 class="mt-1 mb-3 pb-1">Daylogs</h4>
                                </div>

                                <div class="mb-3 my-4 form-group">
                                    <label class="form-label" for="password">Enter Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="passwordField" class="form-control" placeholder="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-light" id="togglePasswordField"><i class="bi bi-eye"></i></span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="token" id="token" value="token">
                                </div>
                                <div class="mb-3 form-group">
                                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="confirmPassword" id="confirmPasswordField" class="form-control" placeholder="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-light" id="toggleConfirmPasswordField"><i class="bi bi-eye"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mb-5">
                                    <button id="loginBtn" class="btn btn-primary" style="background-color: #388DA8;" type="button">Reset</button>
                                </div>
                            </form>


                        </div>


                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include 'web/include/footer.php'; ?>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script>
        document.getElementById("loginBtn").addEventListener("click", function() {
            var password = document.getElementById("passwordField").value;
            var confirmPassword = document.getElementById("confirmPasswordField").value;

            // Regular expression for password validation
            var passwordPattern = /^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#]).{8,}$/;

            if (!passwordPattern.test(password)) {
                alert("Password must contain at least one number, one character, and one of the special characters '@' or '#', and must be at least 8 characters long.");
                return;
            }

            if (password !== confirmPassword) {
                alert("Password and Confirm Password do not match.");
                return;
            }

            // Password and validation passed
            alert("Password Reset Successfully.");
        });
    </script>
    <script>
        document.getElementById("togglePasswordField").addEventListener("click", function() {
            togglePasswordVisibility("passwordField", "togglePasswordField");
        });

        document.getElementById("toggleConfirmPasswordField").addEventListener("click", function() {
            togglePasswordVisibility("confirmPasswordField", "toggleConfirmPasswordField");
        });

        function togglePasswordVisibility(passwordFieldId, toggleButtonId) {
            var passwordField = document.getElementById(passwordFieldId);
            var icon = document.getElementById(toggleButtonId).querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>









    <!-- Vendor JS Files -->


    <script src="web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="web/assets/vendor/php-email-form/validate.js"></script>
    <script src="web/assets/vendor/aos/aos.js"></script>
    <script src="web/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="web/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/admin/app-assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>

    <script src="/admin/app-assets/toast.js"></script>

</body>

</html>