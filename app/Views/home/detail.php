<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $product['nama_produk']; ?></title>
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
        <div class="container mt-4">
            <nav class="navbar navbar-expand-lg bg-white ms-auto">
                <!-- ... (rest of the header code) ... -->
                <div class="container">
                    <a class="navbar-brand" href="<?= base_url('home'); ?>">
                        <img src="<?= base_url(); ?>/images/logo.svg" alt="logo" srcset="" width="100" height="" class="d-inline-block align-text-top">
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

    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <!-- Check if the product data is available -->
            <?php if ($product) : ?>
                <form id="reservationForm" action="<?= base_url('reservation/buy/' . $product['produkid']); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <!-- Product Image (col-md-8) -->
                        <div class="col-md-6 mb-5 mb-md-0">
                            <img class="card-img-top img-fluid rounded-5" src="<?= base_url('uploads/' . $product['photos_filenames']) ?>" alt="Product Image" />
                        </div>

                        <!-- Product Information and Buttons (col-md-4) -->
                        <div class="col-md-4">
                            <div class="small mb-1"></div>
                            <h1 class="display-5 fw-bolder"><?= $product['nama_produk']; ?></h1>
                            <div class="fs-5 mb-3">
                                <span><?= $product['username']; ?></span>
                                <span>Rp.<?= number_format($product['harga_produk'], 0, ',', '.'); ?></span>
                            </div>
                            <div class="mb-4">
                                <label id="selectedOptionLabel" class="form-label">Pilihan : </label>
                                <div class="option-container custom-container">
                                    <?php foreach ($menuOptions as $option) : ?>
                                        <?php if (!empty($option['nama_menu'])) : ?>
                                            <label class="option-item">
                                                <input type="radio" name="menu_id" value="<?= $option['produk_id']; ?>">
                                                <div class="option-content">
                                                    <img src="<?= base_url('uploads/' . $product['photos_filenames']) ?>" alt="Image 1">
                                                    <span><?= $option['nama_menu']; ?></span>
                                                </div>
                                            </label>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <!-- Add more details for the main product as needed -->
                                </div>
                            </div>

                            <input type="hidden" name="harga_produk" value="<?= $product['harga_produk']; ?>">
                            <div class="d-flex flex-column flex-md-row">
                                <button type="submit" class="btn btn-outline-dark w-100">Buy</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2 class="fw-bolder mb-3">Description:</h2>
                        <div class="description-wrapper">
                            <p class="fs-6" id="description"><?= nl2br($product['description']); ?></p>
                        </div>
                        <a href="#" class="show-more-link nav-link text-info" onclick="toggleDescription();">Show More</a>
                    </div>
                </div>
                <!-- Product Description (col-md-12) -->

            <?php else : ?>
                <div class="d-flex justify-content-center align-items-center" role="alert" style="height: 300px;">
                    <div class="text-center">
                        <img src="<?= base_url() ?>/images/notproduct.svg" alt="Package not found." class="img-fluid mb-3" style="max-width: 350px;" />
                        <p class="mb-2" style="font-size: 30px; font-weight: bold;">Yaah Sayang Sekali Paket Yang anda cari tidak ada. Mungkin ada di tempat lain</p>
                        <a href="<?= base_url('home') ?>">
                            <button class="btn btn-info">Mungkin Disi</button>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-3">
            <h2 class="fw-bolder mb-4">Related package</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php if (!empty($relatedProducts)) : ?>
                    <?php foreach ($relatedProducts as $relatedProduct) : ?>
                        <div class="col mb-5">
                            <a href="<?= base_url('home/detail/' . $relatedProduct['produkid']) ?>" class="card h-100 custom-link">
                                <!-- Related Product image -->
                                <img class="card-img-top" src="<?= base_url('uploads/' . $relatedProduct['photos_filenames']) ?>" alt="Related Product Image" />
                                <!-- Related Product details -->
                                <div class="card-body p-4">
                                    <div class="text-start">
                                        <!-- Related Product name -->
                                        <h5 class="fw-bolder"><?= $relatedProduct['nama_produk']; ?></h5>
                                        <!-- Related Product price -->
                                        Rp.<?= number_format($relatedProduct['harga_produk'], 0, ',', '.'); ?>
                                    </div>
                                    <div class="d-flex align-items-center mt-2">
                                        <!-- User photo -->
                                        <img src="<?= base_url('/images/' . $relatedProduct['foto']) ?>" alt="User Photo" class="rounded-circle me-3" style="width: 30px; height: 30px;">
                                        <!-- Location text -->
                                        <span class="small"><?= $relatedProduct['lokasi']; ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="d-flex justify-content-center align-items-center mt-2" role="alert" style="height: 200px;">
                        <div class="col-12 text-center">
                            <p>No related packages found.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
            <div class="col mb-3">
                <!-- logo -->
                <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                    <img class="bi me-2" width="200" src="<?= base_url(); ?>/images/.svg">

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


</body>

</html>