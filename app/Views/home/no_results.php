<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/caraousel.css">
    <link href="<?= base_url(); ?>/src/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/src/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/src/fontawesome-free-6.4.0/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Vj6tzy4Hg7J1K25b4ml2p15zYLq6xWq5rI3/ABttrKA2Ap" crossorigin="anonymous">

    <style>
        .custom-card-img {
            width: 100%;
            /* Sesuaikan lebar gambar */
            max-height: 150px;
            /* Sesuaikan tinggi gambar */
            object-fit: cover;
            /* Agar gambar tetap terlihat proporsional */
        }
    </style>
</head>

<body>

    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F4F5F4;">
            <!-- Container wrapper -->
            <div class="container justify-content-end justify-content-md-between">
                <!-- Toggle button -->

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                    <!-- Right-aligned links -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark" aria-current="page" href="<?= base_url('about') ?>">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="<?= base_url('about') ?>">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">FAQs</a>
                        </li>
                    </ul>
                    <!-- Right-aligned links -->
                </div>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>


    <header class="sticky-top">
        <!-- Jumbotron -->
        <div class="p-3 text-center bg-white border-bottom mt-2">
            <div class="container">
                <div class="row gy-4">
                    <!-- Left elements -->
                    <div class="col-lg-2 col-sm-4 col-4 row justify-content-center">
                        <a href="<?= base_url('home') ?>" class="float-start">
                            <img src="<?= base_url() ?>/images/logo.jpg" height="120" width="120" />
                        </a>
                    </div>
                    <!-- Left elements -->

                    <!-- Center elements -->
                    <div class="order-lg-last col-lg-5 col-sm-8 col-8">
                        <div class="d-flex float-end">
                            <nav class="navbar navbar-expand-lg bg-white ms-auto">
                                <!-- ... (rest of the header code) ... -->
                                <div class="container">

                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse custom-dropdown" id="navbarNav">
                                        <ul class="navbar-nav ms-auto">
                                            <div class="topbar-divider d-none d-sm-block"></div>

                                            <!-- Bell Notification Dropdown -->

                                            <!-- Chat Notification Dropdown -->

                                            <!-- WhatsApp Icon -->
                                            <div class="me-3">
                                                <a class="nav-link" href="https://wa.me/+6288975562380" id="chatDropdown" target="_blank" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <img src="<?= base_url(); ?>/images/WhatsApp.png" style="width: 40px; height: 40px;" alt="">
                                                </a>
                                            </div>


                                            <!-- Nav Item - User Information -->
                                            <li class="nav-item dropdown no-arrow">
                                                <!-- ... (rest of the user information dropdown code) ... -->
                                                <?php if (logged_in()) : ?>

                                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="mr-4 d-none d-lg-inline text-gray-600 small me-1"><?= user()->username; ?></span>
                                                        <?php
                                                        $foto = user()->foto;
                                                        if ($foto === 'default.png') {
                                                        ?>
                                                            <img class="img-profile rounded-circle ms-auto" src="<?= base_url(); ?>/images/<?= user()->foto; ?>" alt="Foto Profile" style="width: 40px; height: 40px;">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="<?= base_url('uploads/' . $foto); ?>" class="img-profile rounded-circle ms-auto" alt="Foto Profile" style="width: 40px; height: 40px;">
                                                        <?php
                                                        }
                                                        ?>
                                                    </a>
                                                    <!-- Dropdown - User Information -->
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                                        <?php if (in_groups('admin')) : ?>
                                                            <a class="dropdown-item" href="<?= base_url('admin'); ?>">
                                                                <i class="fas fa-fw fa-tachometer-alt mr-2 text-gray-400"></i>
                                                                Dashboard
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                        <?php endif; ?>
                                                        <a class="dropdown-item" href="<?= base_url('user/setting'); ?>">
                                                            <i class="fas fa-solid fa-sliders-alt mr-2 text-gray-400"></i>
                                                            Reservation
                                                        </a>
                                                        <a class="dropdown-item" href="<?= base_url('user/setting'); ?>">
                                                            <i class="fas fa-solid fa-sliders-alt mr-2 text-gray-400"></i>
                                                            Transaction
                                                        </a>
                                                        <a class="dropdown-item" href="<?= base_url('user/setting'); ?>">
                                                            <i class="fas fa-solid fa-sliders-alt mr-2 text-gray-400"></i>
                                                            Settings
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Logout
                                                        </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="d-flex btn-container gap-3 ml-5">
                                                        <a href="<?= base_url('login'); ?>" class="text-decoration-none">
                                                            <button class="btn btn-info text-white " type="submit">
                                                                Login
                                                            </button>
                                                        </a>
                                                        <a href="<?= base_url('register'); ?> " class="text-decoration-none">
                                                            <button class="btn btn-info text-white" type="submit">
                                                                Register
                                                            </button>
                                                        </a>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Center elements -->

                    <!-- Right elements -->
                    <div class="col-lg-5 col-md-12 col-12">
                        <div class="input-group float-center row justify-content-center">
                            <div class="form-outline">
                                <!-- Search form -->
                                <form action="<?= base_url('home/search'); ?>" method="get" class="d-flex align-items-center" id="searchForm">
                                    <input type="text" id="inputPassword5" name="q" class="form-control form-control-md" aria-labelledby="passwordHelpBlock" placeholder="Search" style="width: 100%;">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Right elements -->
                </div>
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light ms-xl-5 justify-content-center" style="background-color: #ffffff;">
                    <!-- Container wrapper -->
                    <div class="container ms-xl-5 justify-content-center justify-content-md-center">
                        <!-- Toggle button -->

                        <!-- Collapsible wrapper -->
                        <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                            <!-- Center-aligned links -->
                            <ul class="navbar-nav ms-xl-5 mb-2 mb-lg-0 justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" aria-current="page" href="<?= base_url('home') ?>">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="<?= base_url('category') ?>">Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="<?= base_url('best') ?>">Best</a>
                                </li>
                            </ul>
                            <!-- Center-aligned links -->
                        </div>
                    </div>
                    <!-- Container wrapper -->
                </nav>
                <!-- Navbar -->
            </div>
        </div>
        <!-- Jumbotron -->
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center">
                    <img src="<?= base_url() ?>/images/notfounds.jpg" alt="No Results" width="400" height="400" class="d-inline-block align-text-top img-fluid">
                    <h2 class="mt-4">Tidak Ada Paket atau Hasil Pencarian Tidak Ditemukan</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- Footer -->
    <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
            <div class="col mb-3">
                <!-- logo -->
                <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                    <img class="bi me-2" width="200" src="<?= base_url(); ?>/images/logo.jpg">

                    </img>
                </a>
                <p class="text-muted">Copyrigth &copy; Tenda Hj.Yus <?= date('Y'); ?></p>

            </div>

            <div class="col mb-3">

            </div>

            <div class="col mb-3">
                <h5>Tenda Hj. Yus</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="<?= base_url('home') ?>" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="<?= base_url('user/transaksi') ?>" class="nav-link p-0 text-muted">Orders History</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>TENTANG KAMI</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="<?= base_url('about') ?>" class="nav-link p-0 text-muted">About</a></li>
                    <li class="nav-item mb-2"><a href="<?= base_url('about') ?>" class="nav-link p-0 text-muted">Contact</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <!-- <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                </ul>
            </div> -->
        </footer>
    </div>
    <!-- End of Footer -->

    <a class="scroll-to-top rounded" href="#">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- End of Footer -->
    <!-- Script -->
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/src/jquery/jquery.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/src/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/src/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/src/js/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>/src/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url(); ?>/src/js/demo/chart-pie-demo.js"></script>
    <script src="<?= base_url(); ?>/src/js/message.js"></script>
    <script src="<?= base_url(); ?>/src/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url(); ?>/src/js/dropdown-hoover.js"></script>

    <script src="<?= base_url(); ?>/src/js/disablescrool.js"></script>

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.12.0/dist/umd/popper.min.js" integrity="sha384-N5ZRprfQq9MgP13e+t4FkTqi7X9WVj54V2VXpOD4z8B65C7BK2gjHdouP84fS7Ld" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-B4gt1FWAbeJ3GzFQNzppbXk6v5zxG4T/4By2vckIgXvb7bPLhpvGhmfhA1t1b8RM" crossorigin="anonymous"></script>
    <script>
        // Carousel Slide Effect
        const carousel = document.getElementById('carouselExample');
        let isSliding = false;
        carousel.addEventListener('slide.bs.carousel', () => {
            if (!isSliding) {
                isSliding = true;
                carousel.querySelectorAll('.carousel-item').forEach(item => {
                    item.classList.add('sliding');
                });
            }
        });
        carousel.addEventListener('slid.bs.carousel', () => {
            isSliding = false;
            carousel.querySelectorAll('.carousel-item').forEach(item => {
                item.classList.remove('sliding');
            });
        });

        // Show arrows on hover
        document.getElementById('carouselExample').addEventListener('mouseenter', function() {
            document.querySelector('.carousel-control-prev').style.display = 'block';
            document.querySelector('.carousel-control-next').style.display = 'block';
        });

        document.getElementById('carouselExample').addEventListener('mouseleave', function() {
            document.querySelector('.carousel-control-prev').style.display = 'none';
            document.querySelector('.carousel-control-next').style.display = 'none';
        });
    </script>

    <script>
        // Tangkap elemen formulir pencarian
        const searchForm = document.getElementById('searchForm');

        // Tambahkan event listener pada elemen input
        searchForm.addEventListener('keyup', function(event) {
            // Pastikan tombol yang ditekan adalah Enter (kode 13)
            if (event.keyCode === 13) {
                // Kirim formulir pencarian
                searchForm.submit();
            }
        });
    </script>

    <!-- Hanya jika Anda belum memasukkan perpustakaan ion-rangeslider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    <script>
        const priceRangeMinInput = document.getElementById("priceRangeMin1");
        const priceRangeMaxInput = document.getElementById("priceRangeMax1");
        const rangeInput = document.getElementById("customRange2");

        function formatCurrency(amount) {
            return "Rp." + new Intl.NumberFormat("id-ID").format(amount);
        }

        function parseCurrency(value) {
            return parseInt(value.replace(/[^\d]/g, ""));
        }

        rangeInput.addEventListener("input", function() {
            const selectedValue = parseInt(rangeInput.value);
            priceRangeMinInput.value = formatCurrency(selectedValue);
            priceRangeMaxInput.value = formatCurrency(selectedValue);
        });

        priceRangeMinInput.addEventListener("input", function() {
            const amount = parseCurrency(priceRangeMinInput.value);
            rangeInput.value = amount;
            priceRangeMinInput.value = formatCurrency(amount);
        });

        priceRangeMaxInput.addEventListener("input", function() {
            const amount = parseCurrency(priceRangeMaxInput.value);
            rangeInput.value = amount;
            priceRangeMaxInput.value = formatCurrency(amount);
        });
    </script>


</body>

</html>