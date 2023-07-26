<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepertinya ada masalah...</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" role="alert" style="height: 300px;">
        <div class="text-center">
            <img src="<?= base_url() ?>/images/notproduct.svg" alt="Package not found." class="img-fluid mb-3" style="max-width: 350px;" />
            <p class="mb-2" style="font-size: 30px; font-weight: bold;">Yaah Sayang Sekali Paket Yang anda cari tidak ada. Mungkin ada di tempat lain</p>
            <a href="<?= base_url('home') ?>">
                <button class="btn btn-info">Mungkin Disi</button>
            </a>
        </div>
    </div>
</body>

</html>