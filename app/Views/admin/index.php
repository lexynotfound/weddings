<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>


    <script src="<?= base_url() ?>/js/bootstrap.bundle.js"></script>
    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/src/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/src/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.min.css">
    <link href="<?= base_url() ?>/src/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/src/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/src/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/src/fontawesome-free-6.4.0/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.5.1/main.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.5.1/main.min.js'></script>

    <style>
        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            border-bottom: none;
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-white sidebar sidebar-white accordion" id="accordionSidebar">
            <!-- Nav Item - Dashboard -->

            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <img class="img-profile rounded-circle ms-auto" src="<?= base_url(); ?>/images/<?= user()->foto; ?>" alt="Foto Profile" style="width: 40px; height: 40px;">
                    <span><?= user()->username; ?></span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('home'); ?>">
                    <i class="fas fa-fw fa-home-alt"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('admin'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduk" aria-expanded="true" aria-controls="collapseProduk">
                    <i class="fas fa-regular fa-boxes-stacked"></i>
                    <span>Package</span>
                </a>
                <div id="collapseProduk" class="collapse" aria-labelledby="headingProduk" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('produk/create'); ?>">Tambah Package</a>
                        <a class="collapse-item" href="<?= base_url('produk/daftar_produk') ?>">Daftar</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTr" aria-expanded="true" aria-controls="collapseTr">
                    <i class="fas fa-solid fa-money-bills"></i>
                    <span>Transaction</span>
                </a>
                <div id="collapseTr" class="collapse" aria-labelledby="headingProduk" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!--  -->
                        <a class="collapse-item" href="<?= base_url('payment/transaction') ?>">Transaction</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-solid fa-calendar-days"></i>
                    <span>Reservation</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="utilities-color.html">Jadwal Kegiatan</a>
                        <a class="collapse-item" href="<?= base_url('reservation/data') ?>">Data</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->
            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Addons
            </div> -->
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->
            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span>
                </a>
            </li> -->
            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span>
                </a>
            </li> -->
            <!-- Divider -->
            <!-- <hr class="sidebar-divider d-none d-md-block"> -->
            <!-- Sidebar Toggler (Sidebar) -->

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Sidebar Message -->
            <!--  <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <!-- ... (rest of the user information dropdown code) ... -->
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-4 d-none d-lg-inline text-gray-600 small me-1"><?= user()->username; ?></span>
                                <img class="img-profile rounded-circle ms-auto" src="<?= base_url(); ?>/images/<?= user()->foto; ?>" alt="Foto Profile" style="width: 40px; height: 40px;">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('home'); ?>">
                                    <i class="fas fa-fw fa-solid fa-house mr-2 text-gray-400"></i>
                                    Home
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/setting'); ?>">
                                    <i class="fas fa-fw fa-solid fa-calendar-alt mr-2 text-gray-400"></i>
                                    Reservation
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/setting'); ?>">
                                    <i class="fas fa-fw fa-solid fa-credit-card-alt mr-2 text-gray-400"></i>
                                    Transaction
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/setting'); ?>">
                                    <i class="fas fa-fw fa-solid fa-sliders mr-2 text-gray-500"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid bg-white">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Perhitungan Uang -->
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                        <p class="mb-4"><span class="text-primary font-italic me-1">Earnings</span> Income
                                        </p>
                                        <!--  -->
                                        <div class="card mt-4 mb-1" style="height: 200px;">
                                            <div class="card-body d-flex">
                                                <div class="icon-container me-3">
                                                    <i class="fas fa-solid fa-rupiah-sign" style="font-size: 50px;"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-1" style="font-size: .77rem;">Total Paid</p>
                                                    <p class="mb-0"> Total Paid: <?= number_format($totalPrice, 2); ?></p>
                                                </div>
                                                <div class="icon-container ms-4">
                                                    <i class="fas fa-solid fa-rupiah-sign" style="font-size: 50px;"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <p class="mb-1" style="font-size: .77rem;">Total DP</p>
                                                    <p class="mb-0"><?= number_format($totalDp, 2); ?></p>
                                                </div>
                                                <div class="ms-5">
                                                    <p class="mb-1" style="font-size: .77rem;"></p>
                                                </div>
                                            </div>
                                            <div class="card-body d-flex">
                                                <div class="icon-container me-3">
                                                    <i class="fas fa-solid fa-rupiah-sign" style="font-size: 50px;"></i>
                                                </div>
                                                <div class="">
                                                    <p class="mb-1" style="font-size: .77rem;">Total Payment</p>
                                                    <p class="mb-0"><?= number_format($totalPayment, 2); ?></p>
                                                </div>
                                                <div class="ms-5">
                                                    <p class="mb-1" style="font-size: .77rem;"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                        <p class="mb-4"><span class="text-primary font-italic me-1">Calendar</span>
                                        </p>
                                        <!--  -->
                                        <div class="card mt-4 mb-1" style="height: 200px;">
                                            <div class="card-body d-flex">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir dari Perhitungan -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0 scrollable-card">
                                    <div class="card-body">
                                        <p class="mb-4"><span class="text-primary font-italic me-1">recent & status</span> Transaction
                                        </p>
                                        <!--Mengambil Data pembayaran yang terjadi  -->
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
                                                    <div class="ms-5">
                                                        <p class="mb-1" style="font-size: .77rem;"><?= $payment['payment_date']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="card-body d-flex">
                                                    <!-- Tautan atau tombol untuk memicu modal -->
                                                    <a href="#" class="image-link" data-toggle="modal" data-target="#imageModal" data-image="<?= base_url('uploads/' . $payment['payment_receipt']) ?>">
                                                        <img src="<?= base_url('uploads/' . $payment['payment_receipt']) ?>" alt="Image" class="me-3" style="width: 50px; height: 50px;">
                                                    </a>
                                                    <div>
                                                        <p class="mb-1" style="font-size: .77rem;">Product Name:</p>
                                                        <p class="mb-0"><?= $payment['nama_produk']; ?></p>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <p class="mb-1" style="font-size: .77rem;">Payment Status:</p>
                                                        <p class="mb-0"><?= $payment['status']; ?></p>
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
                                                    <div class="icon-container ms-5">
                                                        <i class="fas fa-solid fa-user" style="font-size: 20px;"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <p class="mb-1" style="font-size: .77rem;">Bride Name</p>
                                                        <p class="mb-0"><?= $reservation['nama']; ?></p>
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

                        <!-- Bagian Dashboard paling atas bawah content -->
                        <!-- Content Row -->

                        <div class="row">

                            <!-- Area Chart -->


                            <!-- Content Row -->
                            <div class="row">

                                <!-- Content Column -->
                                <div class="col-lg-6 mb-4">

                                    <!-- Project Card Example -->


                                    <!-- Color System -->
                                    <!-- <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <div class="card bg-primary text-white shadow">
                                                <div class="card-body">
                                                    Primary
                                                    <div class="text-white-50 small">#4e73df</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="card bg-success text-white shadow">
                                                <div class="card-body">
                                                    Success
                                                    <div class="text-white-50 small">#1cc88a</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="card bg-info text-white shadow">
                                                <div class="card-body">
                                                    Info
                                                    <div class="text-white-50 small">#36b9cc</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="card bg-warning text-white shadow">
                                                <div class="card-body">
                                                    Warning
                                                    <div class="text-white-50 small">#f6c23e</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="card bg-danger text-white shadow">
                                                <div class="card-body">
                                                    Danger
                                                    <div class="text-white-50 small">#e74a3b</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="card bg-secondary text-white shadow">
                                                <div class="card-body">
                                                    Secondary
                                                    <div class="text-white-50 small">#858796</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="card bg-light text-black shadow">
                                                <div class="card-body">
                                                    Light
                                                    <div class="text-black-50 small">#f8f9fc</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="card bg-dark text-white shadow">
                                                <div class="card-body">
                                                    Dark
                                                    <div class="text-white-50 small">#5a5c69</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>

                                <div class="col-lg-6 mb-4">

                                    <!-- Illustrations -->


                                    <!-- Approach -->


                                </div>
                            </div>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyrigth &copy; Tenda Hj.Yus <?= date('Y'); ?></span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Photos -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Payment Receipt</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img id="modalImage" src="" alt="Image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>


            <!-- Memuat pustaka JavaScript Bootstrap -->
            <!-- Memuat pustaka JavaScript Bootstrap dan jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+KG8r+8GAO4fG1pA1l+HRZGj7JqIbbVYUew+OrCXaRkfjIb" crossorigin="anonymous"></script>


            <!-- Memuat pustaka JavaScript Bootstrap dan jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+KG8r+8GAO4fG1pA1l+HRZGj7JqIbbVYUew+OrCXaRkfjIb" crossorigin="anonymous"></script>


            <!-- Bootstrap core JavaScript-->
            <script src="<?= base_url(); ?>/src/jquery/jquery.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="<?= base_url(); ?>/src/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="<?= base_url(); ?>/src/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="<?= base_url(); ?>/src/js/chart.js/Chart.min.js"></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.5.1/main.min.js'></script>

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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('.image-link').click(function() {
                        var imageSrc = $(this).data('image');
                        $('#modalImage').attr('src', imageSrc);
                    });

                    $('#imageModal').on('hidden.bs.modal', function() {
                        $('#modalImage').attr('src', '');
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        events: '/admin/getReservations', // Controller endpoint to fetch reservation data
                    });

                    calendar.render();
                });
            </script>
</body>

</html>