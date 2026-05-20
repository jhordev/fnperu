<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <title>Iniciar Sesión - Dashboard - FN Perú</title>

    <link rel="shortcut icon" href="<?= $assets_url ?>/admin/images/logos/favicon-dashboard.png" type="image/x-icon">

    <link href="<?= $assets_url ?>/general/bootstrap-5.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/fontawesome-6.0/css/all.min.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/icomoon/style.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/icofont/icofont.min.css" rel="stylesheet">

    <link href="<?= $assets_url ?>/general/normalize-8.0/normalize.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/filerequired/filerequired.css?v=<?= $media_version ?>" rel="stylesheet">

    <link href="<?= $assets_url ?>/admin/cfn/login/login.css?v=<?= $media_version ?>" rel="stylesheet">
</head>

<body>

    <div class="d-md-flex half login-container">
        <div class="bg" style="background-image: url('<?= $assets_url ?>/admin/images/general/login.jpg');"></div>
        <div class="contents">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <div class="form-block mx-auto">

                            <div class="logo_login user-select-none pe-none">
                                <img src="<?= $assets_url ?>/web/images/logos/LOGO_FN.png" alt="">
                            </div>

                            <div class="text-center mb-3">
                                <h3 class="text-uppercase login_title"><strong>DashBoard</strong> - F&N CONSTRUCTORES GENERALES S.A.C.</h3>
                            </div>

                            <form action="" method="post" autocomplete="off" id="form_login">

                                <div class="form-group first">
                                    <label for="username" class="mb-1">Usuario:</label>
                                    <input type="text" class="form-control mb-3" name="user" id="username" required>
                                </div>

                                <div class="form-group last mb-4">
                                    <label for="password" class="mb-1">Contraseña:</label>
                                    <input type="password" class="form-control mb-3" name="pass" id="password" required>
                                </div>

                                <div class="login_opcions d-sm-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator"></div>
                                    </label>
                                    <span class="ms-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                                </div>

                                <input type="submit" value="Iniciar Sesión" class="btn btn-block py-2 btn-primary w-100 login_btn">

                                <span class="text-center my-3 d-block user-select-none">O</span>


                                <div class="">
                                    <a href="#" class="btn btn-block py-2 btn-facebook w-100 disabled">
                                        <i class="fa-brands fa-facebook-f me-2"></i>Ingresar con facebook
                                    </a>
                                    <a href="#" class="btn btn-block py-2 btn-google w-100 mt-2 disabled">
                                        <span class="icon-google me-2"></span>Ingresar con Google
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php /*
    <!-- <div class="sheriff-main">
        <div class="sheriff-modal">
            <div class="sheriff-header">
                <div class="sheriff-title">ALERT</div>
                <div class="sheriff-close"><i class="fa-solid fa-xmark"></i></div>
            </div>
            <div class="sheriff-body">
                <div class="sheriff-icon"><i class="icofont-close-circled"></i></div>
                <div class="sheriff-content">Ocurrio Algo inesperado</div>
            </div>
        </div>
    </div> --> */

    require_once dirname(__FILE__) . '/../Template/filerequired.php'; ?>

    <script>
        const base_url = "<?= $base_url ?>";
    </script>

    <script src="<?= $assets_url ?>/general/jquery-3.6/jquery.min.js"></script>
    <script src="<?= $assets_url ?>/general/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $assets_url ?>/general/filerequired/filerequired.js?v=<?= $media_version ?>"></script>
    <script src="<?= $assets_url ?>/admin/cfn/login/login.js?v=<?= $media_version ?>"></script>
</body>

</html>
