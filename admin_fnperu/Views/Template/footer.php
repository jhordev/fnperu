
    <?php require_once dirname(__FILE__) . '/../Template/filerequired.php'; ?>

    <script id="base_url_script">
        const base_url = "<?= $base_url ?>";
        const assets_url = "<?= $assets_url ?>";
        document.getElementById('base_url_script').remove();
    </script>

    <script src="<?= $assets_url ?>/general/jquery-3.6/jquery.min.js"></script>
    <script src="<?= $assets_url ?>/general/bootstrap-5.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $assets_url ?>/general/metismenu-3.0/dist/metisMenu.min.js"></script>

    <?php if (isset($page_jq_ui) && $page_jq_ui == true) { ?>
        <script src="<?= $assets_url ?>/general/jquery-ui-1.13/jquery-ui.min.js"></script>
    <?php } ?>

    <?php if (isset($page_datatable) && $page_datatable == true) { ?>
        <script src="<?= $assets_url ?>/general/filerequired/Spanish.DataTable.js"></script>
        <script src="<?= $assets_url ?>/general/DataTables-1.11/DataTables-1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="<?= $assets_url ?>/general/DataTables-1.11/DataTables-1.11.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="<?= $assets_url ?>/general/DataTables-1.11/Select-1.3.4/js/dataTables.select.min.js"></script>
    <?php } ?>

    <?php if (isset($page_swalert) && $page_swalert == true) { ?>
        <script src="<?= $assets_url ?>/general/sweetalert2-11.4/dist/sweetalert2.all.min.js"></script>
    <?php } ?>

    <?php if (isset($page_owl) && $page_owl == true) { ?>
        <script src="<?= $assets_url ?>/general/OwlCarousel2-2.3/dist/owl.carousel.min.js"></script>
    <?php } ?>

    <?php if (isset($page_popper) && $page_popper == true) { ?>
        <script src="<?= $assets_url ?>/general/popper-2.11/popper.min.js"></script>
    <?php } ?>

    <?php if (isset($page_isotope) && $page_isotope == true) { ?>
        <script src="<?= $assets_url ?>/general/isotope-3.0/isotope.pkgd.min.js"></script>
    <?php } ?>

    <?php if (isset($page_sortable) && $page_sortable == true) { ?>
        <script src="<?= $assets_url ?>/general/Sortable-1.15/Sortable.min.js"></script>
    <?php } ?>

    <script src="<?= $assets_url ?>/admin/cfn/template/template.js?v=<?= $media_version ?>"></script>
    <script src="<?= $assets_url ?>/general/filerequired/filerequired.js?v=<?= $media_version ?>"></script>

    <?php if (isset($page_js)) { ?>
        <script src="<?= $assets_url ?>/admin/cfn/<?= $page_js ?>.js?v=<?= $media_version ?>"></script>
    <?php } ?>

</html>
