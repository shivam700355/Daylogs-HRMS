<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Meta data -->
  <title>DayLogs | Home</title>
  <?php include 'web/include/meta_data.php'; ?>
  
  <!-- Google Analytics Start -->
  <?php include 'web/include/google_analytics.php'; ?>

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

  <!-- Main CSS File -->
  <link href="web/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <?php include 'web/include/header.php'; ?>

  <main class="main">

    <!-- Home Section -->
    <section id="home" class="hero section">
      <div class="hero-bg">
        <img src="web/assets/img/hero-bg-light.webp" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up" class="">Welcome to <span>Daylogs</span></h1>
          <p data-aos="fade-up" data-aos-delay="100" class="">Your Gateway to Efficient Daily Operations<br></p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#about" class="btn-get-started">Get Started</a>
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
          <img src="web/assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>

    </section>
    <!-- /Home Section -->

    <!-- Featured Section -->
    <section id="featured-services" class="featured-services section">
      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-briefcase"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Time Tracking</a></h4>
                <p class="description">Accurate time tracking for streamlined payroll and project management efficiency and accuracy.</p>
              </div>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-card-checklist"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Task Management</a></h4>
                <p class="description">Efficiently organize tasks, delegate responsibilities, and track progress for optimal productivity.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-bar-chart"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Analytics for Optimal Productivity</a></h4>
                <p class="description">Gain valuable insights into workforce performance and trends to enhance productivity.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>
    </section>
    <!-- /Featured Section -->




    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">Who We Are</p>
            <h3>Passionate Innovators Driving HR Efficiency and Success</h3>
            <p class="fst-italic">Dedicated Professionals Committed to Revolutionizing HR Management for Every Organization</p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>Expertise: Our team comprises passionate innovators with extensive experience in HR management and technology, dedicated to driving efficiency and success.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Commitment: We are committed professionals striving to revolutionize HR management for organizations of all sizes, ensuring streamlined processes and enhanced productivity.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Innovation: Through cutting-edge solutions and a relentless pursuit of improvement, we aim to reshape traditional HR practices, empowering businesses to thrive in dynamic environments.</span></li>
            </ul>
            <!-- <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a> -->
          </div>

          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="web/assets/img/about-company-1.jpg" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <img src="web/assets/img/about-company-2.jpg" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-12">
                    <img src="web/assets/img/about-company-3.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

    </section>
    <!-- /About Section -->


    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2 class="">Features</h2>
        <p>Effortlessly track employee time, delegate tasks, and gain valuable insights for enhanced productivity and efficiency</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row justify-content-between">

          <div class="col-lg-5 d-flex align-items-center">

            <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                  <i class="bi bi-briefcase"></i>
                  <div>
                    <h4 class="d-none d-lg-block">Time Tracking</h4>
                    <p>Accurately monitor employee time for payroll and project management, ensuring efficiency and compliance with customizable features tailored to organizational needs</p>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                  <i class="bi bi-card-checklist"></i>
                  <div>
                    <h4 class="d-none d-lg-block">Task Management</h4>
                    <p>
                      Efficiently organize tasks, delegate responsibilities, and track progress to streamline workflows and maximize productivity within your organization's unique requirements
                    </p>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                  <i class="bi bi-bar-chart"></i>
                  <div>
                    <h4 class="d-none d-lg-block">Analytics</h4>
                    <p>
                      Gain valuable insights into workforce performance and trends with comprehensive analytics, empowering informed decision-making and strategic planning for continuous improvement and success
                    </p>
                  </div>
                </a>
              </li>
            </ul><!-- End Tab Nav -->

          </div>

          <div class="col-lg-6">

            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

              <div class="tab-pane fade active show" id="features-tab-1">
                <img src="web/assets/img/tabs-1.jpg" alt="" class="img-fluid">
              </div><!-- End Tab Content Item -->

              <div class="tab-pane fade" id="features-tab-2">
                <img src="web/assets/img/tabs-2.jpg" alt="" class="img-fluid">
              </div><!-- End Tab Content Item -->

              <div class="tab-pane fade" id="features-tab-3">
                <img src="web/assets/img/tabs-3.jpg" alt="" class="img-fluid">
              </div><!-- End Tab Content Item -->
            </div>

          </div>

        </div>

      </div>

    </section>
    <!-- /Features Section -->

    <!-- Features Details Section -->
    <section id="features-details" class="features-details section">

      <div class="container">

        <div class="row gy-4 justify-content-between features-item">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="web/assets/img/features-1.jpg" class="img-fluid" alt="">
          </div>

          <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Unified Dashboard Management: Empowering HR and Clients for Seamless Operations</h3>
              <p>Our integrated dashboard solution provides comprehensive management tools for HR professionals and clients alike, streamlining processes and enhancing collaboration for optimized efficiency and success</p>
              <ul>
                <li><a href="login"><i class="bi bi-browser-chrome"></i> Client Dashboard</a></li>
              </ul>
              <ul>
                <li><a href="login"><i class="bi bi-browser-chrome"></i> HR Dashboard</a></li>
              </ul>

              <!-- <a href="login" class="btn more-btn"> Dashboard Login</li> -->
              </a>
            </div>
          </div>

        </div><!-- Features Item -->

        <div class="row gy-4 justify-content-between features-item">

          <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">

            <div class="content">
              <h3>Comprehensive Employee Dashboard and Mobile App: Empowering Employee Efficiency</h3>
              <p>
                Access our web-based dashboard and mobile apps for Android and iOS, enabling employees to manage tasks, track time, and stay connected anytime, anywhere
              </p>
              <ul>
                <li><a href="https://play.google.com/store/apps"><i class="bi bi-android2"></i></i> Get Android Application</li>
                <li><a href="https://www.apple.com/in/app-store/"><i class="bi bi-apple"></i></i> Get iOS Application</li>
              </ul>
              <p></p>
              <a href="#" class="btn more-btn">Learn More</a>
            </div>

          </div>

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
            <img src="web/assets/img/features-2.jpg" class="img-fluid" alt="">
          </div>

        </div><!-- Features Item -->

      </div>

    </section>
    <!-- /Features Details Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Empowering HR Excellence: Innovate, Engage, Grow with Our Comprehensive HRMS Solutions</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-5">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <i class="bi bi-activity icon"></i>
              <div>
                <h3>HRMS Software Development</h3>
                <p>Tailored HR management systems to streamline HR processes, from recruitment to employee management and payroll.</p>
                <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <i class="bi bi-broadcast icon"></i>
              <div>
                <h3>Employee Self-Service Portals</h3>
                <p>Customized portals empowering employees to manage personal information, leaves, and performance evaluations.</p>
                <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <i class="bi bi-easel icon"></i>
              <div>
                <h3>Time and Attendance Tracking Systems</h3>
                <p>Automated solutions for accurate tracking of employee attendance, leave management, and timesheets</p>
                <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <i class="bi bi-bounding-box-circles icon"></i>
              <div>
                <h3>Performance Management Systems</h3>
                <p>Tools for setting goals, tracking progress, and conducting performance reviews to enhance employee productivity</p>
                <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item item-indigo position-relative">
              <i class="bi bi-calendar4-week icon"></i>
              <div>
                <h3>Payroll Management Software</h3>
                <p>Comprehensive platforms for automating payroll calculations, tax deductions, and salary disbursements</p>
                <a href="#" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
              <i class="bi bi-chat-square-text icon"></i>
              <div>
                <h3>HR Analytics and Reporting</h3>
                <p>Advanced analytics dashboards providing insights into workforce trends, turnover rates, and employee engagement metrics</p>
                <a href="$" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section>
    <!-- /Services Section -->

    <!-- More Features Section -->
    <section id="more-features" class="more-features section">

      <div class="container">



        <div class="row justify-content-around gy-4">

          <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
            <h3>HRMS Mastery: Elevating Organizational Efficiency</h3>
            <p>Effortless integration, intuitive interface: Empower HR excellence with seamless solutions for streamlined operations and enhanced user experience.</p>

            <div class="row">

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-easel flex-shrink-0"></i>
                <div>
                  <h4>Seamless Integration</h4>
                  <p>Bridging HR Processes for Effortless Workflow Harmony.</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-patch-check flex-shrink-0"></i>
                <div>
                  <h4>Intuitive User Experience</h4>
                  <p>Simplifying HR Tasks for Enhanced Efficiency and Satisfaction</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-brightness-high flex-shrink-0"></i>
                <div>
                  <h4>Data Security Assurance</h4>
                  <p>Safeguarding HR Information with Ironclad Protection and Privacy Measures.</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-brightness-high flex-shrink-0"></i>
                <div>
                  <h4>Scalable Solutions</h4>
                  <p>Growing with Your Business, Evolving HR Management for Future Success</p>
                </div>
              </div><!-- End Icon Box -->

            </div>

          </div>

          <div class="features-image col-lg-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
            <img src="web/assets/img/features-3.jpg" alt="">
          </div>

        </div>

    </section>
    <!-- /More Features Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  UPICON has experienced transformative efficiency with this HRMS software. Its seamless integration and intuitive interface have revolutionized our HR management, empowering us to excel in our operations.
                </p>
                <div class="profile mt-auto">
                  <img src="web/assets/img/clients/logo-1.png" class="testimonial-img" alt="">
                  <h3>UPICON</h3>
                  <h4>HR &amp; Admin</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  UFS applauds the exceptional value delivered by this HRMS software. Its effortless integration and user-friendly interface have elevated our productivity, allowing us to focus on strategic initiatives for business growth."
                </p>
                <div class="profile mt-auto">
                  <img src="web/assets/img/clients/logo-2.png" class="testimonial-img" alt="">
                  <h3>UFS Digital</h3>
                  <h4>Manager</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  VAA has witnessed remarkable improvements with this HRMS software. Its intuitive experience and comprehensive features have streamlined our HR processes, driving efficiency and empowering our team to achieve greater success.
                </p>
                <div class="profile mt-auto">
                  <img src="web/assets/img/clients/logo-3.png" class="testimonial-img" alt="">
                  <h3>Varion Advisors Analytics</h3>
                  <h4>HR Department</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  As a representative of UFS, I can testify to the exceptional value provided by this HRMS software. Its effortless integration and user-friendly interface have revolutionized our operations, empowering us to focus on driving business growth.
                </p>
                <div class="profile mt-auto">
                  <img src="web/assets/img/clients/logo-4.png" class="testimonial-img" alt="">
                  <h3>UFS- DEF</h3>
                  <h4>Business Development</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section>
    <!-- /Testimonials Section -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pricing</h2>
        <p>Elevate Your HR Management: Unleash the Power of Our Freeium Service</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>Free Plan</h3>
              <p class="description">Freemium Plan (Up to 10 Employees)</p>
              <h4><sup>Rs</sup> 0<span> / month</span></h4>
              <a href="contact" class="cta-btn">Start a free trial</a>
              <p class="text-center small">No credit card required</p>
              <ul>
                <li><i class="bi bi-check"></i> <span>Pricing: Free for up to 10 employees.</span></li>
                <li><i class="bi bi-check"></i> <span>Time tracking</span></li>
                <li><i class="bi bi-check"></i> <span>Task management</span></li>
                <li><i class="bi bi-check"></i> <span>Monthly Report</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Business Analytics Report</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Productivity Tracking</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Payroll Management</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Customized Features</span></li>
              </ul>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="pricing-item featured">
              <p class="popular">Popular</p>
              <h3>Standard Plan</h3>
              <p class="description">Standard Plan (11 to 99 Employees)</p>
              <h4><sup>Rs</sup> 25<span> / month</span></h4>
              <a href="contact" class="cta-btn">Start a free trial</a>
              <p class="text-center small">No credit card required</p>
              <ul>
                <li><i class="bi bi-check"></i> <span>Pricing: ₹ 25 per active employee per month.</span></li>
                <li><i class="bi bi-check"></i> <span>Time tracking</span></li>
                <li><i class="bi bi-check"></i> <span>Task management</span></li>
                <li><i class="bi bi-check"></i> <span>Monthly Report</span></li>
                <li><i class="bi bi-check"></i> <span>Business Analytics Report</span></li>
                <li><i class="bi bi-check"></i> <span>Productivity Tracking</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Payroll Management</span></li>
                <li class="na"><i class="bi bi-x"></i> <span>Customized Features</span></li>
              </ul>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="pricing-item">
              <h3>Unlimited Plan</h3>
              <p class="description">Unlimited Plan (100+ Employees)</p>
              <h4><sup>Rs</sup> 49K<span> / year</span></h4>
              <a href="contact" class="cta-btn">Start a free trial</a>
              <p class="text-center small">No credit card required</p>
              <ul>
                <li><i class="bi bi-check"></i> <span>Pricing: ₹50,000 annually.</span></li>
                <li><i class="bi bi-check"></i> <span>Time tracking</span></li>
                <li><i class="bi bi-check"></i> <span>Task management</span></li>
                <li><i class="bi bi-check"></i> <span>Monthly Report</span></li>
                <li><i class="bi bi-check"></i> <span>Business Analytics Report</span></li>
                <li><i class="bi bi-check"></i> <span>Productivity Tracking</span></li>
                <li><i class="bi bi-check"></i> <span>Payroll Management</span></li>
                <li><i class="bi bi-check"></i> <span>Customized Features</span></li>
              </ul>
            </div>
          </div><!-- End Pricing Item -->

        </div>

      </div>

    </section>
    <!-- /Pricing Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact us for any queries or suggestions. We're here to assist you and welcome your feedback to enhance our services.</p>
      </div><!-- End Section Title -->
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.208737243694!2d81.0094340748933!3d26.86510846213562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399be39b07860073%3A0xe1c42888acb5bd06!2sVarion%20Advisors%20Analytics!5e0!3m2!1sen!2sin!4v1715170357616!5m2!1sen!2sin" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>Can I customize the HRMS software to match our company's specific needs?</h3>
                <div class="faq-content">
                  <p>Yes, our HRMS software offers extensive customization options to tailor the system according to your organization's unique requirements, ensuring it aligns perfectly with your workflows and processes.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>How secure is our data on the HRMS platform?</h3>
                <div class="faq-content">
                  <p>We prioritize data security and implement robust measures to safeguard your information. Our software complies with industry standards and regulations, and we regularly update our security protocols to protect your data from unauthorized access or breaches.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->


              <div class="faq-item">
                <h3>How easy is it to onboard our employees onto the HRMS platform?</h3>
                <div class="faq-content">
                  <p>Onboarding employees onto our HRMS platform is simple and straightforward. We provide comprehensive training resources and dedicated support to help your team get up to speed quickly and efficiently, ensuring a smooth transition to our system.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Can the HRMS software integrate with other tools we use in our organization?</h3>
                <div class="faq-content">
                  <p>Absolutely, our HRMS software is designed to seamlessly integrate with a wide range of third-party applications such as payroll systems, accounting software, and productivity tools. This ensures smooth data flow and enhances overall efficiency within your organization.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

          
              <div class="faq-item">
                <h3>Can the HRMS software help us with compliance and regulatory requirements?</h3>
                <div class="faq-content">
                  <p>Yes, our HRMS software includes features to assist with compliance and regulatory requirements, such as automated reporting, document management, and compliance tracking. This helps ensure that your organization stays compliant with relevant laws and regulations.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>How does the HRMS software handle employee performance evaluations and feedback?</h3>
                <div class="faq-content">
                  <p>Our HRMS software offers robust performance management features, allowing you to set goals, track progress, conduct evaluations, and provide feedback to employees. This promotes accountability, transparency, and continuous improvement within your organization.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->



  </main>

  <script src="//code.tidio.co/k06librojm4uktbmcjgxpeje3nwkdlzz.js" async></script>

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
  <link rel="stylesheet" href="/manage/app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">

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
                  location.href = 'index';
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