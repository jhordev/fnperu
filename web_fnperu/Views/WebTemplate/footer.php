    <!-- ===== Footer ===== -->
    <footer class="footer">
        <div class="footer-main">
            <div class="footer-inner">
                <div class="footer-grid">

                    <!-- Column 1: Brand -->
                    <div class="footer-col footer-brand">
                        <div class="footer-logo">
                            <img src="<?= $assets_url ?>/web/images/logos/LOGO_FN.png" alt="F&N Constructores">
                            <div>
                                <span class="footer-brand-name">F&N</span>
                                <span class="footer-brand-sub">CONSTRUCTORES S.A.C.</span>
                            </div>
                        </div>
                        <p class="footer-desc">Somos un grupo de profesionales capacitados en el área de ingeniería. Nuestra pasión es enseñar, capacitar e innovar temas relacionados con la ingeniería y arquitectura.</p>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/FNPERUINGENIERIA" target="_blank" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="https://youtube.com/c/ElimelexFernandezNarvaisFnper%C3%BA" target="_blank" aria-label="YouTube">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                            <a href="https://instagram.com/fnperu_ingenieria" target="_blank" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Column 2: Links -->
                    <div class="footer-col">
                        <h4 class="footer-title">Enlaces</h4>
                        <ul class="footer-links">
                            <li><a href="<?= $base_url ?>">Inicio</a></li>
                            <li><a href="<?= $base_url ?>/nosotros">Nosotros</a></li>
                            <li><a href="<?= $base_url ?>/contacto">Contacto</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Categorías -->
                    <div class="footer-col">
                        <h4 class="footer-title">Categorías</h4>
                        <ul class="footer-links">
                            <li><a href="<?= $base_url ?>/urbanizaciones">Urbanizaciones</a></li>
                            <li><a href="<?= $base_url ?>/cursos">Cursos</a></li>
                            <li><a href="<?= $base_url ?>/talleres">Talleres</a></li>
                        </ul>
                    </div>

                    <!-- Column 4: Contact -->
                    <div class="footer-col">
                        <h4 class="footer-title">Contacto</h4>
                        <ul class="footer-contact">
                            <?php if (!empty($web_config['contacto_direccion'])) { ?>
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <span><?= htmlspecialchars($web_config['contacto_direccion']) ?></span>
                            </li>
                            <?php } ?>
                            <?php if (!empty($web_config['contacto_telefono_1'])) { ?>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:+51<?= preg_replace('/\D/', '', $web_config['contacto_telefono_1']) ?>"><?= htmlspecialchars($web_config['contacto_telefono_1']) ?></a>
                            </li>
                            <?php } ?>
                            <?php if (!empty($web_config['contacto_telefono_2'])) { ?>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:+51<?= preg_replace('/\D/', '', $web_config['contacto_telefono_2']) ?>"><?= htmlspecialchars($web_config['contacto_telefono_2']) ?></a>
                            </li>
                            <?php } ?>
                            <?php if (!empty($web_config['contacto_email'])) { ?>
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <a href="mailto:<?= htmlspecialchars($web_config['contacto_email']) ?>"><?= htmlspecialchars($web_config['contacto_email']) ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="footer-bottom">
            <div class="footer-inner">
                <p>&copy; <?= date('Y') ?> F&N Constructores S.A.C. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <?php require_once dirname(__FILE__) . '/../WebTemplate/filerequired.php'; ?>

    <script id="base_url_script">
        const base_url = "<?= $base_url ?>";
        document.getElementById('base_url_script').remove();
    </script>

    <script src="<?= $assets_url ?>/general/jquery-3.6/jquery.min.js"></script>
    <script src="<?= $assets_url ?>/general/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($page_owl) && $page_owl == true) { ?>
        <script src="<?= $assets_url ?>/general/OwlCarousel2-2.3/dist/owl.carousel.min.js"></script>
        <script src="<?= $assets_url ?>/web/cfn/components/hero.js?v=<?= $media_version ?>"></script>
    <?php } ?>

    <?php if (isset($page_swalert) && $page_swalert == true) { ?>
        <script src="<?= $assets_url ?>/general/sweetalert2-11.4/dist/sweetalert2.all.min.js"></script>
    <?php } ?>

    <?php if (isset($page_isotope) && $page_isotope == true) { ?>
        <script src="<?= $assets_url ?>/general/isotope-3.0/isotope.pkgd.min.js"></script>
    <?php } ?>

    <script src="<?= $assets_url ?>/web/cfn/template/templateWeb.js?v=<?= $media_version ?>"></script>
    <script src="<?= $assets_url ?>/general/filerequired/filerequired.js?v=<?= $media_version ?>"></script>

    <?php if (isset($page_js)) { ?>
        <script src="<?= $assets_url ?>/web/cfn/<?= $page_js ?>.js?v=<?= $media_version ?>"></script>
    <?php } ?>

</body>
</html>