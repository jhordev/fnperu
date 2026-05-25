            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fa-solid fa-chalkboard-user bg-mean-fruit"></i>
                                </div>
                                <div>
                                    <span class="fw-500"><?= $page_title ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="app-main__content">
                        <div class="row">

                            <?php if ($cursos != []) { ?>
                                <div class="mb-0 row mx-0" style="max-width: 1200px;">
                                    <i class="border border-2 fa-solid text-success user-select-none" style="width: 40px; cursor:move;"></i>
                                    <span class="border border-2 text-center py-1 fw-700" style="width: calc(100% - 240px);">TALLERES PUBLICADOS</span>
                                    <span style="width: 200px;" class="border border-2 py-1 text-center fw-700">FECHA DE CREACIÓN</span>
                                </div>
                            <?php } ?>

                            <div id="cursos_list" style="max-width: 1200px;">
                                <?php foreach ($cursos as $key => $value) { ?>
                                    <div class="mb-0 cursos_each row mx-0" data-id="<?= $value['curso_id'] ?>">
                                        <i class="border border-2 fa-solid fa-arrows-up-down-left-right text-success user-select-none" style="width: 40px; cursor:move; padding-top: 12px"></i>
                                        <span class="border border-2 py-2" style="width: calc(100% - 240px);"><?= $value['curso_nombre'] ?></span>
                                        <span style="width: 200px;" class="border border-2 py-2 text-center"><?= $value['curso_creacion'] ?></span>
                                    </div>
                                <?php }

                                if ($cursos == []) { ?>
                                    <p class="mb-0 ms-3">- Aun no se ha ingresado algún taller o no están publicados.</p>
                                <?php } ?>
                            </div>

                            <div class="mb-5"></div>
                            <div class="mb-3"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
