<!doctype html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="description" content="FN Perú">
    <meta name="author" content="FN Perú">

    <?php if (isset($page_viewport) && $page_viewport == true) { ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php } ?>

    <link rel="shortcut icon" href="<?= $assets_url ?>/admin/images/logos/favicon-dashboard.png" type="image/x-icon">

    <title><?= $page_title ?> - Dashboard - FN Perú</title>

    <link href="<?= $assets_url ?>/general/bootstrap-5.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/fontawesome-6.0/css/all.min.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/icomoon/style.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/hamburgers-1.1/hamburgers.min.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/metismenu-3.0/dist/metisMenu.min.css" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/icofont/icofont.min.css" rel="stylesheet">

    <?php if (isset($page_jq_ui) && $page_jq_ui == true) { ?>
        <link rel="stylesheet" href="<?= $assets_url ?>/general/jquery-ui-1.13/jquery-ui.min.css">
    <?php } ?>

    <?php if (isset($page_swalert) && $page_swalert == true) { ?>
        <link rel="stylesheet" href="<?= $assets_url ?>/general/sweetalert2-11.4/dist/sweetalert2.min.css">
    <?php } ?>

    <?php if (isset($page_datatable) && $page_datatable == true) { ?>
        <link rel="stylesheet" href="<?= $assets_url ?>/general/DataTables-1.11/DataTables-1.11.4/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="<?= $assets_url ?>/general/DataTables-1.11/Select-1.3.4/css/select.bootstrap5.min.css">
    <?php } ?>

    <?php if (isset($page_owl) && $page_owl == true) { ?>
        <link rel="stylesheet" href="<?= $assets_url ?>/general/OwlCarousel2-2.3/dist/assets/owl.carousel.min.css">
    <?php } ?>

    <link href="<?= $assets_url ?>/general/normalize-8.0/normalize.css?v=<?= $media_version ?>" rel="stylesheet">

    <link href="<?= $assets_url ?>/admin/cfn/template/template.css?v=<?= $media_version ?>" rel="stylesheet">
    <link href="<?= $assets_url ?>/general/filerequired/filerequired.css?v=<?= $media_version ?>" rel="stylesheet">
    <link href="<?= $assets_url ?>/admin/cfn/template/generalStyles.css?v=<?= $media_version ?>" rel="stylesheet">

    <?php if (isset($page_css)) { ?>
        <link rel="stylesheet" href="<?= $assets_url ?>/admin/cfn/<?= $page_css ?>.css?v=<?= $media_version ?>">
    <?php } ?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo border-end">
                <div class="logo-src">
                    <img src="<?= $assets_url ?>/admin/images/logos/logo-horizontal.png" alt="">
                </div>
                <div class="header__pane ms-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="logo-src d-none">
                        <img src="<?= $assets_url ?>/admin/images/logos/logo-horizontal.png" alt="">
                    </div>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  me-3 header-user-info">
                                    <div class="widget-heading">
                                        Elimelex Fernandez
                                    </div>
                                    <div class="widget-subheading text-end">
                                        Administrador
                                    </div>
                                </div>
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="40" class="rounded-circle" src="<?= $assets_url ?>/admin/images/logos/logo-principal.jpg" alt="">
                                            <i class="fa fa-angle-down ms-1 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item"><i class="fa-solid fa-user" style="width:20px"></i> Cuenta de Usuario</button>
                                            <button type="button" tabindex="0" class="dropdown-item"><i class="fa-solid fa-gear" style="width:20px"></i> Configuraciones</button>
                                            <a href="<?= $base_url ?>/logout" class="dropdown-item text-danger"><i class="fa-solid fa-arrow-right-from-bracket" style="width:20px"></i> Salir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src" style="background: url(<?= $assets_url ?>/admin/images/logos/logo-horizontal.png)"></div>
                    <div class="header__pane ms-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu mt-3">
                            <li>
                                <a href="<?= $base_url ?>" class="<?= ($page_active == 'inicio') ? 'mm-active' : '' ?>">
                                    <i class="metismenu-icon icon-meter"></i>
                                    Tablero
                                </a>
                            </li>
                            <li class="app-sidebar__heading">F&N CONSTRUCTORES</li>

                            <li>
                                <a href="<?= $base_url ?>/urbanizaciones" class="<?= ($page_active == 'urbanization') ? 'mm-active' : '' ?>">
                                    <i class="metismenu-icon fa-solid fa-house-flag"></i>
                                    Urbanizaciones
                                </a>
                            </li>

                            <li class="app-sidebar__heading">FN PERÚ</li>

                            <li class="d-none">
                                <a href="#">
                                    <i class="metismenu-icon icon-folder"></i>
                                    Elements
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="metismenu-icon"></i>
                                            Buttons
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="metismenu-icon">
                                            </i>Dropdowns
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= $base_url ?>/cursos" class="<?= ($page_active == 'cursos') ? 'mm-active' : '' ?>">
                                    <i class="metismenu-icon fa-solid fa-signature"></i>
                                    Cursos
                                </a>
                            </li>
                            <li>
                                <a href="<?= $base_url ?>/lanzamientos" class="<?= ($page_active == 'lanzamientos') ? 'mm-active' : '' ?>">
                                    <i class="metismenu-icon fa-solid fa-calendar"></i>
                                    Lanzamientos
                                </a>
                            </li>
                            <li>
                                <a href="<?= $base_url ?>/solicitudmatricula" class="<?= ($page_active == 'soli_matricula') ? 'mm-active' : '' ?>">
                                    <i class="metismenu-icon fa-solid fa-file-import"></i>
                                    Solicitud de Matrícula
                                </a>
                            </li>
                            <li>
                                <a href="<?= $base_url ?>/accesosdirectosmoodle" class="<?= ($page_active == 'accesos_directos') ? 'mm-active' : '' ?>">
                                    <i class="metismenu-icon fa-solid fa-compass"></i>
                                    Accesos Directos
                                </a>
                            </li>

                            <li class="app-sidebar__heading">SISTEMA</li>

                            <li>
                                <a href="<?= $base_url ?>/configuracion" class="<?= ($page_active == 'configuracion') ? 'mm-active' : '' ?>">
                                    <i class="metismenu-icon fa-solid fa-sliders"></i>
                                    Configuraciones
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
