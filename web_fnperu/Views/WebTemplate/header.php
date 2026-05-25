<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="description" content="FN Perú - Capacitación e ingeniería para profesionales">
    <meta name="author" content="FN Perú">

    <?php if (!isset($page_viewport) || (isset($page_viewport) && $page_viewport == true)) { ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php } ?>

    <link rel="shortcut icon" href="<?= $assets_url ?>/web/images/logos/favicon.png?v=<?= $media_version ?>" type="image/x-icon">

    <title><?= $page_title === '' ? '' : $page_title . ' - ' ?>F&N CONSTRUCTORES S.A.C.<?= $page_title === '' ? ' - Inicio' : '' ?></title>

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <link href="<?= $assets_url ?>/web/cfn/template.css?v=<?= $media_version ?>" rel="stylesheet">

    <?php if (isset($page_css)) { ?>
        <link rel="stylesheet" href="<?= $assets_url ?>/web/cfn/<?= $page_css ?>.css?v=<?= $media_version ?>">
    <?php } ?>

    <style>
        :root {
            --site-zoom: 1.18;
        }
        body {
            zoom: var(--site-zoom) !important;
        }
    </style>

</head>

<body>


    <!-- ===== Top Bar ===== -->
    <div class="topbar">
        <div class="topbar-inner">
            <div class="topbar-left">
                <a href="mailto:<?= htmlspecialchars($web_config['contacto_email'] ?? '') ?>" class="topbar-link">
                    <i class="fa-solid fa-envelope"></i>
                    <span><?= htmlspecialchars($web_config['contacto_email'] ?? '') ?></span>
                </a>
                <a href="tel:+51<?= preg_replace('/\D/', '', $web_config['contacto_telefono_1'] ?? '') ?>" class="topbar-link">
                    <i class="fa-solid fa-phone"></i>
                    <span><?= htmlspecialchars($web_config['contacto_telefono_1'] ?? '') ?></span>
                </a>
            </div>
            <div class="topbar-right">
                <?php if (!empty($web_config['campus_virtual_visible'])) { ?>
                <a href="<?= $base_url ?>/campus" class="topbar-btn-campus" target="_blank">
                    <i class="fa-solid fa-graduation-cap"></i>
                    Campus Virtual
                </a>
                <?php } ?>
                <a href="https://wa.me/51<?= preg_replace('/\D/', '', $web_config['contacto_telefono_1'] ?? '990252507') ?>?text=Hola,%20información%20por%20favor" target="_blank" class="topbar-btn-whatsapp">
                    <i class="fa-brands fa-whatsapp"></i>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- ===== Navbar ===== -->
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">

            <!-- Logo -->
            <a class="navbar-logo" href="<?= $base_url ?>">
                <img src="<?= $assets_url ?>/web/images/logos/LOGO_FN.png" alt="F&N Constructores" draggable="false">
                <div class="navbar-logo-text">
                    <span class="brand-name"><span class="accent">F&N</span></span>
                    <span class="brand-sub">CONSTRUCTORES S.A.C.</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <ul class="navbar-menu" id="navbarMenu">
                <li class="nav-item <?= (isset($page_active) && $page_active == 'inicio') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= $base_url ?>">Inicio</a>
                </li>
                <li class="nav-item <?= (isset($page_active) && $page_active == 'urbanizaciones') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= $base_url ?>/urbanizaciones">Urbanizaciones</a>
                </li>
                <li class="nav-item <?= (isset($page_active) && ($page_active == 'cursos' || $page_active == 'talleres')) ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= $base_url ?>/cursos">Cursos y Talleres</a>
                </li>
                <li class="nav-item <?= (isset($page_active) && $page_active == 'nosotros') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= $base_url ?>/nosotros">Nosotros</a>
                </li>
                <li class="nav-item <?= (isset($page_active) && $page_active == 'contactenos') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= $base_url ?>/contacto">Contacto</a>
                </li>
            </ul>

            <!-- Mobile Toggle -->
            <button class="navbar-toggle" id="navbarToggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="navbarMobile">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>

        </div>

        <!-- Mobile Menu -->
        <div class="navbar-mobile" id="navbarMobile" role="dialog" aria-modal="true" aria-label="Menú de navegación">
            <div class="mobile-menu-wrapper">

                <!-- Panel Header -->
                <div class="mobile-panel-head">
                    <a class="mobile-panel-brand" href="<?= $base_url ?>">
                        <img src="<?= $assets_url ?>/web/images/logos/LOGO_FN.png" alt="F&N Constructores" draggable="false">
                        <div class="mobile-panel-brand-text">
                            <span class="mpb-name"><span class="accent">F&N</span></span>
                            <span class="mpb-sub">CONSTRUCTORES S.A.C.</span>
                        </div>
                    </a>
                    <button class="mobile-close" id="mobileClose" aria-label="Cerrar menú">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>

                <!-- Nav Links -->
                <ul class="mobile-menu">
                    <li class="<?= (isset($page_active) && $page_active == 'inicio') ? 'active' : '' ?>">
                        <a href="<?= $base_url ?>">
                            <span class="mobile-link-bar"></span>
                            <span class="mobile-link-text">Inicio</span>
                        </a>
                    </li>
                    <li class="<?= (isset($page_active) && $page_active == 'urbanizaciones') ? 'active' : '' ?>">
                        <a href="<?= $base_url ?>/urbanizaciones">
                            <span class="mobile-link-bar"></span>
                            <span class="mobile-link-text">Urbanizaciones</span>
                        </a>
                    </li>
                    <li class="<?= (isset($page_active) && ($page_active == 'cursos' || $page_active == 'talleres')) ? 'active' : '' ?>">
                        <a href="<?= $base_url ?>/cursos">
                            <span class="mobile-link-bar"></span>
                            <span class="mobile-link-text">Cursos y Talleres</span>
                        </a>
                    </li>
                    <li class="<?= (isset($page_active) && $page_active == 'nosotros') ? 'active' : '' ?>">
                        <a href="<?= $base_url ?>/nosotros">
                            <span class="mobile-link-bar"></span>
                            <span class="mobile-link-text">Nosotros</span>
                        </a>
                    </li>
                    <li class="<?= (isset($page_active) && $page_active == 'contactenos') ? 'active' : '' ?>">
                        <a href="<?= $base_url ?>/contacto">
                            <span class="mobile-link-bar"></span>
                            <span class="mobile-link-text">Contacto</span>
                        </a>
                    </li>
                </ul>

                <!-- Action Buttons -->
                <div class="mobile-actions">
                    <?php if (!empty($web_config['campus_virtual_visible'])) { ?>
                    <a href="<?= $base_url ?>/campus" class="mobile-btn-campus" target="_blank">
                        <i class="fa-solid fa-graduation-cap"></i> Campus Virtual
                    </a>
                    <?php } ?>
                    <a href="https://wa.me/51<?= preg_replace('/\D/', '', $web_config['contacto_telefono_1'] ?? '990252507') ?>?text=Hola,%20información%20por%20favor" target="_blank" class="mobile-btn-whatsapp">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </nav>
