<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="<?= base_url() ?>/src/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url() ?>/src/css/profile.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/caraousel.css">
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="<?= base_url() ?>https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="<?= base_url() ?>/src/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>/src/js/dropdown-hoover.js"></script>
    <!-- Custom styles for this template-->

    <!-- Custom styles for this template-->
    <!-- <link href="/src/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="/src/css/bootstrap.css">
    <link rel="stylesheet" href="/src/css/mystyle.css">
    <link rel="stylesheet" href="/src/css/profile.css"> -->
    <script src="<?= base_url() ?>/src/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url() ?>/src/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>/src/js/disablescrool.js"></script>
    <script src="<?= base_url() ?>/src/js/dropdown-hoover.js"></script>
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="<?= base_url(); ?>/src/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url(); ?>/src/js/dropdown-hoover.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Rounded carousel */
        .carousel-inner img {
            border-radius: 5px;
        }

        /* Center carousel */
        #carouselExample {
            margin: 0 auto;
            max-width: 900px;
            /* Adjust the max-width as needed */
        }

        /* Indicator and arrow styles */
        .carousel-indicators li {
            background-color: #bbb;
            border-radius: 50%;
            width: 12px;
            height: 12px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            top: 50%;
            /* Positioning the arrows at the center vertically */
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0.6;
        }

        .carousel-control-prev:before,
        .carousel-control-next:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
            width: 16px;
            /* Increased size of arrow */
            height: 3px;
            /* Thickness of arrow */
            background-color: #fff;
        }

        .carousel-control-prev {
            left: -30px;
        }

        .carousel-control-next {
            right: -30px;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        /* Show arrows on hover */
        .carousel-control-prev,
        .carousel-control-next {
            display: none;
        }

        #carouselExample:hover .carousel-control-prev,
        #carouselExample:hover .carousel-control-next {
            display: block;
        }

        /* Carousel Transition Effect */
        .carousel-inner .carousel-item {
            transition: transform 0.6s ease;
        }

        /* Add margin to the carousel container */
        .carousel-container {
            margin: 20px;
        }

        /* Mengatur tata letak teks di bawah gambar */
        .nav-link-bottoms-icons {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    </style>

</head>

<body>

    <header>
        <div class="container mt-4">
            <nav class="navbar navbar-expand-lg bg-white ms-auto ">
                <div class="container ">
                    <a class="navbar-brand" href="<?= base_url('home') ?>">
                        <img src="<?= base_url() ?>/images/.svg" alt="logo" srcset="" width="100" height="" class="d-inline-block align-text-top">
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

                    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse dropdown" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <?php if (logged_in()) : ?>
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-4 d-none d-lg-inline text-gray-600 small me-1"><?= user()->username; ?></span>
                                        <img class="img-profile rounded-circle ms-auto" src="<?= base_url(); ?>/img/<?= user()->foto; ?>" alt="Foto Profile" style="width: 40px; height: 40px;">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="<?= base_url('admin'); ?>">
                                            <i class="fas fa-fw fa-tachometer-alt mr-2 text-gray-400"></i>
                                            Dashboard
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="d-flex btn-container gap-3 ml-2">
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

    <div class="container">

        <div class="container my-5">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <!-- Carousel Item 1 -->
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/800x400?text=Carousel+Item+1" class="d-block w-100" alt="Carousel Item 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Carousel Item 1</h3>
                            <p>Description for Item 1</p>
                        </div>
                    </div>
                    <!-- Carousel Item 2 -->
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400?text=Carousel+Item+2" class="d-block w-100" alt="Carousel Item 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Carousel Item 2</h3>
                            <p>Description for Item 2</p>
                        </div>
                    </div>
                    <!-- Carousel Item 3 -->
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400?text=Carousel+Item+3" class="d-block w-100" alt="Carousel Item 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Carousel Item 3</h3>
                            <p>Description for Item 3</p>
                        </div>
                    </div>
                </div>

                <!-- Carousel Controls -->
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>

        <div class="container">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link nav-link-bottoms-icons text-center" aria-current="page" href="#">
                        <img src="<? base_url() ?>/images/Star.svg" alt="Best" style="width: 40px; height: 40px;">
                        Best
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-bottoms-icons text-center" aria-current="page" href="#">
                        <img src="<? base_url() ?>/images/lc.svg" alt="Best" style="width: 40px; height: 40px;">
                        Location
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
        </div>

        <section>
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-3 mb-4 mb-lg-0">
                        <a href="<?base_url('home/detail/')?>" class="card-link nav-link">
                            <div class="card">
                                <div class="d-flex justify-content-between p-3">
                                    <p class="lead mb-0">Today's Combo Offer</p>
                                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong" style="width: 35px; height: 35px;">
                                        <p class="text-white mb-0 small"></p>
                                    </div>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/4.webp" class="card-img-top" alt="Laptop" />
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="small"><a href="#!" class="text-muted">Laptops</a></p>
                                        <p class="small text-danger"><s>$1099</s></p>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">HP Notebook</h5>
                                        <h5 class="text-dark mb-0">$999</h5>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="text-muted mb-0">Available: <span class="fw-bold">6</span></p>
                                        <div class="ms-auto text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                        <div class="card">
                            <div class="d-flex justify-content-between p-3">
                                <p class="lead mb-0">Today's Combo Offer</p>
                                <div class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong" style="width: 35px; height: 35px;">
                                    <p class="text-white mb-0 small"></p>
                                </div>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/7.webp" class="card-img-top" alt="Laptop" />
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="small"><a href="#!" class="text-muted">Laptops</a></p>
                                    <p class="small text-danger"><s>$1199</s></p>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">HP Envy</h5>
                                    <h5 class="text-dark mb-0">$1099</h5>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-muted mb-0">Available: <span class="fw-bold">7</span></p>
                                    <div class="ms-auto text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                        <div class="card">
                            <div class="d-flex justify-content-between p-3">
                                <p class="lead mb-0">Today's Combo Offer</p>
                                <div class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong" style="width: 35px; height: 35px;">
                                    <p class="text-white mb-0 small"></p>
                                </div>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/5.webp" class="card-img-top" alt="Gaming Laptop" />
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="small"><a href="#!" class="text-muted">Laptops</a></p>
                                    <p class="small text-danger"><s>$1399</s></p>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Toshiba B77</h5>
                                    <h5 class="text-dark mb-0">$1299</h5>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-muted mb-0">Available: <span class="fw-bold">5</span></p>
                                    <div class="ms-auto text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <div class="container">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
                <div class="col mb-3">
                    <!-- logo -->
                    <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                        <img class="bi me-2" width="200" src="<?= base_url(); ?>/assets/img/mgsl.svg">

                        </img>
                    </a>
                    <p class="text-muted">Copyrigth &copy; Tenda Hj.Yus <?= date('Y'); ?></p>

                </div>

                <div class="col mb-3">

                </div>

                <div class="col mb-3">
                    <h5>Tenda Hj. Yus</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
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
        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages--><?= base_url(); ?>/
        <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?= base_url(); ?>/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?= base_url(); ?>/js/demo/chart-area-demo.js"></script>
        <script src="<?= base_url(); ?>/js/demo/chart-pie-demo.js"></script>
        <script src="<?= base_url(); ?>/js/message.js"></script>

        <!-- Bootstrap and jQuery JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

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


</body>

</html>