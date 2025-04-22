<?php require_once ('./admin/app/app_include/session.php'); ?>
<?php $token = $_SESSION["token"]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta data -->
    <title>Daylogs | Login</title>
    <?php include 'web/include/meta_data.php'; ?>
    <!-- Google Analytics Start -->
    <?php include 'web/include/google_analytics.php'; ?>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="web/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="web/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="web/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="web/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="web/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="web/assets/css/main.css" rel="stylesheet">



    <!-- Main CSS File -->
    <link href="web/assets/css/main.css" rel="stylesheet">

</head>
<style>
    .gradient-custom-2 {
        /* fallback for old browsers */
        background: #338c9e;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, #338c9e, #090979, #338c9e, #090979);

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, #338c9e, #090979, #338c9e, #090979);
    }

    @media (min-width: 768px) {
        .gradient-form {
            height: 100vh !important;
        }
    }

    @media (min-width: 769px) {
        .gradient-custom-2 {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
        }
    }

    .form-style input {
        border: 0;
        height: 50px;
        border-radius: 0;
        border-bottom: 1px solid #ebebeb;
    }

    .form-style input:focus {
        border-bottom: 1px solid #007bff;
        box-shadow: none;
        outline: 0;
        background-color: #ebebeb;
    }

    .sideline {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #ccc;
    }

    button {
        height: 50px;
    }

    .sideline:before,
    .sideline:after {
        content: '';
        border-top: 1px solid #ebebeb;
        margin: 0 20px 0 0;
        flex: 1 0 20px;
    }

    .sideline:after {
        margin: 0 0 0 20px;
    }
</style>

<body class="index-page">

    <?php include 'web/include/header.php'; ?>
    <main class="main">
        <section class="h-100 gradient-form mb-0" style="background-color: #eee;" id="featured-services">
            <div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-12 col-sm-10 col-md-6 col-lg-4 col-xl-5 col-xxl-5 order-2 order-md-1 d-none d-md-block"
                        style="background-color: white;">
                        <div>
                            <img src="https://img.freepik.com/free-vector/global-data-security-personal-data-security-cyber-data-security-online-concept-illustration-internet-security-information-privacy-protection_1150-37336.jpg?size=626&ext=jpg&ga=GA1.1.310987012.1712215352&semt=sph"
                                class="img-fluid" style="height: 450px; width:100%" />

                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-6 col-lg-4 col-xl-5 col-xxl-5 order-1 order-md-2"
                        style="background-color: white;">
                        <div class="bg-white mt-5">
                            <div class="text-center">
                                <img src="web/assets/img/logo.png" style="width: 50px;" alt="logo">
                                <h4 class="mt-1 mb-3 pb-1">Daylogs</h4>
                            </div>
                            <div class="form-style">
                                <form id="loginform">
                                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
                                    <div class="form-group pb-3">
                                        <input type="text" name="username" placeholder="Email / Mobile"
                                            class="form-control" id="username" aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="form-group pb-3">
                                        <input type="password" name="password" placeholder="Password"
                                            class="form-control" id="password" required>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">

                                        <div><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Forget
                                                Password?</a></div>

                                    </div>
                                    <div class="pb-2">
                                        <button type="button" id="loginBtn"
                                            class="btn btn-primary w-100 font-weight-bold mt-2">
                                            <i class="fa fa-facebook" aria-hidden="true"></i> Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-11" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Forget Password</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 col-lg-12 col-xl-12">
                                        <div class="card-body p-3 p-md-12 p-xl-12">
                                            <form action="#!">
                                                <div class="row gy-3 overflow-hidden">
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3">
                                                            <div class="col-sm-12">
                                                                <input type="email" class="form-control form-control"
                                                                    name="email" id="email"
                                                                    placeholder="name@example.com" required>
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary btn" type="submit">Reset
                                                                Password</button>
                                                        </div>
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
    </main>
    <script src="//code.tidio.co/k06librojm4uktbmcjgxpeje3nwkdlzz.js" async></script>
    <?php include 'web/include/footer.php'; ?>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="web/assets/vendor/php-email-form/validate.js"></script>
    <script src="web/assets/vendor/aos/aos.js"></script>
    <script src="web/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="web/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="web/assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/manage/app-assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
    <script src="/manage/app-assets/toast.js"></script>
    <link rel="stylesheet" href="/manage/app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">



    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.getElementById('loginform').reset();
            document.getElementById('loginBtn').addEventListener('click', function () {
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;

                if (username.trim() === '' || password.trim() === '') {
                    info_noti("Username or password cannot be empty.");
                    return;
                }

                var formData = new FormData(document.getElementById('loginform'));

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/app/action/login', true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.valid === 1) {
                                success_noti(response.message, response.uname);
                                setTimeout(function () {
                                    if (response.urole === 'Admin') {
                                        window.location.href = 'admin/app/home';
                                    } 
                                    else if (response.urole === 'Human Resources') {
                                        window.location.href = 'admin/app/home';
                                    }
                                    else if (response.urole === 'Manager') {
                                        window.location.href = 'admin/app/home';
                                    }
                                    else if (response.urole === 'Employee') {
                                        window.location.href = 'employee/app/home';
                                    }
                                }, 1000);
                            } else {
                                warning_noti(response.message, response.uname);
                            }
                        } else {
                            error_noti("An error occurred. Please try again later.");
                        }
                        document.getElementById('loginBtn').disabled = false;
                        document.getElementById('loginBtn').innerHTML = 'Log in';
                    } else {
                        document.getElementById('loginBtn').disabled = true;
                        document.getElementById('loginBtn').innerHTML = '<i class="fa fa-spinner fa-pulse fa-fw"></i> Logging in...';
                    }
                };

                xhr.send(formData);
            });
        });
    </script>



</body>

</html>