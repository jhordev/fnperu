            
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
                                    <button class="btn btn-danger btn-sm" id="btn_delete_curso"><i class="fa-solid fa-trash-can me-2"></i>Eliminar Curso</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="app-main__content">

                        <span class="d-none" id="idCurso"><?= $curso['curso_id'] ?></span>

                        <div class="row">
                            <div class="fw-500" style="width: 180px; margin-top: 4px">NOMBRE DEL CURSO: </div>
                            
                            <div class="w-auto me-3" id="view_edit_cancel" style="min-width: 163px; margin-top: 4px; margin-bottom: 4px"><?= $curso['curso_nombre'] ?></div>
                            
                            <div class="d-none" id="input_edit_nombre">
                                <div id="charater_input_name">(<?= mb_strlen($curso['curso_nombre']) ?>/150)</div>
                                <input type="text" class="form-control form-control-sm" id="curso_nombre" value="<?= $curso['curso_nombre'] ?>" disabled minlength="5" maxlength="150" required>
                            </div>

                            <div class="text-danger fw-500 w-auto btn_action user-select-none" id="edit_nombre" type="button" style="margin-top: 4px"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</div>

                            <div class="text-primary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_save" type="button" style="margin-top: 4px"><i class="fa-solid fa-floppy-disk me-1"></i> Guardar</div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_cancel" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">ESTADO: </div>

                            <?php 
                            $curso['curso_publico'] = intval($curso['curso_publico']);

                            if ($curso['curso_publico'] == 1) { ?>

                                <div style="width: 180px; margin-top: 4px">
                                    <span class="position-relative pe-2">
                                        Publicado

                                        <span class="position-absolute top-0 start-100 translate-bottom p-2 bg-success border border-light rounded-circle" style="margin-top: 2px">
                                            <span class="visually-hidden"></span>
                                        </span>
                                    </span>
                                </div>

                                <div class="btn_action user-select-none" style="width: 120px; margin-top: 4px">
                                    <div class="color-warning fw-500" id="btn_ocultar" type='button'><i class="fa-brands fa-blogger me-1"></i> Ocultar</div>
                                </div>
                                
                            <?php } else if($curso['curso_publico'] == 0) { ?>

                                <div style="width: 180px; margin-top: 4px">
                                    <span class="position-relative pe-2">
                                        No Publicado

                                        <span class="position-absolute top-0 start-100 translate-bottom p-2 bg-info border border-light rounded-circle" style="margin-top: 2px">
                                            <span class="visually-hidden"></span>
                                        </span>
                                    </span>
                                </div>

                                <div class="btn_action user-select-none" style="width: 120px; margin-top: 4px">
                                    <div class="text-primary fw-500" id="btn_publicar" type='button'><i class="fa-brands fa-blogger me-1"></i> PUBLICAR</div>
                                </div>

                            <?php } ?>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">BROCHURE: </div>
                            
                            <?php if ($curso['curso_brochure'] == '') { ?>

                                <div class="btn_action" style="width: 180px ;margin-top: 4px">No Tiene</div>
                                    
                            <?php } else { ?>
                                <div style="width: 180px ;margin-top: 4px" id="ver_brochure_btn">
                                    <a target="_blank" href="<?= $assets_url ?>/admin/docs/brochure/<?= $curso['curso_brochure'] ?>" class="fw-bold text-decoration-none">Ver Brochure <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                </div>
                            <?php } ?>

                            <div class="d-none" id="input_edit_brochure" style="width: 400px;">
                                <div class="input-group">
                                    <input accept="application/pdf" type="file" class="form-control form-control-sm">
                                </div>
                                <small class="text-muted mt-1 d-block"><i class="fa-regular fa-circle-info me-1"></i>Solo PDF &middot; Máx. 5 MB</small>
                            </div>

                            <div class="btn_action user-select-none w-auto" style="margin-top: 4px">
                                <div class="color-info-dark fw-500" type='button' id="btn_add_brochure"><i class="fa-regular fa-file-pdf me-1"></i> <?= ($curso['curso_brochure'] == '') ? 'Agregar' : 'Cambiar' ?></div>
                            </div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_cancel_brochure" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">VIDEO YOUTUBE: </div>
                            
                            <div class="w-auto me-3" id="view_video_edit" style="min-width: 163px; margin-top: 4px; margin-bottom: 4px">

                                <?php if ($curso['curso_video'] == '') { ?>
                                    [ Sin Video ]
                                <?php } 
                                else 
                                { ?>
                                    <a target="_blank" href="https://www.youtube.com/watch?v=<?= $curso['curso_video'] ?>" class="fw-bold text-decoration-none">Ver Video <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                <?php } ?>

                            </div>
                            
                            <div class="d-none" id="input_video_nombre">
                                <div id="charater_input_video">(0/150)</div>
                                <input type="text" class="form-control form-control-sm" id="curso_video" value="" disabled minlength="5" maxlength="150" required>
                            </div>

                            <div class="text-success fw-500 w-auto btn_action user-select-none" id="edit_video" type="button" style="margin-top: 4px"><i class="fa-solid fa-pen-to-square me-1"></i> Cambiar</div>

                            <div class="text-primary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_video_save" type="button" style="margin-top: 4px"><i class="fa-solid fa-floppy-disk me-1"></i> Guardar</div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_video_cancel" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">SUPERPONER VIDEO: </div>

                            <?php 
                            $curso['curso_video_habil'] = intval($curso['curso_video_habil']);

                            if ($curso['curso_video_habil'] == 1) { ?>

                                <div style="width: 180px; margin-top: 4px" class="fw-500">
                                    [ SI ]
                                </div>

                                <div class="btn_action user-select-none" style="width: 120px; margin-top: 4px">
                                    <div class="text-success fw-500" id="btn_ocultar_video" type='button'><i class="fa-brands fa-blogger me-1"></i> Cambiar</div>
                                </div>
                                
                            <?php } else if($curso['curso_video_habil'] == 0) { ?>

                                <div style="width: 180px; margin-top: 4px" class="fw-500">
                                    [ NO ]
                                </div>

                                <div class="btn_action user-select-none" style="width: 120px; margin-top: 4px">
                                    <div class="text-primary fw-500" id="btn_publicar_video" type='button'><i class="fa-brands fa-blogger me-1"></i> Cambiar</div>
                                </div>

                            <?php } ?>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">FECHA DE CREACIÓN: </div>

                            <?php $curso['curso_creacion'] = DateTime::createFromFormat('Y-m-d H:i:s', $curso['curso_creacion']); 
                            $curso['curso_creacion'] = $curso['curso_creacion'] -> format('h:ia d/m/Y'); ?>
                            <div class="w-auto" style="margin-top: 4px"><?= $curso['curso_creacion'] ?></div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px;margin-top: 4px">IMAGEN PRINCIPAL: </div>

                            <?php if ($curso['curso_img_main'] == '') { ?>

                                <div class="apartado_view_img" style="width: 180px ;margin-top: 4px">No Tiene</div>

                            <?php } else { ?>

                                <img class="apartado_view_img" src="<?= $assets_url ?>/admin/images/cursos/<?= $curso['curso_img_main'] ?>" alt="" style="width: 300px">

                            <?php } ?>

                            <div class="d-none" id="input_edit_img" style="width: 400px;">
                                <div class="input-group mb-1">
                                    <input accept="image/png, image/jpg, image/jpeg" disabled type="file" class="form-control form-control-sm" id="input_img">
                                </div>
                                <small class="text-muted mb-2 d-block"><i class="fa-regular fa-circle-info me-1"></i>JPG o PNG &middot; Máx. 5 MB</small>
                            </div>

                            <div class="btn_action user-select-none text-success fw-500 w-auto" type="button" id="btn_add_img" style="margin-top: 4px">
                                <i class="fa-regular fa-image me-1"></i> <?= ($curso['curso_img_main'] == '') ? 'Agregar' : 'Cambiar' ?>
                            </div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_cancel_img" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <span class="w-auto" style="margin-top: 4px">(525px, 412px)</span>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="margin-top: 4px">
                                INTRODUCCIÓN 1: 
                                <span class="ms-3 btn_action user-select-none text-success" id="btn_edit_intro_uno" type="button"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</span>

                                <span class="ms-3 user-select-none d-none" id="btn_save_intro_uno" type="button">
                                    <span class="fw-400 me-2" id="charater_input_intro_uno">(<?= mb_strlen($curso['curso_introduccion']) ?>/490)</span>
                                    <i class="fa-solid fa-floppy-disk me-1 text-primary"></i><span class=" text-primary"> Guardar</span>
                                </span>

                                <span class="ms-3 user-select-none text-secondary d-none" id="btn_cancel_intro_uno" type="button"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</span>
                            </div>

                            <div class="">
                                <div class="mb-3 mt-2 border py-2 px-3 border-2 rounded" style="min-height: 70px;" id="text_view_intro_uno"><?= ( trim($curso['curso_introduccion']) == '' ) ? '--' : $curso['curso_introduccion'] ?></div>
                            </div>

                            <div>
                                <textarea disabled minlength="10" class="form-control mb-3 mt-2 d-none" maxlength="490" placeholder="Escribe la Introducción 1" id="text_area_intro_uno" style="height: 100px; resize:none"><?= $curso['curso_introduccion'] ?></textarea>
                            </div>
                            
                            <div class="mb-3"></div>

                            <div class="fw-500">
                                INTRODUCCIÓN 2: 
                                <span class="ms-3 btn_action user-select-none text-success" id="btn_edit_intro_dos" type="button">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Editar
                                </span>

                                <span class="ms-3 user-select-none d-none" id="btn_save_intro_dos" type="button">
                                    <span class="fw-400 me-2" id="charater_input_intro_dos">(<?= mb_strlen($curso['curso_introduccion_dos']) ?>/990)</span>
                                    <i class="fa-solid fa-floppy-disk text-primary me-1"></i> <span class="text-primary">Guardar</span>
                                </span>

                                <span class="ms-3 user-select-none text-secondary d-none" id="btn_cancel_intro_dos" type="button"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</span>
                            </div>

                            <div class="">
                                <div class="mb-3 mt-2 border px-3 py-2 border-2 rounded" style="min-height: 70px;"  id="text_view_intro_dos"><?= ( trim($curso['curso_introduccion_dos']) == '' ) ? '--' : $curso['curso_introduccion_dos'] ?></div>
                            </div>

                            <div>
                                <textarea disabled minlength="10" class="form-control mb-3 mt-2 d-none" maxlength="990" placeholder="Escribe la Introducción 1" id="text_area_intro_dos" style="height: 150px; resize:none"><?= $curso['curso_introduccion_dos'] ?></textarea>
                            </div>
                            
                            <div class="mb-3"></div>

                            <p class="fw-500">
                                BENEFICIOS: <span class="color-info btn_action" type="button" data-bs-toggle="modal" data-bs-target="#modal_newbeneficio"><i class="fa-solid fa-circle-plus ms-3"></i> Nuevo</span>
                            </p>

                            <div id="beneficios_list" style="max-width: 1000px;">

                                <?php foreach ($beneficios as $key => $value) { ?>

                                    <div class="mb-0 bienes_each row border border-2 py-2 mx-0" data-id="<?= $value['beneficio_id'] ?>">
                                        <i class="fa-solid fa-arrows-up-down-left-right mt-1 text-success user-select-none" style="width: 30px; cursor:move"></i> 

                                        <span style="width: calc(100% - 70px); text-align:justify"><?= $value['beneficio_nombre'] ?></span>

                                        <div class="btn_delete_bien bg-danger text-white" data-id="<?= $value['beneficio_id'] ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>
                                    
                                <?php }
                                
                                if ($beneficios == []) { ?>

                                    <p class="mb-0 ms-3">- Aun no se ha ingresado algún beneficio.</p>

                                <?php } ?>

                            </div>
                            
                            <div class="mb-4"></div>

                            <p class="fw-500">
                                MATERIALES ENTREGADOS: <span class="color-info btn_action" type="button" data-bs-toggle="modal" data-bs-target="#modal_newmaterial"><i class="fa-solid fa-circle-plus ms-3"></i> Nuevo</span>
                            </p>

                            <div id="materiales_list" style="max-width: 1000px;">

                                <?php foreach ($materiales as $key => $value) { ?>

                                    <div class="mb-0 material_each row border border-2 py-2 mx-0" data-id="<?= $value['material_id'] ?>">
                                        <i class="fa-solid fa-arrows-up-down-left-right mt-1 text-success user-select-none" style="width: 30px; cursor:move"></i> 

                                        <span style="width: calc(100% - 70px); text-align:justify"><?= $value['material_nombre'] ?></span>

                                        <div class="btn_delete_material bg-danger text-white" data-id="<?= $value['material_id'] ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>
                                    
                                <?php } 
                                
                                if ($materiales == []) { ?>

                                    <p class="mb-0 ms-3">- Aun no se ha ingresado algún material.</p>

                                <?php } ?>

                            </div>
                            
                            <div class="mb-4"></div>

                            <p class="fw-500">
                                CONTENIDO DEL CURSO: <span class="color-info btn_action" type="button" data-bs-toggle="modal" data-bs-target="#modal_newmodulo"><i class="fa-solid fa-circle-plus ms-3"></i> Nuevo Módulo</span>
                            </p>

                            <div class="accordion" id="accordion_modulos" style="max-width: 1200px;">

                                <?php foreach ($modulos as $key => $value) { ?>
                                    
                                    <div class="accordion-item accordion-item_modulos d-flex" data-id="<?= $value['mod_id'] ?>">

                                        <div style="width: 40px; border-right: 1px solid rgb(161, 161, 161);">
                                            <i class="fa-solid for_move fa-arrows-up-down-left-right mt-3 text-success user-select-none" style="width: 30px; cursor:move; margin-left: 12px"></i> 
                                        </div>

                                        <div style="width: calc(100% - 40px); ">

                                            <h2 class="accordion-header user-select-none" id="heading_mod_<?= $key ?>">

                                                <button 
                                                class="accordion-button for_mod collapsed border-bottom text-dark" 
                                                type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#collapse_mod_<?= $key ?>" 
                                                aria-expanded="false" 
                                                aria-controls="collapse_mod_<?= $key ?>"
                                                style="background-color: #f4f4f4; box-shadow:none; padding: 12px 20px"
                                                >
                                                    <?= $value['mod_nombre'] ?> 

                                                    <span class="text-success btn_action fs-14 fw-500 btn_new_indicador ms-5" type="button"
                                                    data-id="<?= $value['mod_id'] ?>"
                                                    >
                                                        <i class="fa-solid fa-circle-plus fs-13"></i> 
                                                        Nuevo Indicador
                                                    </span>

                                                    <span class="text-danger btn_action fs-14 fw-500 btn_delete_modulo ms-3" type="button"
                                                    data-id="<?= $value['mod_id'] ?>"
                                                    >
                                                        <i class="fa-solid fa-trash-can"></i>
                                                        Eliminar Módulo
                                                    </span>

                                                    <span class="cantidad_indicadores fs-14"><?= count($value['indicadores']) ?> indicadores</span>
                                                </button>
                                            </h2>

                                            <div id="collapse_mod_<?= $key ?>" class="accordion-collapse collapse" aria-labelledby="heading_mod_<?= $key ?>" data-bs-parent="#accordion_modulos">
                                                <div class="accordion-body accordion_body_indicadores">
                                                    
                                                <?php foreach ($value['indicadores'] as $llave => $valor) { ?>

                                                    <div class="mb-0 indicador_each row border border-2 py-2 mx-0" data-id="<?= $valor['ind_id'] ?>">
                                                        <i class="fa-solid fa-arrows-up-down-left-right mt-1 text-success user-select-none" style="width: 30px; cursor:move"></i> 

                                                        <span style="width: calc(100% - 70px); text-align:justify"><?= $valor['ind_nombre'] ?></span>

                                                        <div class="btn_delete_indicador bg-danger text-white" data-id="<?= $valor['ind_id'] ?>">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <?php } 
                                
                                if ($modulos == []) { ?>

                                    <p class="mb-0 ms-3">- Aun no se ha ingresado algún módulo.</p>

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