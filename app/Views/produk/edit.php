<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/caraousel.css">
    <link href="<?= base_url(); ?>/src/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Vj6tzy4Hg7J1K25b4ml2p15zYLq6xWq5rI3/ABttrKA2Ap" crossorigin="anonymous">

</head>


<body>

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
                            <?php if (logged_in()) : ?>
                                <!-- Bell Notification Dropdown -->
                                <li class="nav-item dropdown no-arrow me-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="bellDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bell"></i>
                                        <!-- Notification Badge (optional) -->
                                        <span class="badge bg-danger">3</span>
                                    </a>
                                    <!-- Bell Notification Dropdown Menu -->
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bellDropdown">
                                        <!-- Notification Items -->
                                        <li><a class="dropdown-item" href="#">Notification 1</a></li>
                                        <li><a class="dropdown-item" href="#">Notification 2</a></li>
                                        <li><a class="dropdown-item" href="#">Notification 3</a></li>
                                        <!-- Add more notification items as needed -->
                                    </ul>
                                </li>

                                <!-- Chat Notification Dropdown -->
                                <li class="nav-item dropdown no-arrow me-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="chatDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-comments"></i>
                                        <!-- Notification Badge (optional) -->
                                        <span class="badge bg-danger">5</span>
                                    </a>
                                    <!-- Chat Notification Dropdown Menu -->
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chatDropdown">
                                        <!-- Chat Notification Items -->
                                        <li><a class="dropdown-item" href="#">Chat 1</a></li>
                                        <li><a class="dropdown-item" href="#">Chat 2</a></li>
                                        <li><a class="dropdown-item" href="#">Chat 3</a></li>
                                        <!-- Add more chat notification items as needed -->
                                    </ul>
                                </li>
                            <?php else : ?>

                            <?php endif ?>

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
                                        <a class="dropdown-item" href="<?= base_url('user/settings'); ?>">
                                            <i class="fas fa-solid fa-sliders-alt mr-2 text-gray-400"></i>
                                            Reservation
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url('user/settings'); ?>">
                                            <i class="fas fa-solid fa-sliders-alt mr-2 text-gray-400"></i>
                                            Transaction
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url('user/settings'); ?>">
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


    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <!-- Product Form Card -->
                <p>Edit Package</p>
                <div class="card mt-4">
                    <form action="<?= site_url('produk/update/' . $product['produkid']); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <!-- Product Details Section -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Package:</label>
                                <input type="text" name="nama_produk" id="name" class="form-control" required value="<?= old('nama_produk', $product['nama_produk']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description Package:</label>
                                <textarea name="description" id="description" rows="4" class="form-control"><?= old('description', $product['description']); ?></textarea>
                            </div>
                            <!-- Price Input Section -->
                            <div class="mb-5">
                                <label for="price" class="form-label">Price: Rp.</label>
                                <input type="text" inputmode="numeric" name="harga_produk" id="price" class="form-control" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= old('harga_produk', $product['harga_produk']); ?>">
                                <div class="invalid-feedback">Please enter a valid price (numbers only).</div>
                            </div>

                            <!-- Kategori Data Section -->
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Menu:</label>
                                <div class="input-container">
                                    <button type="button" class="add-icon btn btn-circle btn-outline-dark mb-3">Tambah +</button>
                                </div>
                                <div class="additional-info">
                                        <input type="text" name="nama_menu[]" class="form-control mb-3" required value="<?= old('nama_menu', $product['nama_menu']); ?>">
                                        <textarea name="deskripsi[]" class="form-control mb-3" required><?= old('deskripsi', $product['deskripsi']); ?></textarea>
                                </div>
                            </div>

                            <!-- Photo Upload Sections -->
                            <div class="row justify-content-center">
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <div class="photo-upload-section">
                                        <img src="<?= base_url('uploads/' . $product['photos_filenames']); ?>" class="uploaded-image" alt="Uploaded Photo">
                                        <input type="file" class="file-input" accept="image/*" name="photos_filenames" onchange="previewImage(event)">
                                    </div>
                                </div>
                            </div>

                            <!-- Save Button -->
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-md-6 text-center">
                                <a href="<?= base_url('admin') ?>">
                                    <button type="button" class="btn btn-secondary">Cancel</button>
                                </a>
                            </div>
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
        document.addEventListener("DOMContentLoaded", function() {
            // Get the add icon button and additional info container
            const addIconBtn = document.querySelector(".add-icon");
            const additionalInfoContainer = document.querySelector(".additional-info");

            // Add event listener to the add icon button
            addIconBtn.addEventListener("click", function() {
                // Clone the default input fields
                const newInputFields = additionalInfoContainer.cloneNode(true);

                // Clear the values of the new input fields
                const inputs = newInputFields.querySelectorAll("input, textarea");
                inputs.forEach(input => input.value = "");

                // Append the new input fields below the existing ones
                additionalInfoContainer.parentNode.insertBefore(newInputFields, additionalInfoContainer.nextSibling);
            });
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>