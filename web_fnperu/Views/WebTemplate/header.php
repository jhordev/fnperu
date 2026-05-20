<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="description" content="FN Perú">
    <meta name="author" content="FN Perú">

    <?php if (!isset($page_viewport) || (isset($page_viewport) && $page_viewport == true)) { ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php } ?>

    <link rel="shortcut icon" href="<?= $assets_url ?>/web/images/logos/favicon.png?v=<?= $media_version ?>" type="image/x-icon">

    <title><?= $page_title === '' ? '' : $page_title . ' - ' ?>F&N CONSTRUCTORES GENERALES S.A.C.<?= $page_title === '' ? ' - Inicio' : '' ?></title>

    <link href="<?= $assets_url ?>/general/bootstrap-5.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/fontawesome-6.0/css/all.min.css" rel="stylesheet">

    <?php if (isset($page_owl) && $page_owl == true) { ?>
        <link rel="stylesheet" href="<?= $assets_url ?>/general/OwlCarousel2-2.3/dist/assets/owl.carousel.min.css">
    <?php } ?>

    <?php if (isset($icomoon) && $icomoon == true) { ?>
        <link href="<?= $assets_url ?>/general/icomoon/style.css" rel="stylesheet">
    <?php } ?>

    <?php if (isset($icofont) && $icofont == true) { ?>
        <link href="<?= $assets_url ?>/general/icofont/icofont.min.css" rel="stylesheet">
    <?php } ?>

    <link href="<?= $assets_url ?>/general/normalize-8.0/normalize.css?v=<?= $media_version ?>" rel="stylesheet">

    <link href="<?= $assets_url ?>/web/cfn/template.css?v=<?= $media_version ?>" rel="stylesheet">

    <?php if (isset($page_css)) { ?>
        <link rel="stylesheet" href="<?= $assets_url ?>/web/cfn/<?= $page_css ?>.css?v=<?= $media_version ?>">
    <?php } ?>

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader_page">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <header id="header_page_web" class="">
        <div class="contaner_general row">
            <a id="container_logo" class="row mx-0 user-select-none" href="<?= $base_url ?>">
                <img draggable="false" src="<?= $assets_url ?>/web/images/logos/LOGO_FN.png" class="px-0" alt="">
                <p><span>F&N</span> CONSTRUCTORES GENERALES S.A.C.</p>
            </a>

            <div id="container_menu">
                <div class="text-end mt-2 user-select-none">
                    <a href="<?= $base_url ?>/campus" id="menu_btn_campus" target="_blank">CAMPUS VIRTUAL</a>
                    <a href="https://wa.me/51990252507?text=Hola,%20información%20por%20favor" target="_blank" id="menu_btn_whatsapp">WHATSAPP &nbsp; 990 252 507</a>

                    <div class="btn_menu_main"><span class="fw-600 fs-16 me-1">MENÚ</span> <i class="fa-solid fa-bars"></i></div>
                </div>

                <div id="menu_inferior">
                    <ul>
                        <li class="<?= (isset($page_active) && $page_active == 'inicio') ? 'active' : '' ?>">
                            <a class="w-100 h-100" href="<?= $base_url ?>">INICIO</a>
                        </li>
                        <li>
                            <a class="w-100 h-100" href="<?= (isset($page_active) && $page_active == 'inicio') ? '' : $base_url . '/' ?>#urbanizaciones">URBANIZACIONES</a>
                        </li>
                        <li>
                            <a class="w-100 h-100" href="<?= (isset($page_active) && $page_active == 'inicio') ? '' : $base_url . '/' ?>#cursos">CURSOS</a>
                        </li>
                        <li>
                            <a class="w-100 h-100" href="<?= (isset($page_active) && $page_active == 'inicio') ? '' : $base_url . '/' ?>#talleres">TALLERES</a>
                        </li>
                        <li class="<?= (isset($page_active) && $page_active == 'nosotros') ? 'active' : '' ?>">
                            <a class="w-100 h-100" href="<?= $base_url ?>/nosotros">NOSOTROS</a>
                        </li>
                        <li class="<?= (isset($page_active) && $page_active == 'contactenos') ? 'active' : '' ?>">
                            <a class="w-100 h-100" href="<?= $base_url ?>/contacto">CONTACTO</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </header>
