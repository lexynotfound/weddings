<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Payment</a></li>
                        <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $payment['id_payment']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">Invoice #<?= $payment['id_payment']; ?>
                                <?php if (strpos($payment['id_payment'], 'PAYDP-') !== false) { ?>
                                    <span class="badge bg-primary font-size-12 ms-2">DP Payment</span>
                                <?php } else { ?>
                                    <span class="badge bg-success font-size-12 ms-2">Full Payment</span>
                                <?php } ?>
                            </h4>
                            <h2 class="mb-4">Tendahjyus.com</h2>
                            <address class="text-muted">
                                <?= $payment['product_lokasi']; ?><br>
                                <i class="uil uil-envelope-alt me-1"></i> <?= $payment['product_email']; ?><br>
                                <i class="uil uil-phone me-1"></i> <?= $payment['product_telepon']; ?>
                            </address>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Billed To:</h5>
                                    <h5 class="font-size-15 mb-2"><?= $payment['payment_nama']; ?></h5>
                                    <p class="mb-1"><?= $payment['payment_lokasi']; ?></p>
                                    <p><?= $payment['payment_email']; ?></p>
                                    <p><?= $payment['payment_telepon']; ?></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>#<?= $payment['id_payment']; ?></p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p><?= $payment['payment_date']; ?></p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Order No:</h5>
                                        <p>#<?= $payment['id_transaksi']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <h5 class="font-size-15">Order Summary</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <?php if (strpos($payment['id_payment'], 'PAYDP-') !== false) { ?>
                                                <th>DP</th>
                                            <?php } ?>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">01</th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14 mb-1"></h5>
                                                    <p class="text-muted mb-0"><?= $payment['nama_produk']; ?></p>
                                                </div>
                                            </td>
                                            <td>Rp.<?= number_format($payment['harga_produk'], 0, ',', '.'); ?></td>
                                            <?php if (strpos($payment['id_payment'], 'PAYDP-') !== false) { ?>
                                                <td>30%</td>
                                            <?php } ?>
                                            <td class="text-end">Rp.<?= number_format($payment['total_payment'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                            <td class="text-end">Rp.<?= number_format($payment['total_payment'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <!-- end tr -->
                                        <?php if (strpos($payment['id_payment'], 'PAYDP-') !== false) { ?>
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Remaining Payment :</th>
                                                <td class="border-0 text-end" id="sisa_pembayaran">Rp.<?= number_format($payment['total_payment'], 0, ',', '.'); ?></td>
                                            </tr>
                                            <!-- end tr -->
                                        <?php } ?>
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                            <td class="border-0 text-end">
                                                <h4 class="m-0 fw-semibold">Rp.<?= number_format($payment['total_payment'], 0, ',', '.'); ?></h4>
                                            </td>
                                        </tr>
                                        <!-- end tr -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                    <!-- <a href="#" class="btn btn-primary w-md">Send</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (strpos($payment['id_payment'], 'PAYDP-') !== false) { ?>
        <script>
            // Menggunakan JavaScript untuk menghitung sisa pembayaran dari 30% dari harga produk
            document.addEventListener('DOMContentLoaded', function() {
                const hargaProduk = <?= $payment['harga_produk']; ?>;
                const dpPercentage = 0.3;
                const dpAmount = hargaProduk * dpPercentage;
                const totalPayment = <?= $payment['total_payment']; ?>;
                const sisaPembayaran = hargaProduk - totalPayment;
                const formattedSisaPembayaran = sisaPembayaran.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });

                const sisaPembayaranElement = document.querySelector('td[id="sisa_pembayaran"]');
                sisaPembayaranElement.innerHTML = ` ${formattedSisaPembayaran}`;
            });
        </script>
    <?php } ?>

</body>

</html>