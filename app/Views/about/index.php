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
                    <!-- <li class="dropdown"><a href="#"><span>Gallery</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
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
                    <li><a href="contact.html">Contact</a></li> -->
                </ul>
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

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>Tak ada yang lebih indah daripada mengabadikan momen ajaib dalam perjalanan cinta <span> Kami tenda hj yus</span> hadir untuk menjadi mitra setia Anda dalam menyusun cerita tak terlupakan sebagai Wedding Organizer.</h2>
                    <p>"Dengan penuh dedikasi dan pengalaman, kami akan merancang setiap detail dengan hati-hati, menghadirkan pernikahan impian Anda menjadi kenyataan yang megah. Seperti seorang seniman, perencanaan kami adalah sapuan kuas yang sempurna, menggambarkan kebahagiaan dan cinta dalam palet warna yang penuh emosi. Bersama, mari kita tuliskan kisah cinta Anda dalam babak baru yang indah, di mana setiap langkah adalah tarian menuju masa depan yang cerah. Saya, Jenny Wilson, Wedding Organizer yang berkomitmen untuk mewujudkan pernikahan yang menginspirasi dan dikenang sepanjang zaman."</p>
                    <!-- <a href="contact.html" class="btn-get-started">Available for hire</a> -->
                </div>
            </div>
        </div>
    </section><!-- End Hero Section -->

    <main id="main" data-aos="fade" data-aos-delay="1500">
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container-fluid">
                <div class="row gy-4 justify-content-center">
                    <?php foreach ($produk as $item) : ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="gallery-item h-100">
                                <img src="<?= base_url('uploads/' . $item['photos_filenames']) ?>" class="img-fluid" alt="<?= $item['nama_produk'] ?>">
                                <div class="gallery-links d-flex align-items-center justify-content-center">
                                    <a href="<?= base_url('uploads/' . $item['photos_filenames']); ?>" title="<?= $item['nama_produk']; ?>" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                    <a href="<?= base_url('home/detail' . $item['produkid']) ?>" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Gallery Item -->
                    <?php endforeach; ?>
                </div>
                <div class="row gy-4 justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="<?= base_url() ?>/video/vd.mp4" class="img-fluid" alt="" type="video/mp4" />>
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="<?= base_url() ?>/video/vd.mp4" title="Video Weddings" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <!-- <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a> -->
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->
                </div>
                <div class="row gy-4 justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item h-100">
                            <img src="<?= base_url() ?>/video/vdd.mp4" class="img-fluid" alt="" type="video/mp4" />>
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="<?= base_url() ?>/video/vdd.mp4" title="Video Weddings" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                <!-- <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a> -->
                            </div>
                        </div>
                    </div><!-- End Gallery Item -->
                </div>
        </section><!-- End Gallery Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Tenda Hj Yus</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
                Designed by <a href="<?= base_url('home') ?>">Tenda Hj. Yus</a>
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