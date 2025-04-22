<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>DayLogs | Contact </title>
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
    <link rel="stylesheet" href="/manage/app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">

    <!-- Main CSS File -->
    <link href="web/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

    <?php include 'web/include/header.php'; ?>
    <main class="main">
        <section class="mt-5 align-items-center justify-content-center">
            <div class="innerpage-banner center bg-overlay-dark-7 py-7" style="background:url(https://img.freepik.com/free-photo/abstract-luxury-gradient-blue-background-smooth-dark-blue-with-black-vignette-studio-banner_1258-90341.jpg?size=626&ext=jpg&ga=GA1.1.1533830957.1714541995&semt=ais) no-repeat; background-size:cover; background-position: center center; height:200px;">
                <div class="container py-5">
                    <div class="row all-text-white justify-content-center">
                        <div class="col-md-12 align-self-center">
                            <h1 class="innerpage-title text-center">Contact</h1>
                            <nav aria-label="breadcrumb" class="text-center"> <!-- Added text-center class here -->
                                <ol class="breadcrumb d-flex justify-content-center ">
                                    <!-- Added d-inline-block class here -->
                                    <li class="breadcrumb-item active"><a href="index.php" style="color: #fff;"><i class="ti-home"></i> Home</a></li>
                                    <li class="breadcrumb-item">Contact</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact" class="contact section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <p>7th Floor, Summit Building, Vibhuti Khand, Gomti Nagar, Lucknow-226010 Uttar Pradesh</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p>+91 92364 54882</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p>support@daylogs.in</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="row gy-4 mt-1">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.208737243694!2d81.0094340748933!3d26.86510846213562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399be39b07860073%3A0xe1c42888acb5bd06!2sVarion%20Advisors%20Analytics!5e0!3m2!1sen!2sin!4v1715170357616!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-lg-6">
                        <form id="contactform" class="php-email-form needs-validation" data-aos="fade-up" data-aos-delay="400" novalidate>
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required="">

                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required="">
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Your mobile" required="">
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" id="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>

                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->
        <?php include 'web/include/footer.php'; ?>



        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
        <script>
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    var forms = document.getElementsByClassName('needs-validation');
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                                // Show error messages for invalid fields
                                $(form).find(':invalid').each(function(index, node) {
                                    $(node).siblings('.invalid-feedback').show();
                                });
                            } else {
                                // Hide all error messages if the form is valid
                                $(form).find('.invalid-feedback').hide();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>

        <script type="text/javascript" language="javascript">
            $(document).ready(function() {
                $(document).on('submit', '#contactform', function(e) {
                    e.preventDefault();
                    $("#spinner-div").show();
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var mobile = $('#mobile').val();
                    var subject = $('#subject').val();
                    var message = $('#message').val();

                    if (name != '' && email != '' && mobile != '' && subject != '' && message != '') {
                        $.ajax({
                            url: "/manage/app/action/add_contact.php",
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                var data = jQuery.parseJSON(data);
                                if (data.valid == 1) {
                                    success_noti(data.message);
                                    $('#contactform')[0].reset(); // Reset the form
                                    setTimeout(function() {
                                        location.href = 'contact.php';
                                    }, 1000);
                                } else {
                                    warning_noti(data.message);
                                }
                            }
                        });
                    } else {
                        info_noti("All fields are required.");
                    }
                });
            });
        </script>


</body>

</html>