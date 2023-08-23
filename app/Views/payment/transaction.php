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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.tailwindcss.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">



</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-white sidebar sidebar-white accordion" id="accordionSidebar">
            <!-- Nav Item - Dashboard -->

            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('user/setting') ?>">
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
                        <a class="collapse-item" href="<?= base_url('produk/create'); ?>">Tambah Package</a>
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
                                <a class="dropdown-item" href="<?= base_url('home'); ?>">
                                    <i class="fas fa-fw fa-solid fa-house mr-2 text-gray-400"></i>
                                    Home
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/settings'); ?>">
                                    <i class="fas fa-fw fa-solid fa-calendar-alt mr-2 text-gray-400"></i>
                                    Reservation
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/settings'); ?>">
                                    <i class="fas fa-fw fa-solid fa-credit-card-alt mr-2 text-gray-400"></i>
                                    Transaction
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/settings'); ?>">
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
                <!-- Begin Page Content -->
                <div class="container-fluid bg-white">

                    <!-- Page Heading -->
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <select id="reportFormat" class="form-select form-select-sm mb-2" aria-label="Select Report Format">
                                    <option value="csv">CSV</option>
                                    <option value="pdf">PDF</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <button id="generateReportBtn" class="btn btn-sm btn-primary shadow-sm w-100">
                                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <section class="content-header">
                            <!-- Menampilkan Pesan -->
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
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Transaction ID</th>
                                    <th>Nama Packagep</th>
                                    <th>Foto Package</th>
                                    <th>Harga</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Reservation Date</th>
                                    <th>Payment Date</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($payments as $produk_item) {
                                    $description = $produk_item['description'];
                                    // Limit the description text to a certain number of characters
                                    $max_length = 100;
                                    $display_description = (strlen($description) > $max_length) ? substr($description, 0, $max_length) . "..." : $description;
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $produk_item['id_payment']; ?></td>
                                        <td><?= $produk_item['nama_produk']; ?></td>
                                        <!--  <td>
                                            <div class="description-container">
                                                <span class="short-description"><?= $display_description; ?></span>
                                                <?php if (strlen($description) > $max_length) : ?>
                                                    <span class="full-description" style="display: none;"><?= $description; ?></span>
                                                    <button class="btn btn-link show-more-btn" onclick="toggleDescription(this)">Show More</button>
                                                    <button class="btn btn-link show-less-btn" style="display: none;" onclick="toggleDescription(this)">Show Less</button>
                                                <?php endif; ?>
                                            </div>
                                        </td> -->
                                        <td>
                                            <center>
                                                <img src="<?= base_url('uploads/' . $produk_item['photos_filenames']) ?>" class="card-img-top img-fluid rounded w-50 rounded" alt="Gambar">
                                            </center>
                                        </td>
                                        <td>Rp.<?= number_format($produk_item['total_payment'], 0, ',', '.'); ?></td>
                                        <td><?= $produk_item['lokasi']; ?></td>
                                        <td><?= $produk_item['status']; ?></td>
                                        <td><?= date('l, d F Y', strtotime($produk_item['tgl_acara'])); ?></td>
                                        <td><?= $produk_item['payment_date']; ?></td>
                                        <td style="width:20%;">
                                            <div class="btn-group">
                                                <a href="<?= base_url('payment/invoice/' . $produk_item['id_payment']); ?>" target="_blank" class="btn btn-outline-info"><i class="fas fa-solid fa-file-invoice mr-2"></i>Invoice</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End of Main Content -->
                <!-- End of Content Wrapper -->

                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyrigth &copy; Tenda Hj.Yus <?= date('Y'); ?></span>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- End of Page Wrapper -->
            <!-- Footer -->
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.12.0/dist/umd/popper.min.js" integrity="sha384-N5ZRprfQq9MgP13e+t4FkTqi7X9WVj54V2VXpOD4z8B65C7BK2gjHdouP84fS7Ld" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-B4gt1FWAbeJ3GzFQNzppbXk6v5zxG4T/4By2vckIgXvb7bPLhpvGhmfhA1t1b8RM" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.5/js/dataTables.tailwindcss.min.js"></script>
            <!-- Include jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Include DataTables JavaScript -->
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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

            <script>
                new DataTable('#example', {
                    columnDefs: [{
                            targets: [0],
                            orderData: [0, 1]
                        },
                        {
                            targets: [1],
                            orderData: [1, 0]
                        },
                        {
                            targets: [4],
                            orderData: [4, 0]
                        }
                    ]
                });
            </script>

            <script>
                const generateReportBtn = document.getElementById("generateReportBtn");
                const reportFormatSelect = document.getElementById("reportFormat");

                generateReportBtn.addEventListener("click", function() {
                    const selectedFormat = reportFormatSelect.value;
                    const downloadUrl = generateDownloadUrl(selectedFormat);

                    if (downloadUrl) {
                        window.location.href = downloadUrl;
                    }
                });

                function generateDownloadUrl(format) {
                    // Logic to generate the download URL based on the selected format
                    if (format === "csv") {
                        return "<?= site_url('payment/generateCsv') ?>";
                    } else if (format === "pdf") {
                        return "<?= site_url('payment/generatePdf') ?>";
                    } else {
                        return null;
                    }
                }
            </script>

            <!-- Font Awesome -->
            <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>