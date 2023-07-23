<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/css/mystyle.css">
    <script src="<?= base_url(); ?>/src/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url(); ?>/src/js/dropdown-hoover.js"></script>
</head>

<body>

    <section class="vh-100" style="background-color: #fbdfeb">
        <div class="container-fluid h-custom ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <?= view('Myth\Auth\Views\_message_block') ?>
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="<? base_url() ?>/images/lv.jpg" class="img-fluid mt-5" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-3">
                    <form action="<?= url_to('register') ?>" method="post" class="mx-1 mx-md-3 mt-5">
                        <?= csrf_field(); ?>
                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username"><?= lang('Auth.username') ?></label>
                            <input type="text" id="form3Example1c" class="form-control" <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email"><?= lang('Auth.email') ?></label>
                            <input type="email" id="form3Example1c" class="form-control" <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4c"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password" id="form3Example4c" class="form-control" <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>

                        <!-- Password  Repeat input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4cd"><?= lang('Auth.repeatPassword') ?></label>
                            <input type="password" name="pass_confirm" id="form3Example4cd" class="form-control" <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>


                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-block mb-3"><?= lang('Auth.register') ?></button>
                            <p> <a class="nav-link me-2 text-primary" href="<?= url_to('login') ?>"> <?= lang('Auth.alreadyRegistered') ?> <?= lang('Auth.signIn') ?></a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>