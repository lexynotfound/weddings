<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="<?= base_url(); ?>/src/bootstrap/dist/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>/src/bootstrap/dist/css/mystyle.css">
    <script src="<?= base_url(); ?>/src/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="<?= base_url(); ?>/src/bootstrap/dist/js/dropdown-hoover.js"></script>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <?= view('Myth\Auth\Views\_message_block') ?>
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="<? base_url() ?>/images/brides.jpg" class="img-fluid mt-5" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-3">
                    <form action="<?= url_to('login') ?>" method="post" class="mx-1 mx-md-3 mt-5">
                        <?= csrf_field() ?>

                        <!-- Email username input -->
                        <?php if ($config->validFields === ['email']) : ?>
                            <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="login"><?= lang('Auth.email') ?></label>
                                <input type="email" id="form3Example1c" class="form-control" <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                    <input type="text" id="form3Example4c" class="form-control" <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="password"><?= lang('Auth.password') ?></label>
                                <input type="password" name="password" id="form3Example4c" class="form-control" <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <?php if ($config->allowRemembering) : ?>
                                <div class="form-check mb-2">
                                    <label class="form-check-label mx-5">
                                        <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                        <?= lang('Auth.rememberMe') ?>
                                    </label>
                                    <label class="form-check-label" for="form2Example3">
                                        <?php if ($config->activeResetter) : ?>
                                            <p><a class="nav-link text-primary" href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                                        <?php endif; ?>
                                    </label>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-1">
                            <button type="submit" class="btn btn-primary btn-lg btn-block mb-2"><?= lang('Auth.loginAction') ?></button>
                            <?php if ($config->allowRegistration) : ?>
                                <p><a class="nav-link text-primary" href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
                            <?php endif; ?>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>