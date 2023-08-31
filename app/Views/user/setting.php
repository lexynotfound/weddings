<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/caraousel.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/sidebar.css">
    <link href="<?= base_url(); ?>/src/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/src/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/src/fontawesome-free-6.4.0/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Vj6tzy4Hg7J1K25b4ml2p15zYLq6xWq5rI3/ABttrKA2Ap" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Vj6tzy4Hg7J1K25b4ml2p15zYLq6xWq5rI3/ABttrKA2Ap" crossorigin="anonymous">
    <!--  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
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

    <section style="background-color: #ffff;">
        <div class="container py-5">
            <?php if (session('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('user/setting') ?>">User</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('user/setting') ?>">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <?php
                            if ($user->foto === 'default.png') {
                                // Jika foto adalah foto default, tampilkan dari folder 'images'
                            ?>
                                <img src="<?= base_url(); ?>/images/<?= $user->foto; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <?php
                            } else {
                                // Jika foto telah diubah, tampilkan dari folder 'uploads'
                            ?>
                                <img src="<?= base_url('uploads/' . $user->foto); ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <?php
                            }
                            ?>
                            <h5 class="my-3"><?= $user->nama; ?></h5>
                            <p class="text-muted mb-3">Besar file: maksimum 10.000.000 bytes (10 Megabytes). Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#choosePhotoModal">
                                    Ganti Foto Profile
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <a href="<?= base_url('user/reservation') ?>" class="nav-link">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fas fa-solid fa-calendar-days fa-lg text-warning"></i>
                                        <p class="mb-0">Reservation</p>
                                    </li>
                                </a>
                                <a href="<?= base_url('user/transaksi') ?>" class="nav-link">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fas fa-solid fa-file-invoice fa-lg" style="color: #333333;"></i>
                                        <p class="mb-0">Transaction</p>
                                    </li>
                                </a>
                                <a href="<?= base_url('user/setting') ?>" class="nav-link">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fab fas fa-solid fa-gears fa-lg" style="color: #55acee;"></i>
                                        <p class="mb-0">Settings</p>
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?= $user->nama; ?>
                                        <a href="#" class="ms-2 text-decoration-none" data-toggle="modal" data-target="#editNameModal">Ubah</a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Username</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?= $user->username; ?>

                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?= $user->email; ?>
                                        <a href="#" class="ms-2 text-decoration-none" data-toggle="modal" data-target="#editEmailModal">Ubah</a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?= $user->jenis_kelamin; ?>
                                        <a href="#" class="ms-2 text-decoration-none" data-toggle="modal" data-target="#editGenderModal">Ubah</a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Mobile</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?= $user->telepon; ?>
                                        <a href="#" class="ms-2 text-decoration-none" data-toggle="modal" data-target="#editMobileModal">Ubah</a>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?= $user->lokasi; ?>
                                        <a href="#" class="ms-2 text-decoration-none" data-toggle="modal" data-target="#editAddressModal">Ubah</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0 scrollable-card">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">recent & status</span> Transaction
                                    </p>
                                    <?php foreach ($payments as $payment) : ?>
                                        <div class="card mt-4 mb-1" style="height: 200px;">
                                            <div class="card-body d-flex">
                                                <div class="icon-container me-3">
                                                    <i class="fas fa-credit-card" style="font-size: 20px;"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-1" style="font-size: .77rem;">Transaction ID</p>
                                                    <p class="mb-0"><?= $payment['id_payment']; ?></p>
                                                </div>
                                                <div>
                                                    <p class="mb-1" style="font-size: .77rem;"><?= $payment['payment_date']; ?></p>
                                                    <?php
                                                    $status = $payment['status'];
                                                    $id_payment = $payment['id_payment'];

                                                    if (($status === 'Pembayaran DP' && strpos($id_payment, 'PAYDP-') === 0) ||
                                                        ($status === 'PAID' && strpos($id_payment, 'PAY-') === 0)
                                                    ) {
                                                        echo '<a href="' . base_url('payment/invoice/' . $id_payment) . '" target="_blank" class="btn btn-sm btn-outline-info ms-3 mr-2"><i class="fas fa-solid fa-file-invoice mr-2"></i> Invoice</a>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="card-body d-flex">
                                                <a href="#" data-toggle="modal" data-target="#imageModal">
                                                    <img src="<?= base_url('uploads/' . $payment['payment_receipt']) ?>" alt="Image" class="me-3" style="width: 50px; height: 50px;">
                                                </a>
                                                <div>
                                                    <p class="mb-1" style="font-size: .77rem;">Product Name:</p>
                                                    <p class="mb-0"><?= $payment['nama_produk']; ?></p>
                                                </div>
                                                <div class="ms-auto">
                                                    <p class="mb-1" style="font-size: .77rem;">Payment Status:</p>
                                                    <p class="mb-0">
                                                        <?php
                                                        $status = $payment['status'];

                                                        if ($status === 'Menunggu Verifikasi') {
                                                            echo '<span class="badge badge-ylw">' . $status . '</span>';
                                                        } elseif ($status === 'Pembayaran DP') {
                                                            echo '<span class="badge badge-orng">' . $status . '</span>';
                                                        } elseif ($status === 'PAID') {
                                                            echo '<span class="badge badge-grn">' . $status . '</span>';
                                                        } elseif ($status === 'Ditolak') {
                                                            echo '<span class="badge badge-rd">' . $status . '</span>';
                                                        } else {
                                                            echo $status;
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <img src="<?= base_url('uploads/' . $payment['payment_receipt']) ?>" alt="Image" style="max-width: 100%; max-height: 70vh;">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0 scrollable-card">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">recent</span> Reservation
                                    </p>
                                    <?php foreach ($reservation as $reservation) : ?>
                                        <div class="card mt-4 mb-1" style="height: 200px;">
                                            <div class="card-body d-flex">
                                                <div class="icon-container me-3">
                                                    <i class="fas fa-calendar-days" style="font-size: 20px;"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-1" style="font-size: .77rem;">Date</p>
                                                    <p class="mb-0"><?= date('l, d F Y', strtotime($reservation['tgl_acara'])); ?></p>
                                                </div>
                                            </div>
                                            <div class="card-body d-flex">
                                                <div class="icon-container me-3">
                                                    <i class="fas fa-solid fa-location-dot" style="font-size: 20px;"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-1" style="font-size: .77rem;">Location</p>
                                                    <p class="mb-0"><?= $reservation['lokasi']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Name Edit -->
    <!-- Modal for Name Edit -->
    <div class="modal fade" id="editNameModal" tabindex="-1" role="dialog" aria-labelledby="editNameModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNameModalLabel">Edit Full Name</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/update_name'); ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <!-- Your form content for editing name here -->
                        <!-- Name input field -->
                        <div class="mb-3">
                            <label for="newName" class="form-label">New Full Name</label>
                            <input type="text" id="newName" name="nama" value="<?= $user->nama; ?>" class="form-control">
                        </div>

                        <!-- Display error message if no changes are made -->
                        <?php if (session('no_changes')) : ?>
                            <div class="alert alert-danger">
                                No changes made.
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal for Email Edit -->
    <div class="modal fade" id="editEmailModal" tabindex="-1" role="dialog" aria-labelledby="editEmailodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmailModalLabel">Changes Email</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/update_email'); ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <!-- Your form content for editing name here -->
                        <!-- Name input field -->
                        <div class="mb-3">
                            <label for="newName" class="form-label">New Email</label>
                            <input type="text" id="newEmail" name="email" value="<?= $user->email; ?>" class="form-control">
                        </div>
                        <!-- Display error message if no changes are made -->
                        <?php if (session('no_changes')) : ?>
                            <div class="alert alert-danger">
                                No changes made.
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Gender Edit -->
    <div class="modal fade" id="editGenderModal" tabindex="-1" role="dialog" aria-labelledby="editGenderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGenderModalLabel">Changes Gender</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/update_gender'); ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <!-- Your form content for editing name here -->
                        <!-- Name input field -->
                        <div class="mb-3">
                            <label for="newGender" class="form-label">Change Your Gender</label>
                            <select id="newGender" name="jenis_kelamin" class="form-control">
                                <?php if ($user->jenis_kelamin === 'Laki-laki') : ?>
                                    <option value="Laki-laki" selected>Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                <?php elseif ($user->jenis_kelamin === 'Perempuan') : ?>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan" selected>Perempuan</option>
                                <?php else : ?>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!-- Display error message if no changes are made -->
                        <?php if (session('no_changes')) : ?>
                            <div class="alert alert-danger">
                                No changes made.
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Mobile Edit -->
    <div class="modal fade" id="editMobileModal" tabindex="-1" role="dialog" aria-labelledby="editMobileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMobileModalLabel">Changes Mobile</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form" action="<?= base_url('user/update_telepon'); ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <!-- Your form content for editing name here -->
                        <!-- Name input field -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Change Your Mobile</label>
                            <input type="text" inputmode="numeric" id="newMobile" name="telepon" id="price" value="<?= $user->telepon; ?>" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <div class="invalid-feedback">Please enter a valid price (numbers only).</div>
                        </div>
                        <!-- Display error message if no changes are made -->
                        <?php if (session('no_changes')) : ?>
                            <div class="alert alert-danger">
                                No changes made.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for AddressEdit -->
    <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAddressModalLabel">Changes Address</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/update_lokasi'); ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <!-- Your form content for editing name here -->
                        <!-- Name input field -->
                        <div class="mb-3">
                            <label for="newName" class="form-label">Changes Address</label>
                            <input type="text" id="newAddress" name="lokasi" value="<?= $user->lokasi; ?>" class="form-control">
                        </div>
                        <!-- Display error message if no changes are made -->
                        <?php if (session('no_changes')) : ?>
                            <div class="alert alert-danger">
                                No changes made.
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Changing Profile Photo -->
    <div class="modal fade" id="choosePhotoModal" tabindex="-1" role="dialog" aria-labelledby="choosePhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="choosePhotoModalLabel">Pilih Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content for choosing photo here -->
                    <form action="<?= site_url('user/update_foto'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3 text-center">
                            <label for="photoInputModal" class="form-label">Changes Photo</label>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="photo-upload-section text-center">
                                    <label for="photoInput" style="cursor: pointer;">
                                        <?php
                                        if ($user->foto === 'default.png') {
                                            // Jika foto adalah foto default, tampilkan dari folder 'images'
                                        ?>
                                            <img src="<?= base_url(); ?>/images/<?= $user->foto; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        <?php
                                        } else {
                                            // Jika foto telah diubah, tampilkan dari folder 'uploads'
                                        ?>
                                            <img src="<?= base_url('uploads/' . $user->foto); ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        <?php
                                        }
                                        ?>
                                    </label>
                                    <input type="file" class="file-input" id="photoInput" accept="image/*" name="foto" onchange="previewImage(event)">
                                </div>

                            </div>
                            <!-- Display error message if no changes are made -->
                            <?php if (session('no_changes')) : ?>
                                <div class="alert alert-danger">
                                    No changes made.
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#errorModal').modal('show');
        </script>
    <?php endif; ?>

    <!-- Success Modal -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#successModal').modal('show');
        </script>
    <?php endif; ?>


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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah kamu ingin "Logout".</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Script -->

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        // Set a timeout to hide the alert after 10 seconds
        setTimeout(function() {
            var alertElement = document.querySelector('.alert');
            if (alertElement) {
                alertElement.style.display = 'none';
            }
        }, 10000); // 10000 milliseconds = 10 seconds
    </script>

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

</body>

</html>