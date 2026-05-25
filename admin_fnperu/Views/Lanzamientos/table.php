            
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
                                    <button class="btn btn-primary btn-sm" id="btn_opennewmodal" data-bs-toggle="modal" data-bs-target="#modal_newlanzamiento">Nuevo Lanzamiento</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="app-main__content">
                        <table id="lanzamientos_table" class="table table-hover table-striped table-bordered table_base table_action w-100">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>TIPO</th>
                                    <th>NOMBRE</th>
                                    <th>COSTO</th>
                                    <th>INICIO - FIN</th>
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

    <div class="modal fade bayer_modal" id="modal_newlanzamiento" tabindex="-1" aria-labelledby="modal_newlanzamientoLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" id="from_newlanzamiento" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modal_newlanzamientoLabel">CREAR NUEVO LANZAMIENTO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3 ps-3 pe-4">
                            <label for="nameCurso" class="form-label fw-500 text-black">NOMBRE DEL CURSO:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="nameCurso" disabled>
                                <button class="btn btn-primary" type="button" id="open_modal_cursos">Elegir</button>
                            </div>
                        </div>

                        <input type="text" id="id_curso" name="idcurso" class="d-none">

                        <div class="row mx-0 ps-3 pe-4">
                            <div class="mb-1 ps-0 col-4">
                                <label class="form-label fw-500 text-black">FECHA DE INICIO:</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="fecha_inicio" required>
                                </div>
                            </div>

                            <div class="mb-1 col-4">
                                <label class="form-label fw-500 text-black">FECHA DE FINALIZACIÓN:</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="fecha_fin" required>
                                </div>
                            </div>
                            
                            <div class="mb-1 pe-0 col-4">
                                <label class="form-label fw-500 text-black">COSTO (S/):</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control text-center" step="0.01" name="costo" min="0" max="5000" required>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Crear Lanzamiento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_cursos" tabindex="-1" aria-labelledby="modal_cursosLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_cursosLabel">ELEGIR CURSO / TALLER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="cursos_table" class="table table-hover table-striped table-bordered table_base table_action w-100">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>TIPO</th>
                                <th>NOMBRE</th>
                                <th>ESTADO</th>
                                <th>CREACIÓN</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_lanz_edit" tabindex="-1" aria-labelledby="modal_lanz_editLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_lanz_editLabel">DETALLE DEL LANZAMIENTO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="" id="from_newlanzamiento_edit" autocomplete="off">

                        <div class="mb-3 ps-3 pe-4">
                            <label for="nameCurso" class="form-label mb-1 fw-500 text-black">NOMBRE DEL CURSO:</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control form-control-sm" id="nameCurso_edit" disabled>
                            </div>
                        </div>

                        <input type="text" id="id_curso_edit" name="idcurso_edit" class="d-none" disabled>
                        <input type="text" id="idlanzamiento_edit" name="idlanzamiento_edit" class="d-none">

                        <div class="row mx-0 ps-3 pe-4 ">
                            <div class="mb-1 ps-0 col-4">
                                <label class="form-label mb-1 fw-500 text-black">FECHA DE INICIO:</label>
                                <div class="input-group mb-2">
                                    <input type="date" class="form-control form-control-sm" name="fecha_inicio_edit" id="fecha_inicio_edit" required disabled>
                                </div>
                            </div>

                            <div class="mb-1 col-4">
                                <label class="form-label mb-1 fw-500 text-black">FECHA DE FINALIZACIÓN:</label>
                                <div class="input-group mb-2">
                                    <input type="date" class="form-control form-control-sm" name="fecha_fin_edit" id="fecha_fin_edit" required disabled>
                                </div>
                            </div>
                            
                            <div class="mb-1 pe-0 col-4">
                                <label class="form-label mb-1 fw-500 text-black">COSTO (S/):</label>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control form-control-sm text-center" step="0.01" id="costo_edit" name="costo_edit" min="0" max="5000" required disabled>
                                </div>
                            </div>
                            
                            <div class="mb-1 ps-0 col-3">
                                <label class="form-label mb-1 fw-500 text-black">ESTADO:</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control fw-700 form-control-sm text-center" id="estado_edit" disabled>
                                </div>
                            </div>
                            
                            <div class="mb-1 col-4">
                                <label class="form-label mb-1 fw-500 text-black">FECHA DE CREACIÓN:</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control form-control-sm text-center" id="creacion_edit" disabled>
                                </div>
                            </div>
                            
                            <div class="mb-1 pe-0 col-5">
                                <label class="form-label mb-1 fw-500 text-black"></label>
                                <div class="input-group mb-2 justify-content-end">
                                    <button class="btn btn-primary btn-sm mt-1 rounded" id="btn_edit_lanza" type="button"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                                    <button class="btn btn-warning btn-sm mt-1 mx-2 rounded d-none" id="btn_culminar_lanza" type="button"><i class="fa-solid fa-ban"></i> Culminar</button>
                                    <button class="btn btn-success btn-sm mt-1 mx-2 rounded d-none" id="btn_activar_lanza" type="button"><i class="fa-solid fa-circle-check"></i> Activar</button>
                                    <button class="btn btn-danger btn-sm mt-1 rounded" id="btn_delete_lanza" type="button"><i class="fa-solid fa-trash-can"></i> Eliminar</button>

                                    <button class="btn btn-success btn-sm mt-1 rounded d-none" id="btn_save_lanza" type="button"><i class="fa-solid fa-floppy-disk"></i>&nbsp; Actualizar</button>

                                    <button class="btn btn-secondary btn-sm mt-1 rounded ms-2 d-none" id="btn_cancel_lanza" type="button"><i class="fa-solid fa-xmark"></i>&nbsp; Cancelar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>