<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="animated-title"><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/caraousel.css">
    <link href="<?= base_url(); ?>/src/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="<? base_url() ?>/src/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS untuk animasi judul */
        .animated-title {
            white-space: nowrap;
            overflow: hidden;
            animation: animateTitle 8s linear infinite;
            /* 8 detik untuk satu putaran animasi */
        }

        /* Keyframes untuk animasi judul */
        @keyframes animateTitle {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
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

                                            <a class="nav-link dropdown-toggle" href="https://wa.me/+621295304698" id="chatDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?= base_url(); ?>/images/WhatsApp.png" style="width: 40px; height: 40px;" alt="">
                                                <!-- <i class=" fas fa-brands fa-square-whatsapp"></i> -->
                                                <!-- Notification Badge (optional) -->
                                                <!-- <span class="badge bg-danger">5</span> -->
                                            </a>


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

    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <!-- Check if the product data is available -->

            <!-- Product Description (col-md-12) -->
            <div class="d-flex justify-content-center align-items-center" role="alert" style="height: 300px;">
                <div class="text-center">
                    <img src="<?= base_url() ?>/images/notproduct.svg" alt="Package not found." class="img-fluid mb-3" style="max-width: 350px;" />
                    <p class="mb-2" style="font-size: 30px; font-weight: bold;">Yaah Sayang Sekali Paket Yang anda cari tidak ada. Mungkin ada di tempat lain</p>
                    <a href="<?= base_url('home') ?>">
                        <button class="btn btn-info">Mungkin Disi</button>
                    </a>
                </div>
            </div>

        </div>
    </section>
</body>


<!-- <script>
    // Fungsi untuk melakukan self-refresh setiap 5 detik
    function selfRefresh() {
        setTimeout(function() {
            location.reload();
        }, 10000); // Waktu dalam milidetik (misalnya 5000 = 5 detik)
    }

    // Panggil fungsi selfRefresh saat halaman selesai dimuat
    window.onload = selfRefresh;
</script> -->

</html>