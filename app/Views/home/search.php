<?php
// Fungsi untuk membatasi teks dan menambahkan elipsis
function truncateText($text, $length)
{
    if (strlen($text) <= $length) {
        return $text;
    } else {
        return substr($text, 0, $length) . '...';
    }
}
?>
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

        .icon-img {
            width: 20px;
            /* Ubah ukuran gambar sesuai kebutuhan */
            height: 20px;
            /* Ubah ukuran gambar sesuai kebutuhan */
        }
    </style>
</head>

<body>

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

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card shadow">
                    <!-- ... (Categories and Product type filters) ... -->
                    <div class="card-body">
                        <h3 class="h5 card-title">Categories</h3>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" value="" id="cartCheck6">
                                    <label class="form-check-label" for="cartCheck6">
                                        All Products
                                    </label>
                                </div>
                            </div>
                            <!-- Filter by Categories -->
                            <div class="col-12">
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" value="Bundle" id="cartCheck8">
                                    <label class="form-check-label" for="cartCheck8">
                                        Bundle
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" value="Non-Bundle" id="cartCheck9">
                                    <label class="form-check-label" for="cartCheck9">
                                        Non-Bundle
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" value="Documentation" id="cartCheck10">
                                    <label class="form-check-label" for="cartCheck10">
                                        Documentation
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="h5 card-title">Package type</h3>
                        <ul class="list-group text-gray">
                            <?php foreach ($categories as $kategori) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                                    <label class="text-decoration-none"><?= $kategori['nama']; ?></label>
                                    <span class="badge bg-dark badge-pill"><?= $kategori['jumlah_produk']; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- Price range filter -->
                    <div class="card-body">
                        <h3 class="h5 card-title">Price range</h3>
                        <!-- Simple slider -->
                        <div class="input-slider-container">
                            <div id="input-slider-ecommerce" class="input-slider" data-range-value-min="0" data-range-value-max="5000000000"></div>
                            <input type="range" class="form-range" min="0" max="5000000000" step="1" id="customRange2">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <label for="priceRangeMin1">Min</label>
                                        <label for="priceRangeMax1">Max</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <input class="form-control" id="priceRangeMin1" placeholder="Rp.0" type="text" min="0" max="5000000000">
                                        <input class="form-control" id="priceRangeMax1" placeholder="Rp.5,000,000,000" type="text" min="0" max="5000000000">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Slider -->
                        <div class="d-grid mt-3">
                            <!-- Ganti tautan '#' dengan URL aksi pencarian Anda -->
                            <a href="<?= base_url('home/search') ?>" class="btn btn-tertiary" id="applyFilter">Apply</a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Product Content -->
            <div class="col-12 col-md-9">
                <div class="row justify-content-beetween"> <!-- Menyusun produk di tengah-tengah -->
                    <?php foreach ($produk as $item) : ?>
                        <div id="searchResults" class="col-12 col-md-6 col-lg-4 mb-2"> <!-- Mengatur ukuran card -->
                            <div class="card shadow mb-4">
                                <a href="<?= base_url('home/detail/' . $item['produkid']); ?>" class="nav-link">
                                    <img src="<?= base_url('uploads/' . $item['photos_filenames']) ?>" alt="<?= $item['photos_filenames'] ?>" class="custom-card-img rounded-2">
                                    <div class="card-footer border-top border-gray-300 p-4">
                                        <h5 class="h5"><?= $item['nama_produk'] ?></h5>
                                        <h3 class="h6 fw-light text-gray mt-2"><?= truncateText($item['description'], 80); ?></h3>
                                        <?php
                                        $rating = round($item['avg_rating']); // Mengubah nilai rata-rata menjadi angka bulat
                                        $fullStars = min($rating, 5); // Batasi hingga 5 bintang
                                        ?>
                                        <div class="d-flex mt-3">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <?php if ($i <= $fullStars) : ?>
                                                    <span class="star fas fa-star text-warning me-1"></span>
                                                <?php else : ?>
                                                    <span class="star far fa-star text-warning me-1"></span>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            <span class="badge bg-primary ms-2"><?= $rating ?>.0</span>
                                            <span class="badge bg-primary ms-2"><?= $item['total_reviews'] ?> people</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <span class="h6 mb-0 text-gray">Rp.<?= number_format($item['harga_produk'], 0, ',', '.'); ?></span>
                                            <a class="btn btn-xs btn-tertiary" href="#">
                                                <?php
                                                if ($item['foto'] === 'default.png') {
                                                    // Jika foto adalah foto default, tampilkan dari folder 'images'
                                                ?>
                                                    <img src="<?= base_url(); ?>/images/<?= $item['foto']; ?>" alt="" class="icon-img"><span class=" me-1"></span> <?= $item['nama']; ?>
                                                <?php
                                                } else {
                                                    // Jika foto telah diubah, tampilkan dari folder 'uploads'
                                                ?>
                                                    <img src="<?= base_url('./uploads/' . $item['foto']) ?>" class="icon-img" alt=""><span class=" me-1"></span> <?= $item['nama']; ?>
                                                <?php
                                                }
                                                ?>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-4">
                    <nav aria-label="Product Pagination">
                        <ul class="pagination pagination-sm">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
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
        const applyFilterBtn = document.getElementById("applyFilter");
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

        applyFilterBtn.addEventListener("click", function(e) {
            e.preventDefault();

            const minPrice = parseCurrency(priceRangeMinInput.value);
            const maxPrice = parseCurrency(priceRangeMaxInput.value);

            // Mendapatkan nilai checkbox yang dipilih
            const selectedCategories = [];
            const checkboxes = document.querySelectorAll('.form-check-input:checked');
            checkboxes.forEach(checkbox => {
                selectedCategories.push(checkbox.value);
            });
            // Ganti URL aksi pencarian dengan URL yang sesuai
            const searchUrl = '<?= base_url('home/search') ?>';
            const newUrl = new URL(searchUrl);

            if (!isNaN(minPrice)) {
                newUrl.searchParams.set("q", "min_price" + minPrice);
            }

            if (!isNaN(maxPrice)) {
                newUrl.searchParams.set("max_price", maxPrice);
            }

            if (selectedCategories.length > 0) {
                newUrl.searchParams.set("q", "category", selectedCategories.join(','));
            }

            window.location.href = newUrl.toString();
        });
    </script>

    <script>
        const categoryCheckboxes = document.querySelectorAll('.form-check-input');
        const selectedCategories = [];

        categoryCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedCategories.push(checkbox.value);
            }
        });

        if (selectedCategories.length > 0) {
            newUrl.searchParams.set("categories", selectedCategories.join(','));
        }
    </script>

    <script>
        // Fungsi untuk mengirim permintaan AJAX dan memperbarui hasil pencarian
        function updateSearchResults() {
            const formData = new FormData(document.getElementById('filterForm'));

            fetch('<?= base_url('home/search') ?>', {
                    method: 'GET',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('searchResults').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }

        // Menangani perubahan pada checkbox
        const checkboxes = document.querySelectorAll('.form-check-input');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                updateSearchResults();
            });
        });

        // Panggil fungsi pertama kali saat halaman dimuat
        updateSearchResults();
    </script>


</body>

</html>