<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <script src="/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.115.4">
    <title><?= $title; ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/mystyle.css">
    <link href="<?= base_url(); ?>/src/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/src/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/src/fontawesome-free-6.4.0/css/all.css" rel="stylesheet" type="text/css">

    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="checkout.css" rel="stylesheet">
</head>

<body class="bg-white">

    <header>
        <div class="container mt-4">
            <nav class="navbar navbar-expand-lg ms-auto">
                <!-- ... (rest of the header code) ... -->
                <div class="container">
                    <a class="navbar-brand" href="<?= base_url('home'); ?>">
                        <img src="<?= base_url(); ?>/images/logo.jpg" alt="logo" srcset="" width="100" height="100" class="d-inline-block align-text-top">
                    </a>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8"> <!-- Adjust the column width as needed -->
                                <form action="" class="d-flex align-items-center">
                                    <input type="text" id="inputPassword5" class="form-control form-control-md" aria-labelledby="passwordHelpBlock" placeholder="Search" style="width: 100%;"> <!-- Adjust the width as needed -->
                                </form>
                            </div>
                        </div>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse custom-dropdown" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Bell Notification Dropdown -->

                            <!-- Chat Notification Dropdown -->
                            <li class="nav-item dropdown no-arrow me-1">
                                <a class="nav-link dropdown-toggle" href="https://wa.me/+621295304698" id="chatDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?= base_url(); ?>/images/WhatsApp.png" style="width: 40px; height: 40px;" alt="">
                                    <!-- <i class=" fas fa-brands fa-square-whatsapp"></i> -->
                                    <!-- Notification Badge (optional) -->
                                    <!-- <span class="badge bg-danger">5</span> -->
                                </a>
                            </li>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <!-- ... (rest of the user information dropdown code) ... -->
                                <?php if (logged_in()) : ?>

                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-4 d-none d-lg-inline text-gray-600 small me-1"><?= user()->username; ?></span>
                                        <img class="img-profile rounded-circle ms-auto" src="<?= base_url(); ?>/images/<?= user()->foto; ?>" alt="Foto Profile" style="width: 40px; height: 40px;">
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
    </header>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
        </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text" style="">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>


    <div class="container">
        <main>
            <div class="row">
                <div class="col mt-3">
                    <nav aria-label="breadcrumb" class="bg-white rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<? base_url('home/produk') ?>">Detail</a></li>
                            <li class="breadcrumb-item"><a href="<? base_url('home/produk') ?>"><?= $reservation['nama_produk']; ?></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('payment') ?>">Payment</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $reservation['id_transaksi']; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="py-5 text-center border mt-3 rounded">
                <div class="row">
                    <div class="col-md-4 d-flex align-items-start justify-content-center">
                        <img class="d-block mb-4 ms-3 rounded" src="<?= base_url() ?>/images/3289863.jpg" alt="payment-couple" width="250" height="250">
                    </div>
                    <div class="col-md-8 d-flex align-items-center ">
                        <figure class="text-center">
                            <blockquote class="blockquote">
                                <p>“Love recognises no barriers, it jumps hurdles, leaps fences, penetrates walls to arrive at its destination, full of hope.”</p>
                            </blockquote>
                            <figcaption class="blockquote-footer">
                                Maya Angelou <cite title="Source Title"> Novel And Still I Rise</cite>
                            </figcaption>
                            <p>And Check Again Your Package For your best Weddings</p>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="row g-5 mt-2">
                <div class="col-md-5 col-lg-4 order-md-last sticky-top">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Detail Order</span>
                        <span class="badge bg-primary rounded-pill">2</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Package Name</h6>
                                <small class="text-body-secondary"><?= $reservation['nama_produk']; ?></small>
                            </div>
                            <span class="text-body-secondary">Rp.<?= number_format($reservation['harga_produk'], 0, ',', '.'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (IDR)</span>
                            <strong name="total_harga">Rp.<?= number_format($reservation['harga_produk'], 0, ',', '.'); ?></strong>
                        </li>
                    </ul>

                    <div class="input-group">
                        <!-- <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to payment</button> -->
                    </div>
                </div>


                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Detail Package</h4>
                    <form class="needs-validation was-validated" action="<?= base_url('payment/paid/' . $reservation['reservationid']); ?>" method="post" novalidate="">
                        <?= csrf_field(); ?>

                        <div class="row g-3">
                            <div class="avatar me-3">
                                <!-- Assuming you have a user profile image URL stored in $reservation['foto'] -->
                                <img src="<?= base_url('images/' . $reservation['product_foto']) ?>" alt="Avatar" class="rounded-circle" width="40" height="40">
                                <label class="lg-label fw-bold">
                                    <?= $reservation['product_username']; ?>
                                </label>
                            </div>
                            <span class="small-label">
                                <?= $reservation['product_lokasi']; ?>
                            </span>
                            <div class="col-sm-6 d-flex align-items-center">
                                <div class="avatar me-3">
                                    <!-- Assuming you have a user profile image URL stored in $reservation['foto'] -->
                                    <img src="<?= base_url('uploads/' . $reservation['photos_filenames']) ?>" alt="Avatar" class="rounded" width="60" height="60">
                                </div>

                                <div>
                                    <label id="selectedOptionLabel" class="form-label me-2 lg-label fw-semibold">
                                        <?= $reservation['nama_produk']; ?>
                                    </label>

                                    <div>
                                        <label class="me-2 small-label">
                                            Pilihan : <?= $reservation['nama_menu']; ?>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="me-2 lg-label fw-bold" name="total_harga">
                                            Rp.<?= number_format($reservation['harga_produk'], 0, ',', '.'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <h4 class="mb-3 mt-5">Detail Customer & Reservation</h4>
                            <div class="col-12">
                                <div class="border rounded-3 p-4">
                                    <div class="avatar me-3">
                                        <!-- Assuming you have a user profile image URL stored in $reservation['foto'] -->
                                        <div class="avatar me-3 d-flex align-items-center">
                                            <!-- Assuming you have a user profile image URL stored in $reservation['foto'] -->
                                            <img src="<?= base_url('images/' . $reservation['reservation_foto']) ?>" alt="Avatar" class="rounded-circle" width="40" height="40">
                                            <div class="ms-3">
                                                <div>
                                                    <label class="lg-label fw-bold mb-0">
                                                        <?= $reservation['reservation_nama']; ?>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="lg-label">
                                                        Email : <?= $reservation['reservation_email']; ?>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="lg-label">
                                                        Phone : <?= $reservation['reservation_telepon']; ?>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="lg-label">
                                                        Location : <?= $reservation['reservation_lokasi']; ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="mb-3 mt-5">Reservation</h4>
                                    <div class="border rounded-3 p-4 mt-3">
                                        <p class="mb-1">Tanggal Acara</p>
                                        <div class="avatar me-3">
                                            <!-- Assuming you have a user profile image URL stored in $reservation['foto'] -->
                                            <label class="lg-label fw-bold">
                                                <?= $reservation['tgl_acara']; ?>
                                            </label>
                                        </div>
                                        <p class="mb-1 mt-3">Lokasi Acara</p>
                                        <div class="avatar me-3">
                                            <!-- Assuming you have a user profile image URL stored in $reservation['foto'] -->
                                            <label class="lg-label fw-bold">
                                                <?= $reservation['lokasi']; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="mb-3 mt-5">Payment</h4>

                            <div class="my-3">
                                <div class="form-check">
                                    <input id="credit" name="total_harga" type="radio" class="form-check-input" checked="" required>
                                    <label class=" form-check-label" for="credit">Full Payment</label>
                                </div>
                                <div class="border rounded-3 p-4 mt-3">
                                    <p class="mb-1">Cara Pembayaran</p>
                                    <div class="avatar me-3">
                                        <!-- Assuming you have a user profile image URL stored in $reservation['foto'] -->
                                        <label class="lg-label fw-bold">
                                            Masukkan no rekening berikut ini : 5785785847
                                            lalu abis itu jika anda menggunakan mobile banking isikan
                                            di note ketikan melakukan transfer dengan memasukkan nama package
                                            yang anda pilih <?= $reservation['nama_produk']; ?>

                                            Lalu setelah itu Upload bukti pembayaran di bawah ini
                                        </label>
                                    </div>
                                    <p class="mb-1 mt-3">Upload Bukti Pembayaran</p>
                                    <div class="avatar me-3 mt-3">
                                        <div class="row">
                                            <!--  <div class="col-md-4">
                                    <div class="photo-upload-section">
                                        <img src="#" class="uploaded-image" alt="Uploaded Photo">
                                        <input type="file" class="file-input" accept="image/*" name="photos_filenames" onchange="previewImage(event)">
                                    </div>
                                </div> -->
                                            <div class="col-md-4">
                                                <div class="photo-upload-section">
                                                    <img src="#" class="uploaded-image" alt="Uploaded Photo">
                                                    <input type="file" class="file-input" accept="image/*" name="upload_transfer" onchange="previewImage(event)">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4">
                                    <div class="photo-upload-section">
                                        <img src="#" class="uploaded-image" alt="Uploaded Photo">
                                        <input type="file" class="file-input" accept="image/*" name="photo_filename" onchange="previewImage(event)">
                                    </div>
                                </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-check">
                                    <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
                                    <label class="form-check-label" for="debit">Debit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div> -->
                            </div>
                            <!-- Add the dp amount and status input fields -->
                            <!-- Change the name to 'product_price' instead of 'total_harga' -->
                            <input type="hidden" name="reservation_id" value="<?= $reservation['reservationid']; ?>">
                            <input type="hidden" name="transaksi_id" value="<?= $reservation['transaksi_id']; ?>">
                            <!-- <input type="hidden" name="payment_option" value="full"> For full payment -->
                            <button class="w-100 btn btn-primary btn-lg" id="pay-button" type="submit">Continue to payment</button>
                    </form>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <div class="container">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
                <div class="col mb-3">
                    <!-- logo -->
                    <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                        <img class="bi me-2" width="200" src="<?= base_url(); ?>/images/logo.svg">

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
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Orders History</a></li>
                    </ul>
                </div>

                <div class="col mb-3">
                    <h5>TENTANG KAMI</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Contact</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/src/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/src/js/bootstrap.bundle.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/src/js/bootstrap.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="checkout.js"></script>

    <script>
        function previewImage(event) {
            const fileInput = event.target;
            const photoUploadSection = fileInput.parentElement;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const uploadedImage = photoUploadSection.querySelector('.uploaded-image');
                    uploadedImage.src = e.target.result;
                    photoUploadSection.classList.add('hide-text');
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>