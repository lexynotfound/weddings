<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Reservation</title>
    <!-- Favicon-->
    <!-- Bootstrap icons-->
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
</head>

<body>
    <!-- Navigation-->
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


    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <!-- <div class="row">
                    <section class="content-header">
                        
                        <?php if (session()->has('success')) : ?>
                            <div class="alert alert-success" id="successMessage">
                                <?= session('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->has('error')) : ?>
                            <div class="alert alert-danger" id="errorMessage">
                                <?= session('error') ?>
                            </div>
                        <?php endif; ?>
                    </section>
                </div> -->
                <!-- Product Form Card -->
                <p>Reservation</p>
                <div class="card mt-4">
                    <form action="<?= site_url('reservation/store/'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <!-- Product Details Section -->

                            <!-- Hidden input fields for reservation_detail_id and payment_option -->
                            <input type="hidden" name="transaksi_id" value="<?= $reservation['transaksiid']; ?>">

                            <div class="mb-3">
                                <label for="name" class="form-label">Tanggal Reservation:</label>
                                <input type="date" name="tgl_acara" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Lokasi Pernikahan:</label>
                                <input type="text" name="lokasi" id="lokasi" rows="4" class="form-control" placeholder="Jakarta" required>
                            </div>

                            <div class="row justify-content-center mt-5">
                                <div class="col-md-6 text-center">
                                    <!-- Change the button name to 'dp' -->
                                    <button type="submit" name="payment_option" value="dp" class="btn btn-outline-dark">DP 30% - Rp.<?= number_format($reservation['total_harga'] * 0.3, 0, ',', '.'); ?></button>
                                </div>
                                <div class="col-md-6 text-center">
                                    <!-- Change the button name to 'full' -->
                                    <button type="submit" name="payment_option" value="full" class="btn btn-outline-dark">Pay Full - Rp.<?= number_format($reservation['total_harga'], 0, ',', '.'); ?></button>
                                </div>
                            </div>
                        </div>
                        <!-- ... (code setelahnya) ... -->

                        <!-- ... (code setelahnya) ... -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation section-->
    <div class="container">
        <p class="mt-5">
            1. Untuk melakukan sebuah reservasi tidak boleh di tanggal yang sama
            2. Untuk melakukan reservasi tidak boleh di lakukan dengan secara mendadak
            3. Untuk melakukan reservasi harus ada minimal h-2 setelah ada yang melakukan reservasi di tanggal tersebut
            4. Contoh Jika yang melakukan reservasi itu di tanggal 8/31/2023 maka tidak boleh melakukan di tanggal yang sama
            5. Dan juga harus melakukan reservasi di tanggal berikutnya atau h-2 setelah tanggal 8/31/2023
        </p>
    </div>
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

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    <script>
        const optionItems = document.querySelectorAll('.option-item');
        const selectedOptionLabel = document.getElementById('selectedOptionLabel');

        optionItems.forEach(item => {
            const radioInput = item.querySelector('input[type="radio"]');
            const optionName = item.querySelector('.option-content span').innerText;

            radioInput.addEventListener('click', () => {
                selectedOptionLabel.innerText = 'Pilihan: ' + optionName;
            });
        });
    </script>

    <script>
        function toggleDescription() {
            var descriptionElement = document.getElementById('description');
            var showMoreLink = document.querySelector('.show-more-link');

            if (descriptionElement.style.webkitLineClamp === '3') {
                descriptionElement.style.webkitLineClamp = 'unset';
                showMoreLink.textContent = 'Show Less';
                // Scroll to the bottom of the description
                descriptionElement.scrollIntoView({
                    behavior: 'smooth'
                });
            } else {
                descriptionElement.style.webkitLineClamp = '3';
                showMoreLink.textContent = 'Show More';
            }
        }
    </script>

    <script>
        // Menggunakan JavaScript untuk menghitung 30% dari harga produk
        document.addEventListener('DOMContentLoaded', function() {
            const hargaProduk = <?= $reservation['harga_produk']; ?>; // Ubah variabel $product menjadi sintaks CodeIgniter 4 jika perlu
            const dpPercentage = 0.3;
            const dpAmount = hargaProduk * dpPercentage;
            const formattedDpAmount = dpAmount.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            const buttonElement = document.querySelector('button[name="payment_option"]');
            buttonElement.innerHTML = `DP 30% - ${formattedDpAmount}`;
        });
    </script>

</body>

</html>