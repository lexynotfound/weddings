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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Navigation-->
    <header>
        <div class="container mt-4">
            <nav class="navbar navbar-expand-lg bg-white ms-auto">
                <!-- ... (rest of the header code) ... -->
                <div class="container">
                    <a class="navbar-brand" href="<?= base_url('home'); ?>">
                        <img src="<?= base_url(); ?>/images/logo.jpg" alt="logo" srcset="" width="100" height="100" class="d-inline-block align-text-top">
                    </a>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <form action="<?= base_url('home/search'); ?>" method="get" class="d-flex align-items-center" id="searchForm">
                                    <input type="text" id="inputPassword5" name="q" class="form-control form-control-md" aria-labelledby="passwordHelpBlock" placeholder="Search" style="width: 100%;">
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

    <!-- Reviews -->
    <section class="bg-white">
        <div class="container my-5 py-5 fw-bolder">
            <h4 class="text-start mb-4 text pb-2">Reviews</h4>
            <?php if (logged_in() && $payment) : ?>
                <!-- Display review form here -->
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-16 col-xl-16">
                        <form id="reviewForm" method="post" action="<?= site_url('home/save_review/' . $payment['paymentid']) ?>">
                            <?= csrf_field(); ?>
                            <div class="d-flex flex-start mb-5">
                                <?php
                                if ($payment['foto'] === 'default.png') {
                                    // Jika foto adalah foto default, tampilkan dari folder 'images'
                                ?>
                                    <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url() ?>/images/<?= $payment['foto']; ?>" alt="avatar" width="65" height="65" />
                                <?php
                                } else {
                                    // Jika foto telah diubah, tampilkan dari folder 'uploads'
                                ?>
                                    <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url('uploads/' . $payment['foto']); ?>" alt="avatar" width="65" height="65" />
                                <?php
                                }
                                ?>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <p class="text-muted mb-0"><?= $payment['username'] ?></p>
                                            <p class="text-muted mb-0">Rating:</p>
                                        </div>
                                        <div class="ms-auto text-warning">
                                            <input type="radio" name="rating" id="star1" class="star-radio" value="5">
                                            <label for="star1" title="Excellent"><i class="fa fa-star-o star-icon"></i></label>

                                            <input type="radio" name="rating" id="star2" class="star-radio" value="4">
                                            <label for="star2" title="Best"><i class="fa fa-star-o star-icon"></i></label>

                                            <input type="radio" name="rating" id="star3" class="star-radio" value="3">
                                            <label for="star3" title="Good"><i class="fa fa-star-o star-icon"></i></label>

                                            <input type="radio" name="rating" id="star4" class="star-radio" value="2">
                                            <label for="star4" title="Poor"><i class="fa fa-star-o star-icon"></i></label>

                                            <input type="radio" name="rating" id="star5" class="star-radio" value="1">
                                            <label for="star5" title="Bad"><i class="fa fa-star-o star-icon"></i></label>
                                        </div>
                                    </div>
                                    <h5>Add a Review</h5>
                                    <div class="form-outline">
                                        <textarea class="form-control" name="review" id="textAreaExample" rows="8"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <button type="submit" class="btn btn-outline-dark">
                                            Post <i class="fas fa-long-arrow-alt-right ms-2"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="payment_id" value="<?= $payment['paymentid']; ?>">
                                    <input type="hidden" name="item_id" value="<?= $product['produkid']; ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Star Icon and Count -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-star" style="font-size: 48px; color: gold;"></i>
                            <?php
                            // Calculate the total rating based on reviews
                            $totalRating = 0;
                            foreach ($reviews as $review) {
                                if (isset($review['rating'])) {
                                    $totalRating += $review['rating'];
                                }
                            }

                            // Calculate the average rating
                            $totalReviews = count($reviews);
                            $averageRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;
                            ?>
                            <span class="ms-2 fs-3"><?= number_format($averageRating, 1); ?>/5</span>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <?php for ($step = 1; $step <= 5; $step++) : ?>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-star" style="font-size: 24px; color: gold;"></i>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="progress">
                                            <?php
                                            // Get the rating count for the current step
                                            $ratingCount = 0;
                                            foreach ($reviews as $review) {
                                                if (isset($review['rating']) && $review['rating'] == $step) {
                                                    $ratingCount = isset($review['rating_count']) ? $review['rating_count'] : 0;
                                                    break;
                                                }
                                            }
                                            ?>
                                            <div class="progress-bar star-progress" role="progressbar" style="width: <?= ($totalReviews > 0) ? ($ratingCount / $totalReviews) * 100 : 0; ?>%; background-color: gold;" aria-valuenow="<?= ($totalReviews > 0) ? ($ratingCount / $totalReviews) * 100 : 0; ?>" aria-valuemin="0" aria-valuemax="100"><?= $step; ?></div>
                                            <span class="ms-2"><?= $ratingCount; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php else : ?>
                <!-- Display message and progress bars -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-star" style="font-size: 48px; color: gold;"></i>
                            <?php
                            // Calculate the total rating based on reviews
                            $totalRating = 0;
                            foreach ($reviews as $review) {
                                if (isset($review['rating'])) {
                                    $totalRating += $review['rating'];
                                }
                            }
                            // Calculate the average rating
                            $totalReviews = count($reviews);
                            $averageRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;
                            ?>
                            <span class="ms-2 fs-3"><?= number_format($averageRating, 1); ?>/5</span>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <?php for ($step = 1; $step <= 5; $step++) : ?>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-star" style="font-size: 24px; color: gold;"></i>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="progress">
                                            <?php
                                            // Get the rating count for the current step
                                            $ratingCount = 0;
                                            foreach ($reviews as $review) {
                                                if (isset($review['rating']) && $review['rating'] == $step) {
                                                    $ratingCount = isset($review['rating_count']) ? $review['rating_count'] : 0;
                                                    break;
                                                }
                                            }
                                            ?>
                                            <div class="progress-bar star-progress" role="progressbar" style="width: <?= ($totalReviews > 0) ? ($ratingCount / $totalReviews) * 100 : 0; ?>%; background-color: gold;" aria-valuenow="<?= ($totalReviews > 0) ? ($ratingCount / $totalReviews) * 100 : 0; ?>" aria-valuemin="0" aria-valuemax="100"><?= $step; ?></div>
                                            <span class="ms-2"><?= $ratingCount; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!--  <section class="gradient-custom">
        <div class="container my-4 py-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-16 col-lg-12 col-xl-16">
                    <div class="">
                        <div class=" p-4">
                            <h4 class="text-start mb-4 pb-2"></h4>
                            <div class="row">
                                <div class="col">
                                    <?php foreach ($reviews as $review) : ?>
                                        <div class="d-flex flex-start">
                                            <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url('/images/' . $review['foto']) ?>" alt="avatar" width="65" height="65" />
                                            <div class="flex-grow-1 flex-shrink-1">
                                                <div class="mb-3 mt-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="mb-1">
                                                            <?= $review['nama'] ?> <span class="small">- 2 hours ago</span>
                                                        </p>
                                                        <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a>
                                                    </div>
                                                    <p class="small mb-0">
                                                        <?= $review['review'] ?>
                                                    </p>
                                                </div>

                                                <div id="reviewsContainer" class="d-flex flex-start mt-4">
                                                    <a class="me-3" href="#">
                                                        <img class="rounded-circle shadow-1-strong" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp" alt="avatar" width="65" height="65" />
                                                    </a>
                                                    <div class="flex-grow-1 flex-shrink-1">
                                                        <div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-1">
                                                                    Simona Disa <span class="small">- 3 hours ago</span>
                                                                </p>
                                                            </div>
                                                            <p class="small mb-1">
                                                                letters, as opposed to using 'Content here, content here',
                                                                making it look like readable English.
                                                            </p>
                                                        </div>
                                                    </div>
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
    </section> -->

    <section class="gradient-custom">
        <div class="container my-4 py-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-16 col-lg-12 col-xl-16">
                    <div class="">
                        <div class=" p-4">
                            <h4 class="text-start mb-4 pb-2"></h4>
                            <div class="row">
                                <div class="col">
                                    <?php if (logged_in() && $payment) : ?>
                                        <?php foreach ($reviews as $review) : ?>
                                            <div class="review-item">
                                                <div class="d-flex flex-start">
                                                    <?php
                                                    if ($review['foto'] === 'default.png') {
                                                        // Jika foto adalah foto default, tampilkan dari folder 'images'
                                                    ?>
                                                        <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url() ?>/images/<?= $review['foto']; ?>" alt="avatar" width="65" height="65" />
                                                    <?php
                                                    } else {
                                                        // Jika foto telah diubah, tampilkan dari folder 'uploads'
                                                    ?>
                                                        <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url('uploads/' . $review['foto']); ?>" alt="avatar" width="65" height="65" />
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="flex-grow-1 flex-shrink-1">
                                                        <div class="mb-3 mt-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-1">
                                                                    <?= $review['nama'] ?> <span class="small">- <?= date('l, d F Y', strtotime($review['created_at'])); ?></span>
                                                                </p>
                                                                <a href="javascript:void(0);" class="reply-button" data-review-id="<?= $review['reviewsid'] ?>">
                                                                    <i class="fas fa-solid fa-comments fa-lg"></i><span class="small"></span>
                                                                </a>
                                                            </div>
                                                            <p class="small mb-0">
                                                                <?= $review['review'] ?>
                                                            </p>
                                                        </div>
                                                        <div class="replies-container">
                                                            <?php foreach ($replies as $reply) : ?>
                                                                <div id="reviewsContainer" class="d-flex flex-start mt-4">
                                                                    <a class="me-3" href="#">
                                                                        <?php if ($reply['foto'] === 'default.png') : ?>
                                                                            <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url() ?>/images/<?= $reply['foto']; ?>" alt="avatar" width="65" height="65" />
                                                                        <?php else : ?>
                                                                            <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url('uploads/' . $reply['foto']); ?>" alt="avatar" width="65" height="65" />
                                                                        <?php endif; ?>
                                                                    </a>
                                                                    <div class="flex-grow-1 flex-shrink-1">
                                                                        <div>
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <p class="mb-1">
                                                                                    <?= $reply['nama']; ?> <span class="small">- <?= date('l, d F Y', strtotime($reply['created_at'])); ?></span>
                                                                                </p>
                                                                            </div>
                                                                            <p class="small mb-1">
                                                                                <?= $reply['reply']; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <!-- Reply Form -->
                                                        <form class="reply-form d-none" action="<?= base_url('home/save/' . $review['reviewsid']) ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="d-flex align-items-center mt-3 ms-2">
                                                                <?php
                                                                if (user()->foto === 'default.png') {
                                                                    // Jika foto adalah foto default, tampilkan dari folder 'images'
                                                                ?>
                                                                    <img class="rounded-circle shadow-1-strong ms-4" src="<?= base_url() ?>/images/<?= user()->foto; ?>" alt="avatar" width="65" height="65" />
                                                                <?php
                                                                } else {
                                                                    // Jika foto telah diubah, tampilkan dari folder 'uploads'
                                                                ?>
                                                                    <img class="rounded-circle shadow-1-strong ms-4" src="<?= base_url('uploads/' . user()->foto); ?>" alt="avatar" width="65" height="65" />
                                                                <?php
                                                                }
                                                                ?>
                                                                <input type="hidden" name="review_id" value="<?= $review['reviewsid'] ?>">
                                                                <input type="text" class="form-control" name="reply" placeholder="Reply to @<?= $review['nama'] ?>" />
                                                                <button type="submit" class="btn btn-primary btn-sm ms-3">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <?php foreach ($reviews as $review) : ?>
                                            <div class="review-item">
                                                <div class="d-flex flex-start">
                                                    <?php
                                                    if ($review['foto'] === 'default.png') {
                                                        // Jika foto adalah foto default, tampilkan dari folder 'images'
                                                    ?>
                                                        <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url() ?>/images/<?= $review['foto']; ?>" alt="avatar" width="65" height="65" />
                                                    <?php
                                                    } else {
                                                        // Jika foto telah diubah, tampilkan dari folder 'uploads'
                                                    ?>
                                                        <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url('uploads/' . $review['foto']); ?>" alt="avatar" width="65" height="65" />
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="flex-grow-1 flex-shrink-1">
                                                        <div class="mb-3 mt-3">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-1">
                                                                    <?= $review['nama'] ?> <span class="small">- <?= date('l, d F Y', strtotime($review['created_at'])); ?></span>
                                                                </p>
                                                                <a href="javascript:void(0);" class="reply-button" data-review-id="<?= $review['reviewsid'] ?>">
                                                                    <i class="fas fa-solid fa-comments fa-lg"></i><span class="small"></span>
                                                                </a>
                                                            </div>
                                                            <p class="small mb-0">
                                                                <?= $review['review'] ?>
                                                            </p>
                                                        </div>

                                                        <div class="replies-container">
                                                            <?php foreach ($replies as $reply) : ?>
                                                                <div id="reviewsContainer" class="d-flex flex-start mt-4">
                                                                    <a class="me-3" href="#">
                                                                        <?php if ($reply['foto'] === 'default.png') : ?>
                                                                            <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url() ?>/images/<?= $reply['foto']; ?>" alt="avatar" width="65" height="65" />
                                                                        <?php else : ?>
                                                                            <img class="rounded-circle shadow-1-strong me-3" src="<?= base_url('uploads/' . $reply['foto']); ?>" alt="avatar" width="65" height="65" />
                                                                        <?php endif; ?>
                                                                    </a>
                                                                    <div class="flex-grow-1 flex-shrink-1">
                                                                        <div>
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <p class="mb-1">
                                                                                    <?= $reply['nama']; ?> <span class="small">- <?= date('l, d F Y', strtotime($reply['created_at'])); ?></span>
                                                                                </p>
                                                                            </div>
                                                                            <p class="small mb-1">
                                                                                <?= $reply['reply']; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Reviews -->

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
                                    <div class="d-flex align-items-center mt-3">
                                        <!-- User photo -->
                                        <?php
                                        if ($relatedProduct['foto'] === 'default.png') {
                                            // Jika foto adalah foto default, tampilkan dari folder 'images'
                                        ?>
                                            <img src="<?= base_url() ?>/images/' <?= $relatedProduct['foto'] ?>" alt="User Photo" class="rounded-circle me-3" style="width: 30px; height: 30px;">
                                        <?php
                                        } else {
                                            // Jika foto telah diubah, tampilkan dari folder 'uploads'
                                        ?>
                                            <img src="<?= base_url('uploads/' . $relatedProduct['foto']) ?>" alt="User Photo" class="rounded-circle me-3" style="width: 30px; height: 30px;">
                                        <?php
                                        }
                                        ?>
                                        <!-- Star icons -->
                                        <div class="star-rating">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <?php if ($i <= $relatedProduct['rating']) : ?>
                                                    <i class="fas fa-star text-warning"></i>
                                                <?php else : ?>
                                                    <i class="far fa-star text-warning"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            <span class="rating-text ms-2"><?= number_format($relatedProduct['rating'], 1, '.', ','); ?>/5</span>
                                        </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#reviewForm');
            const messageDiv = document.querySelector('#message');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                    });

                    if (response.ok) {
                        // Tampilkan pesan konfirmasi
                        messageDiv.innerHTML = '<p class="text-success">Review saved successfully!</p>';

                        // Bersihkan formulir
                        form.reset();

                        // Tunggu sebentar dan perbarui halaman
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        messageDiv.innerHTML = '<p class="text-danger">An error occurred while saving the review.</p>';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    messageDiv.innerHTML = '<p class="text-danger">An error occurred while saving the review.</p>';
                }
            });
        });
    </script>

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const replyButtons = document.querySelectorAll(".reply-button");

            // Function to close all reply forms
            function closeAllReplyForms() {
                const replyForms = document.querySelectorAll(".reply-form");
                replyForms.forEach(replyForm => {
                    replyForm.classList.add('d-none');
                });
            }

            replyButtons.forEach(replyButton => {
                replyButton.addEventListener("click", function() {
                    const replyForm = replyButton.closest('.review-item').querySelector('.reply-form');
                    replyForm.classList.toggle('d-none');
                });
            });

            // Close reply forms when clicking outside
            document.addEventListener("click", function(event) {
                const clickedElement = event.target;

                if (!clickedElement.closest(".review-item")) {
                    closeAllReplyForms();
                }
            });
        });
    </script> -->


    <!-- Ajax halaman reply -->
    <script>
        function createReviewElement(reviewData) {
            const reviewElement = document.createElement("div");
            reviewElement.classList.add("d-flex", "flex-start", "mt-4");
            reviewElement.innerHTML = `
        <a class="me-3" href="#">
            <img class="rounded-circle shadow-1-strong" src="${reviewData.avatar}" alt="avatar" width="65" height="65" />
        </a>
        <div class="flex-grow-1 flex-shrink-1">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-1">
                        ${reviewData.username} <span class="small">- ${reviewData.timestamp}</span>
                    </p>
                </div>
                <p class="small mb-1">
                    ${reviewData.reviewText}
                </p>
            </div>
        </div>
    `;

            return reviewElement;
        }
    </script>
    <!-- End Of Ajax Halaman reply -->
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const replyButtons = document.querySelectorAll(".reply-button");

            // Function to close all reply forms
            function closeAllReplyForms() {
                const replyForms = document.querySelectorAll(".reply-form");
                replyForms.forEach(replyForm => {
                    replyForm.classList.add('d-none');
                });
            }

            replyButtons.forEach(replyButton => {
                replyButton.addEventListener("click", function() {
                    const replyForm = replyButton.closest('.review-item').querySelector('.reply-form');
                    replyForm.classList.toggle('d-none');
                });
            });

            // Close reply forms when clicking outside
            document.addEventListener("click", function(event) {
                const clickedElement = event.target;

                if (!clickedElement.closest(".review-item")) {
                    closeAllReplyForms();
                }
            });

            const replyForms = document.querySelectorAll(".reply-form");

            replyForms.forEach(replyForm => {
                replyForm.addEventListener("submit", function(event) {
                    event.preventDefault();

                    const formData = new FormData(replyForm);
                    const url = replyForm.getAttribute("action");

                    fetch(url, {
                            method: "POST",
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.message);

                            if (data.success) {
                                const reviewContainer = replyForm.closest('.review-item');
                                const reviewsContainer = document.querySelector('.replies-container',
                                    '.reviewsContainer');

                                const replyContent = `
                                <div id="reviewsContainer" class="d-flex flex-start mt-4">
                                    <div class="d-flex flex-start mt-4">
                                        <a class="me-3" href="#">
                                            <img class="rounded-circle shadow-1-strong me-3" src="${data.reply.foto}" alt="avatar" width="65" height="65" />
                                        </a>
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1">
                                                        ${data.reply.nama} <span class="small">- ${data.reply.created_at}</span>
                                                    </p>
                                                </div>
                                                    <p class="small mb-1">
                                                    ${data.reply.reply}
                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                                const newReply = document.createElement('div');
                                newReply.classList.add('review-item');
                                newReply.innerHTML = replyContent;

                                reviewsContainer.insertBefore(newReply, reviewContainer.nextSibling);

                                replyForm.classList.add('d-none');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            });
        });
    </script>



</body>

</html>