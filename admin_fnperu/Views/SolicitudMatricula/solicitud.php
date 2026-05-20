            
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

                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Estado:</span>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm" id="select_estado">
                                            <option value="2" <?= ($default_value == 2) ? 'selected' : '' ?>>Pendientes</option>
                                            <option value="1" <?= ($default_value == 1) ? 'selected' : '' ?>>Atendidos</option>
                                            <option value="0">Anulados</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="app-main__content">
                        <table id="lanzamientos_table" class="table table-hover table-striped table-bordered table_base table_action w-100">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>CÓDIGO</th>
                                    <th>SOLICITANTE</th>
                                    <th>DNI</th>
                                    <th>CURSO</th>
                                    <th>ESTADO</th>
                                    <th>FECHA</th>
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

    <div class="modal fade bayer_modal" id="modal_solicitud" tabindex="-1" aria-labelledby="modal_solicitudLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_solicitudLabel">SOLICITUD DE MATRÍCULA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row mx-0">

                    <div class="mb-2 col-12 col-lg-7 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Nombre del Curso:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_curso">
                    </div>

                    <div class="mb-2 col-12 col-lg-2 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Código:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_codigo">
                    </div>

                    <div class="mb-2 col-12 col-lg-3 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Fecha de Recepción:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_recepcion">
                    </div>

                    <div class="mb-2 col-12 col-lg-2 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Estado:</label>
                        <input type="text" class="form-control form-control-sm fw-700" disabled id="sol_estado">
                    </div>

                    <div class="mb-2 col-12 col-lg-2 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">DNI:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_dni">
                    </div>

                    <div class="mb-2 col-12 col-lg-3 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Nombres:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_nombre">
                    </div>

                    <div class="mb-2 col-12 col-lg-2 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Apellido Paterno:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_paterno">
                    </div>

                    <div class="mb-2 col-12 col-lg-2 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Apellido Materno:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_materno">
                    </div>

                    <div class="mb-2 col-12 col-lg-2 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Celular:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_celular">
                    </div>

                    <div class="mb-2 col-12 col-lg-4 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Correo Electrónico:</label>
                        <input type="email" class="form-control form-control-sm" disabled id="sol_email">
                    </div>

                    <div class="mb-2 col-12 col-lg-5 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Lugar de Residencia:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_lugar">
                    </div>

                    <div class="mb-2 col-12 col-lg-5 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Dirección de Residencia:</label>
                        <input type="text" class="form-control form-control-sm" disabled id="sol_direccion">
                    </div>

                    <div class="mb-2 col-12 col-lg-7 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1"></label>
                        <div class="mt-1 text-end">
                            <button class="btn btn-warning btn-sm btn_action_move me-2" id="move_to_pendi"><i class="fa-solid fa-file-circle-plus"></i> Mover a Pendientes</button>

                            <button class="btn btn-success btn-sm btn_action_move" id="move_to_atend"><i class="fa-solid fa-file-circle-check me-1"></i> Mover a Atendidos</button>

                            <button class="btn btn-danger btn-sm btn_action_move ms-2" id="move_to_null"><i class="fa-solid fa-file-circle-minus me-1"></i> Mover a Anulados</button>
                        </div>
                        
                    </div>
                    
                    <div class="mb-3 px-2">
                        <label for="" class="form-label fw-500 text-black mb-1">Mensaje:</label>
                        <textarea class="form-control form-control-sm resize-none" rows="3" disabled id="sol_mensaje"></textarea>
                    </div>

                    <div class="mb-5 px-2" style="max-height: 400px;">
                        <label class="form-label fw-500 text-black mb-1">Foto del Voucher: <a href="" target="_blank" id="ver_img_big">(Ver Más Grande)</a></label>
                        <img src="" id="sol_img_view" class="d-block mh-100 mx-auto mw-100 mt-1">

                    </div>

                    <div class="mb-3 mx-auto px-0 row justify-content-between" style="max-width: 800px;">
                        <input class="form-control form-control-sm d-none" type="file" style="width: calc(100% - 160px)" accept="image/png, image/jpg, image/jpeg" id="change_input">
                        <div class="" style="width: calc(100% - 160px)" id="change_relleno"></div>
                        <button class="btn btn-info btn-sm fw-500" style="width: 150px" id="change_btn_cambiar">Cambiar Foto</button>
                        <button class="btn btn-secondary btn-sm fw-500 d-none" style="width: 150px" id="change_btn_cancel">Cancelar</button>
                    </div>

                    <div id="table_container">
                        <table id="table_imagenes" class="table table-hover table-striped table-bordered table_base mx-auto" style="max-width: 800px">
                            <thead>
                                <tr style="background-color: #edf4ff;">
                                    <th>N°</th>
                                    <th>IMAGEN</th>
                                    <th>FECHA</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                </div>
                
            </div>
        </div>
    </div>