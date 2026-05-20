    <footer id="footer_page_web">
        <div class="">
            <i class="fa-solid fa-house-chimney me-1"></i>
            <span>Dirección: Av. Cajamarca Sur 754 - Nueva Cajamarca - Perú</span>
        </div>
        
        <div class="">
            <i class="fa-solid fa-phone me-1 ms-4"></i>
            <span>Teléfono: 990 252 507 / 954 982 077</span>
        </div>
        
        <div class="email_container">
            <i class="fa-solid fa-envelope me-1 ms-4"></i>
            <span>Email: fncostructores@gmail.com</span>
        </div>
        
        <div class="mt-2 icons">
            <a href="https://www.facebook.com/FNPERUINGENIERIA" target="_blank" class="fa-brands fa-facebook"></a>
            <a href="https://www.youtube.com/c/ElimelexFernandezNarvaisFnper%C3%BA" target="_blank" class="fa-brands fa-youtube"></a>
            <a href="https://instagram.com/fnperu_ingenieria" target="_blank" class="fa-brands fa-instagram"></a>
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