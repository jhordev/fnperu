
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">

                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fa-solid fa-signature bg-mean-fruit"></i>
                                </div>
                                <div>
                                    <span class="fw-500"><?= $page_title ?></span>
                                </div>
                            </div>

                            <div class="page-title-actions">
                                <div class="d-inline-block">

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="app-main__content">

                        <div class="row">

                            <?php if ($urbanization != []) { ?>

                                <div class="mb-0 row mx-0" style="max-width: 1200px;">
                                    <i class="border border-2 fa-solid text-success user-select-none" style="width: 40px; cursor:move;"></i>

                                    <span class="border border-2 text-center py-1 fw-700" style="width: calc(100% - 240px);">CURSOS PUBLICADOS</span>

                                    <span style="width: 200px;" class="border border-2 py-1 text-center fw-700">FECHA DE CREACIÓN</span>
                                </div>

                            <?php } ?>

                            <div id="cursos_list" style="max-width: 1200px;">

                                <?php foreach ($urbanization as $key => $value) { ?>

                                    <div class="mb-0 cursos_each row mx-0" data-id="<?= $value['id'] ?>">
                                        <i class="border border-2 fa-solid fa-arrows-up-down-left-right text-success user-select-none" style="width: 40px; cursor:move; padding-top: 12px"></i>

                                        <span class="border border-2 py-2 " style="width: calc(100% - 240px);"><?= $value['name'] ?></span>

                                        <span style="width: 200px;" class="border border-2 py-2 text-center"><?= $value['created'] ?></span>
                                    </div>

                                <?php }

                                if ($urbanization == []) { ?>

                                    <p class="mb-0 ms-3">- Aun no se ha ingresado algún curso o no están publicados.</p>

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

    <div class="modal fade bayer_modal" id="modal_newmaterial" tabindex="-1" aria-labelledby="modal_newmaterialLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_newmaterialLabel">AÑADIR MATERIAL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 ps-3 pe-4">
                        <label for="nameMaterial" class="form-label fw-500 text-black">NOMBRE DEL MATERIAL: <span class="fw-400" id="charater_input_material">(0/190)</span></label>
                        <textarea class="form-control" placeholder="Describe el nuevo material" id="nameMaterial" required autocomplete="off" minlength="5" maxlength="190" style="height: 90px; resize: none">

                        </textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_matetial">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_newbeneficio" tabindex="-1" aria-labelledby="modal_newbeneficioLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_newbeneficioLabel">AÑADIR BENEFICIO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 ps-3 pe-4">
                        <label for="nameBeneficio" class="form-label fw-500 text-black">NOMBRE DEL BENEFICIO: <span class="fw-400" id="charater_input_beneficio">(0/190)</span></label>
                        <textarea class="form-control" placeholder="Describe el nuevo beneficio" id="nameBeneficio" required autocomplete="off" minlength="5" maxlength="190" style="height: 90px; resize: none">

                        </textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_beneficio">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_newmodulo" tabindex="-1" aria-labelledby="modal_newmoduloLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_newmoduloLabel">AÑADIR MÓDULO DE CURSO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 ps-3 pe-4">
                        <label for="nameModulo" class="form-label fw-500 text-black">NOMBRE DEL MÓDULO:</label>
                        <textarea class="form-control" placeholder="Describe el nuevo módulo" id="nameModulo" required autocomplete="off" minlength="5" maxlength="198" style="height: 90px; resize: none">

                        </textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_modulo">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_newindicador" tabindex="-1" aria-labelledby="modal_newindicadorLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_newindicadorLabel">AÑADIR INDICADOR AL MÓDULO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 ps-3 pe-4">
                        <label for="nameIndicador" class="form-label fw-500 text-black">NOMBRE DEL INDICADOR:</label>
                        <textarea class="form-control" placeholder="Describe el nuevo indicador" id="nameIndicador" required autocomplete="off" minlength="5" maxlength="198" style="height: 90px; resize: none">

                        </textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_indicador" data-id="">Añadir</button>
                </div>
            </div>
        </div>
    </div>
