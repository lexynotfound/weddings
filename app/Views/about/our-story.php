<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
   <!--  <link href="<?= base_url() ?>/src/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url() ?>/src/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/src/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/src/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>/src/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/src/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/src/assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/src/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>


<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="<?= base_url('about') ?>" class="logo d-flex align-items-center  me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <img src="<?= base_url() ?>/images/logo.jpg" class="img-fluid">
                <h1>Tenda Hj Yus</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="<?= base_url('about') ?>" class="active">Home</a></li>
                    <li><a href="<?= base_url('about/our-story') ?>">About</a></li>
                   <!--  <li class="dropdown"><a href="#"><span>Gallery</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="gallery.html">Nature</a></li>
                            <li><a href="gallery.html">People</a></li>
                            <li><a href="gallery.html">Architecture</a></li>
                            <li><a href="gallery.html">Animals</a></li>
                            <li><a href="gallery.html">Sports</a></li>
                            <li><a href="gallery.html">Travel</a></li>
                            <li class="dropdown"><a href="#"><span>Sub Menu</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                                <ul>
                                    <li><a href="#">Sub Menu 1</a></li>
                                    <li><a href="#">Sub Menu 2</a></li>
                                    <li><a href="#">Sub Menu 3</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul> -->
            </nav><!-- .navbar -->

            <div class="header-social-links">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->

    <main id="main" data-aos="fade" data-aos-delay="1500">

        <!-- ======= End Page Header ======= -->
        <div class="page-header d-flex align-items-center">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>About</h2>
                        <p>Tenda Hj. Yus merupakan bisnis yang didirikan pada tahun 2000 oleh Hj. Yus serta adiknya bernama Pak Nur yang berawal membangun usaha dengan melakukan penyewaan kursi serta tenda yang bersifat kecil untuk orang sekitar.</p>

                        <!-- <a class="cta-btn" href="contact.html">Available for hire</a> -->

                    </div>
                </div>
            </div>
        </div><!-- End Page Header -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-4">
                        <img src="<?= base_url() ?>/images/logo.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-5 content">
                        <h2>Weddings Organizer</h2>
                        <p class="fst-italic py-3">
                            
                        </p>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Founded:</strong> <span>At 2000 Years</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <a href="<?= base_url('home') ?>"><span>www.tendahjyus.com</span></a></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong><a href="<?= base_url('https://wa.me/+621295304698') ?>"><span>+6212 9530 4698</span></a></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>Tangerang City</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>30</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Service:</strong> <span>Excellent </span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>tendahjyus@tendahjyus.com</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Reservation:</strong> <span>Available</span></li>
                                </ul>
                            </div>
                        </div>
                        <p class="py-3">
                            Namun Pak Nur membesarkan bisnis tersebut menjadi dikenal dikisaran Ciledug dan sekitarannya, lalu Hj Yus melanjutkan bisnis tersebut selama 7 tahun selang selama 7 tahun di jalani oleh anak nya bernama Ardi hingga saat ini.
                        </p>
                        <p class="m-0">
                            Usaha tenda Hj Yus menyediakan perlengkapan pernikahan seperti dekorasi, makeup, cathering dan perlengkapan lainnya untuk membantu calon pengantin.
                        </p>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Testimonials Section ======= -->
        <!-- <section id="testimonials" class="testimonials">
            <div class="container">

                <div class="section-header">
                    <h2>Testimonials</h2>
                    <p>Perjalanan Kami</p>
                </div>

                <div class="slides-3 swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>/src/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                                    <h3>Saul Goodman</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                </div>
                            </div>
                        </div> -->
                        <!-- End testimonial item -->
                       <!--  <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>/src/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                                    <h3>Sara Wilsson</h3>
                                    <h4>Designer</h4>
                                </div>
                            </div>
                        </div> -->
                        <!-- End testimonial item -->
                        <!-- <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>/src/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                                    <h3>Jena Karlis</h3>
                                    <h4>Store Owner</h4>
                                </div>
                            </div>
                        </div> -->
                        <!-- End testimonial item -->
                       <!--  <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>/src/assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                                    <h3>Matt Brandon</h3>
                                    <h4>Freelancer</h4>
                                </div>
                            </div>
                        </div> -->
                        <!-- End testimonial item -->
                        <!-- <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="<?= base_url() ?>/src/assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                                    <h3>John Larson</h3>
                                    <h4>Entrepreneur</h4>
                                </div>
                            </div>
                        </div> -->
                        <!-- End testimonial item -->
                  <!--   </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div> -->
       <!--  </section> --><!-- End Testimonials Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Tenda Hj. Yus</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
                Design by <a href="<?= base_url('home') ?>">Tenda Hj.Yus</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader">
        <div class="line"></div>
    </div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/src/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/src/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>/src/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url() ?>/src/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url() ?>/src/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>/src/assets/js/main.js"></script>

</body>

</html>