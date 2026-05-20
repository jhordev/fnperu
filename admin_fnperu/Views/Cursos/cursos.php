            
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
                                    <button class="btn btn-primary btn-sm" id="btn_opennewmodal" data-bs-toggle="modal" data-bs-target="#modal_newcurso">Nuevo Curso</button>
                                    <a href="<?= $base_url ?>/cursos/ordenar" class="btn btn-success btn-sm ms-2">Ordenar Cursos</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="app-main__content">
                        <table id="cursos_table" class="table table-hover table-striped table-bordered table_base table_action w-100">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>NOMBRE DEL CURSO</th>
                                    <th>BROCHURE</th>
                                    <th>ESTADO</th>
                                    <th>CREACIÓN</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_newcurso" tabindex="-1" aria-labelledby="modal_newcursoLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" id="from_newcurso" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modal_newcursoLabel">CREAR NUEVO CURSO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 ps-3 pe-4">
                            <label for="nameCurso" class="form-label fw-500 text-black">NOMBRE DEL CURSO:</label>
                            <input type="text" class="form-control" id="nameCurso" name="curso" autofocus minlength="5" maxlength="198" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Crear Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

