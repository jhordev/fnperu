
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
                                    <button class="btn btn-danger btn-sm" id="btn_delete_curso"><i class="fa-solid fa-trash-can me-2"></i>Eliminar Habilitación</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="app-main__content">

                        <span class="d-none" id="idCurso"><?= $urbanization['id'] ?></span>

                        <div class="row">
                            <div class="fw-500" style="margin-top: 4px">NOMBRE DE LA HABILITACIÓN URBANA: </div>

                            <div class="w-auto me-3" id="view_edit_cancel" style="min-width: 163px; margin-top: 13px; margin-left: 180px; margin-bottom: 4px"><?= $urbanization['name'] ?></div>

                            <div class="d-none" id="input_edit_nombre" style=" margin-left: 180px;">
                                <div id="charater_input_name">(<?= mb_strlen($urbanization['name']) ?>/150)</div>

                                <input type="text" class="form-control form-control-sm mt-2" id="curso_nombre" value="<?= $urbanization['name'] ?>" disabled minlength="5" maxlength="150" required>
                                <label for="curso_nombre" class="d-none"></label>
                            </div>

                            <div class="text-danger fw-500 w-auto btn_action user-select-none" id="edit_nombre" type="button" style="margin-top: 13px"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</div>

                            <div class="text-primary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_save" type="button" style="margin-top: 13px"><i class="fa-solid fa-floppy-disk me-1"></i> Guardar</div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_cancel" type="button" style="margin-top: 13px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">ESTADO: </div>

                            <?php
                            $urbanization['public'] = intval($urbanization['public']);

                            if ($urbanization['public'] == 1) { ?>

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

                            <?php } else if($urbanization['public'] == 0) { ?>

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

                            <div class="fw-500" style="width: 180px; margin-top: 4px">PLANO: </div>

                            <?php if ($urbanization['plan'] == '') { ?>

                                <div class="btn_action" style="width: 180px ;margin-top: 4px">No Tiene</div>

                            <?php } else { ?>
                                <div style="width: 180px ;margin-top: 4px" id="ver_brochure_btn">
                                    <a target="_blank" href="<?= $assets_url ?>/admin/docs/house-plans/<?= $urbanization['plan'] ?>" class="fw-bold text-decoration-none">Ver Plano <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                </div>
                            <?php } ?>

                            <div class="d-none" id="input_edit_brochure" style="width: 400px;">
                                <div class="input-group">
                                    <input accept="application/pdf"  type="file" class="form-control  form-control-sm">
                                </div>
                            </div>

                            <div class="btn_action user-select-none w-auto" style="margin-top: 4px">
                                <div class="color-info-dark fw-500" type='button' id="btn_add_brochure"><i class="fa-regular fa-file-pdf me-1"></i> <?= ($urbanization['plan'] == '') ? 'Agregar' : 'Cambiar' ?></div>
                            </div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_cancel_brochure" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">VIDEO YOUTUBE: </div>

                            <div class="w-auto me-3" id="view_video_edit" style="min-width: 163px; margin-top: 4px; margin-bottom: 4px">

                                <?php if ($urbanization['youtube_video'] == '') { ?>
                                    [ Sin Video ]
                                <?php }
                                else
                                { ?>
                                    <a target="_blank" href="https://www.youtube.com/watch?v=<?= $urbanization['youtube_video'] ?>" class="fw-bold text-decoration-none">Ver Video <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                <?php } ?>

                            </div>

                            <div class="d-none" id="input_video_nombre">
                                <div id="charater_input_video">(0/150)</div>
                                <input type="text" class="form-control form-control-sm" id="youtube_video" value="" disabled minlength="5" maxlength="150" required>
                            </div>

                            <div class="text-success fw-500 w-auto btn_action user-select-none" id="edit_video" type="button" style="margin-top: 4px"><i class="fa-solid fa-pen-to-square me-1"></i> Cambiar</div>

                            <div class="text-primary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_video_save" type="button" style="margin-top: 4px"><i class="fa-solid fa-floppy-disk me-1"></i> Guardar</div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_video_cancel" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">SUPERPONER VIDEO: </div>

                            <?php
                            $urbanization['video_overlay'] = intval($urbanization['video_overlay']);

                            if ($urbanization['video_overlay'] == 1) { ?>

                                <div style="width: 180px; margin-top: 4px" class="fw-500">
                                    [ SI ]
                                </div>

                                <div class="btn_action user-select-none" style="width: 120px; margin-top: 4px">
                                    <div class="text-success fw-500" id="btn_ocultar_video" type='button'><i class="fa-brands fa-blogger me-1"></i> Cambiar</div>
                                </div>

                            <?php } else if($urbanization['video_overlay'] == 0) { ?>

                                <div style="width: 180px; margin-top: 4px" class="fw-500">
                                    [ NO ]
                                </div>

                                <div class="btn_action user-select-none" style="width: 120px; margin-top: 4px">
                                    <div class="text-primary fw-500" id="btn_publicar_video" type='button'><i class="fa-brands fa-blogger me-1"></i> Cambiar</div>
                                </div>

                            <?php } ?>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">COSTOS DESDE: </div>

                            <div class="w-auto me-3" id="view_price_edit" style="min-width: 163px; margin-top: 4px; margin-bottom: 4px">
                                S/ <?= $urbanization['price'] == null ? '-.--' : $urbanization['price'] ?>
                            </div>

                            <div class="d-none" id="input_price_parent" style="max-width: 200px">
                                <label for="price" class="d-none"></label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="price" value="" disabled min="0" required>
                            </div>

                            <div class="text-success fw-500 w-auto btn_action user-select-none" id="edit_price" type="button" style="margin-top: 4px"><i class="fa-solid fa-pen-to-square me-1"></i> Cambiar</div>

                            <div class="text-primary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_price_save" type="button" style="margin-top: 4px"><i class="fa-solid fa-floppy-disk me-1"></i> Guardar</div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_price_cancel" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">COORDENADAS URBANIZACIÓN: </div>

                            <div class="w-auto me-3" id="view_coordinates_edit" style="min-width: 163px; margin-top: 4px; margin-bottom: 4px">
                                <?php if ($urbanization['coordinates'] == null) { ?>
                                    <span style="font-style: italic">Sin Coordenadas</span>
                                <?php } else { ?>
                                    <a href="https://www.google.com/maps?q=<?= $urbanization['coordinates'] ?>" target="_blank" class="me-2 text-primary fw-500 text-decoration-none">Ver Mapa <i class="fa-solid fa-arrow-up-right-from-square"></i></a>

                                    <span class="fs-15"><?= $urbanization['coordinates'] ?></span>
                                <?php } ?>
                            </div>

                            <div class="d-none" id="input_coordinates_parent" style="max-width: 350px">
                                <label for="coordinates" class="d-none"></label>
                                <input type="text" class="form-control form-control-sm" id="coordinates" value="" disabled required>
                            </div>

                            <div class="text-success fw-500 w-auto btn_action user-select-none" id="edit_coordinates" type="button" style="margin-top: 4px"><i class="fa-solid fa-pen-to-square me-1"></i> Cambiar</div>

                            <div class="text-primary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_coordinates_save" type="button" style="margin-top: 4px"><i class="fa-solid fa-floppy-disk me-1"></i> Guardar</div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_coordinates_cancel" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">COORDENADAS OFICINA: </div>

                            <div class="w-auto me-3" id="view_office_edit" style="min-width: 163px; margin-top: 4px; margin-bottom: 4px">
                                <?php if ($urbanization['office'] == null) { ?>
                                    <span style="font-style: italic">Sin Coordenadas</span>
                                <?php } else { ?>
                                    <a href="https://www.google.com/maps?q=<?= $urbanization['office'] ?>" target="_blank" class="me-2 text-primary fw-500 text-decoration-none">Ver Mapa <i class="fa-solid fa-arrow-up-right-from-square"></i></a>

                                    <span class="fs-15"><?= $urbanization['office'] ?></span>
                                <?php } ?>
                            </div>

                            <div class="d-none" id="input_office_parent" style="max-width: 350px">
                                <label for="office" class="d-none"></label>
                                <input type="text" class="form-control form-control-sm" id="office" value="" disabled required>
                            </div>

                            <div class="text-success fw-500 w-auto btn_action user-select-none" id="edit_office" type="button" style="margin-top: 4px"><i class="fa-solid fa-pen-to-square me-1"></i> Cambiar</div>

                            <div class="text-primary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_office_save" type="button" style="margin-top: 4px"><i class="fa-solid fa-floppy-disk me-1"></i> Guardar</div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_office_cancel" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px; margin-top: 4px">FECHA DE CREACIÓN: </div>

                            <?php $urbanization['created'] = DateTime::createFromFormat('Y-m-d H:i:s', $urbanization['created']);
                            $urbanization['created'] = $urbanization['created'] -> format('h:ia d/m/Y'); ?>
                            <div class="w-auto" style="margin-top: 4px"><?= $urbanization['created'] ?></div>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="width: 180px;margin-top: 4px">IMAGEN PRINCIPAL: </div>

                            <?php if ($urbanization['image'] == '') { ?>

                                <div class="apartado_view_img" style="width: 180px ;margin-top: 4px">No Tiene</div>

                            <?php } else { ?>

                                <img class="apartado_view_img" src="<?= $assets_url ?>/admin/images/urbanization/<?= $urbanization['image'] ?>" alt="" style="width: 300px">

                            <?php } ?>

                            <div class="d-none" id="input_edit_img" style="width: 400px;">
                                <div class="input-group mb-3">
                                    <input accept="image/png, image/jpg, image/jpeg" disabled type="file" class="form-control  form-control-sm" id="input_img">
                                </div>
                            </div>

                            <div class="btn_action user-select-none text-success fw-500 w-auto" type="button" id="btn_add_img" style="margin-top: 4px">
                                <i class="fa-regular fa-image me-1"></i> <?= ($urbanization['image'] == '') ? 'Agregar' : 'Cambiar' ?>
                            </div>

                            <div class="text-secondary fw-500 w-auto d-none btn_cancel user-select-none px-0 mx-2" id="btn_edit_cancel_img" type="button" style="margin-top: 4px"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</div>

                            <span class="w-auto" style="margin-top: 4px">(525px, 412px)</span>

                            <div class="mb-3"></div>

                            <div class="fw-500" style="margin-top: 4px">
                                INTRODUCCIÓN 1:
                                <span class="ms-3 btn_action user-select-none text-success" id="btn_edit_intro_uno" type="button"><i class="fa-solid fa-pen-to-square me-1"></i> Editar</span>

                                <span class="ms-3 user-select-none d-none" id="btn_save_intro_uno" type="button">
                                    <span class="fw-400 me-2" id="charater_input_intro_uno">(<?= mb_strlen($urbanization['introduction_one']) ?>/490)</span>
                                    <i class="fa-solid fa-floppy-disk me-1 text-primary"></i><span class=" text-primary"> Guardar</span>
                                </span>

                                <span class="ms-3 user-select-none text-secondary d-none" id="btn_cancel_intro_uno" type="button"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</span>
                            </div>

                            <div class="">
                                <div class="mb-3 mt-2 border py-2 px-3 border-2 rounded" style="min-height: 70px;" id="text_view_intro_uno"><?= ( trim($urbanization['introduction_one']) == '' ) ? '--' : $urbanization['introduction_one'] ?></div>
                            </div>

                            <div>
                                <textarea disabled minlength="10" class="form-control mb-3 mt-2 d-none" maxlength="490" placeholder="Escribe la Introducción 1" id="text_area_intro_uno" style="height: 100px; resize:none"><?= $urbanization['introduction_one'] ?></textarea>
                            </div>

                            <div class="mb-3"></div>

                            <div class="fw-500">
                                INTRODUCCIÓN 2:
                                <span class="ms-3 btn_action user-select-none text-success" id="btn_edit_intro_dos" type="button">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Editar
                                </span>

                                <span class="ms-3 user-select-none d-none" id="btn_save_intro_dos" type="button">
                                    <span class="fw-400 me-2" id="charater_input_intro_dos">(<?= mb_strlen($urbanization['introduction_two']) ?>/990)</span>
                                    <i class="fa-solid fa-floppy-disk text-primary me-1"></i> <span class="text-primary">Guardar</span>
                                </span>

                                <span class="ms-3 user-select-none text-secondary d-none" id="btn_cancel_intro_dos" type="button"><i class="fa-regular fa-rectangle-xmark me-1"></i> Cancelar</span>
                            </div>

                            <div class="">
                                <div class="mb-3 mt-2 border px-3 py-2 border-2 rounded" style="min-height: 70px;"  id="text_view_intro_dos"><?= ( trim($urbanization['introduction_two']) == '' ) ? '--' : $urbanization['introduction_two'] ?></div>
                            </div>

                            <div>
                                <label for="text_area_intro_dos" class="d-none"></label>
                                <textarea disabled minlength="10" class="form-control mb-3 mt-2 d-none" maxlength="990" placeholder="Escribe la Introducción 1" id="text_area_intro_dos" style="height: 150px; resize:none"><?= $urbanization['introduction_two'] ?></textarea>
                            </div>

                            <div class="mb-3"></div>

                            <p class="fw-500">
                                SLIDER: <span class="color-info btn_action" type="button" data-bs-toggle="modal" data-bs-target="#modal_new_slider"><i class="fa-solid fa-circle-plus ms-3"></i> Nuevo</span>
                            </p>

                            <div id="slider_list" style="max-width: 1000px;">

                                <?php foreach ($slider as $key => $value) { ?>

                                    <div class="mb-0 slider_each position-relative row border border-2 py-2 mx-0" data-id="<?= $value['id'] ?>">
                                        <i class="fa-solid fa-arrows-up-down-left-right mt-1 text-success user-select-none" style="width: 30px; cursor:move"></i>

                                        <div style="width: calc(100% - 70px); text-align:justify">
                                            <p class="mb-1"><?= $value['description'] ?></p>

                                            <?php if($value['is_video'] == 1) { ?>
                                                <div class="ms-4">
                                                    <iframe width="210" height="118" src="https://www.youtube.com/embed/<?= $value['file'] ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                </div>
                                            <?php } else if($value['is_video'] == 0) { ?>
                                                <div class="ms-4">
                                                    <img height="118" src="<?= $assets_url ?>/admin/images/slider/<?= $value['file'] ?>" alt="">
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="btn_delete_slider bg-danger text-white" data-id="<?= $value['id'] ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>

                                <?php }

                                if ($slider == []) { ?>

                                    <p class="mb-0 ms-3">- Aun no se ha ingresado alguna imagen o video.</p>

                                <?php } ?>

                            </div>

                            <?php if($slider != []) { ?>
                                <div class="mx-0">
                                    <div id="main_carousel" class="mt-5 mx-0 py-3">
                                        <div class="d-flex justify-content-between mb-2 mx-2">
                                            <button id="btn_prev" class="btn btn-primary py-1">
                                                <i class="fa-solid fa-angle-left me-2"></i>Anterior
                                            </button>

                                            <button id="btn_next" class="btn btn-primary py-1">
                                                Siguiente<i class="fa-solid fa-angle-right ms-2"></i>
                                            </button>
                                        </div>

                                        <div id="main_item" class="mb-4">
                                            <iframe class="w-100" src="" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            <img class="mw-100" src="" alt="">

                                            <p id="main_description" class="mt-2 fs-16"></p>
                                        </div>

                                        <div class="d-flex user-select-none">
                                            <div id="icon_prev">
                                                <i class="fa-solid fa-angle-left"></i>
                                            </div>

                                            <div id="container_items" class="d-flex">
                                                <?php
                                                $countSlider = count($slider);
                                                foreach ($slider as $key => $value) {
                                                    if($value['is_video'] == 1) { ?>
                                                        <div class="item position-relative <?= $key === 0 ? 'ms-0' : '' ?> mx-2" data-is-video="1" data-src="https://www.youtube.com/embed/<?= $value['file'] ?>" data-description="<?= $value['description'] ?>">

                                                            <div class="overlap position-absolute" data-index="<?=  $key ?>"></div>

                                                            <iframe src="https://www.youtube.com/embed/<?= $value['file'] ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                                                        </div>
                                                    <?php } else if($value['is_video'] == 0) { ?>
                                                        <div class="item position-relative <?= $key === 0 ? 'ms-0' : '' ?> mx-2" data-is-video="0" data-src="<?= $assets_url ?>/admin/images/slider/<?= $value['file'] ?>" data-description="<?= $value['description'] ?>">

                                                            <div class="overlap position-absolute" data-index="<?=  $key ?>"></div>

                                                            <img height="118" src="<?= $assets_url ?>/admin/images/slider/<?= $value['file'] ?>" alt="">

                                                        </div>
                                                    <?php }
                                                } ?>
                                            </div>

                                            <div id="icon_next">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="mb-3"></div>

                            <p class="fw-500">
                                BENEFICIOS: <span class="color-info btn_action" type="button" data-bs-toggle="modal" data-bs-target="#modal_newbeneficio"><i class="fa-solid fa-circle-plus ms-3"></i> Nuevo</span>
                            </p>

                            <div id="beneficios_list" style="max-width: 1000px;">

                                <?php foreach ($benefits as $key => $value) { ?>

                                    <div class="mb-0 bienes_each row border border-2 py-2 mx-0" data-id="<?= $value['id'] ?>">
                                        <i class="fa-solid fa-arrows-up-down-left-right mt-1 text-success user-select-none" style="width: 30px; cursor:move"></i>

                                        <span style="width: calc(100% - 70px); text-align:justify"><?= $value['name'] ?></span>

                                        <div class="btn_delete_bien bg-danger text-white" data-id="<?= $value['id'] ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>

                                <?php }

                                if ($benefits == []) { ?>

                                    <p class="mb-0 ms-3">- Aun no se ha ingresado algún beneficio.</p>

                                <?php } ?>

                            </div>

                            <div class="mb-4"></div>

                            <p class="fw-500">
                                DOCUMENTOS ENTREGADOS: <span class="color-info btn_action" type="button" data-bs-toggle="modal" data-bs-target="#modal_newmaterial"><i class="fa-solid fa-circle-plus ms-3"></i> Nuevo</span>
                            </p>

                            <div id="materiales_list" style="max-width: 1000px;">

                                <?php foreach ($docs as $key => $value) { ?>

                                    <div class="mb-0 material_each row border border-2 py-2 mx-0" data-id="<?= $value['id'] ?>">
                                        <i class="fa-solid fa-arrows-up-down-left-right mt-1 text-success user-select-none" style="width: 30px; cursor:move"></i>

                                        <span style="width: calc(100% - 70px); text-align:justify"><?= $value['name'] ?></span>

                                        <div class="btn_delete_material bg-danger text-white" data-id="<?= $value['id'] ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>

                                <?php }

                                if ($docs == []) { ?>

                                    <p class="mb-0 ms-3">- Aun no se ha ingresado algún documento.</p>

                                <?php } ?>

                            </div>

                            <div class="mb-4"></div>

                            <p class="fw-500">
                                CONTACTOS: <span class="color-info btn_action" type="button" data-bs-toggle="modal" data-bs-target="#modal_new_contact"><i class="fa-solid fa-circle-plus ms-3"></i> Nuevo</span>
                            </p>

                            <div id="contact_list" style="max-width: 1000px;">

                                <?php foreach ($contacts as $key => $value) { ?>

                                    <div class="mb-0 contact_each row border border-2 py-2 mx-0" data-id="<?= $value['id'] ?>">
                                        <i class="fa-solid fa-arrows-up-down-left-right mt-1 text-success user-select-none" style="width: 30px; cursor:move"></i>

                                        <span style="width: calc(100% - 70px); text-align:justify">
                                            <?= $value['name'] ?>

                                            <?php if ($value['whatsapp'] != 0) { ?>
                                                <?=  $value['name'] != ''  ? ' &nbsp;&nbsp;-&nbsp;&nbsp; ' : '' ?>
                                                <?= $value['whatsapp'] ?>

                                                <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $value['whatsapp'] ?>" class=" fw-500">WhatsApp <i class="fa-solid ms-1 fa-arrow-up-right-from-square"></i>
                                                </a>
                                            <?php } ?>

                                            <?= $value['email'] !== '' && ($value['whatsapp'] != 0 || $value['name'] != '')  ? ' &nbsp;&nbsp;-&nbsp;&nbsp; ' : '' ?>

                                            <?= $value['email'] ?>
                                        </span>

                                        <div class="btn_delete_contact bg-danger text-white" data-id="<?= $value['id'] ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>

                                <?php }

                                if ($contacts == []) { ?>

                                    <p class="mb-0 ms-3">- Aun no se ha ingresado algún contacto.</p>

                                <?php } ?>

                            </div>

                            <div class="mb-4"></div>

                            <p class="fw-500">
                                CONTENIDO DEL PROYECTO: <span class="color-info btn_action" type="button" data-bs-toggle="modal" data-bs-target="#modal_newmodulo"><i class="fa-solid fa-circle-plus ms-3"></i> Nuevo Módulo</span>
                            </p>

                            <div class="accordion" id="accordion_modulos" style="max-width: 1200px;">

                                <?php foreach ($modules as $key => $value) { ?>

                                    <div class="accordion-item accordion-item_modulos d-flex" data-id="<?= $value['id'] ?>">

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
                                                    <?= $value['name'] ?>

                                                    <span class="text-success btn_action fs-14 fw-500 btn_new_indicador ms-5" type="button"
                                                    data-id="<?= $value['id'] ?>"
                                                    >
                                                        <i class="fa-solid fa-circle-plus fs-13"></i>
                                                        Nuevo Indicador
                                                    </span>

                                                    <span class="text-danger btn_action fs-14 fw-500 btn_delete_modulo ms-3" type="button"
                                                    data-id="<?= $value['id'] ?>"
                                                    >
                                                        <i class="fa-solid fa-trash-can"></i>
                                                        Eliminar Módulo
                                                    </span>

                                                    <span class="cantidad_indicadores fs-14"><?= count($value['indicators']) ?> indicadores</span>
                                                </button>
                                            </h2>

                                            <div id="collapse_mod_<?= $key ?>" class="accordion-collapse collapse" aria-labelledby="heading_mod_<?= $key ?>" data-bs-parent="#accordion_modulos">
                                                <div class="accordion-body accordion_body_indicadores">

                                                <?php foreach ($value['indicators'] as $llave => $valor) { ?>

                                                    <div class="mb-0 indicador_each row border border-2 py-2 mx-0" data-id="<?= $valor['id'] ?>">
                                                        <i class="fa-solid fa-arrows-up-down-left-right mt-1 text-success user-select-none" style="width: 30px; cursor:move"></i>

                                                        <span style="width: calc(100% - 70px); text-align:justify"><?= $valor['name'] ?></span>

                                                        <div class="btn_delete_indicador bg-danger text-white" data-id="<?= $valor['id'] ?>">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </div>
                                                    </div>

                                                <?php } ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <?php }

                                if ($modules == []) { ?>

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
                    <h5 class="modal-title fw-bold" id="modal_newmaterialLabel">AÑADIR DOCUMENTO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 ps-3 pe-4">
                        <label for="nameMaterial" class="form-label fw-500 text-black">NOMBRE DEL DOCUMENTO: <span class="fw-400" id="charater_input_material">(0/190)</span></label>
                        <textarea class="form-control" placeholder="Describe el nuevo documento" id="nameMaterial" required autocomplete="off" minlength="5" maxlength="190" style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_matetial">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_new_contact" tabindex="-1" aria-labelledby="modal_new_contactLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_new_contactLabel">AÑADIR CONTACTO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="input-group mt-2 mb-3 col-12">
                        <span class="input-group-text fw-500" style="width: 100px;">Nombre</span>
                        <input id="new_contact_name" type="text" maxlength="95" class="form-control" aria-label="Name" autocomplete="off">
                    </div>

                    <div class="col-5">
                        <div class="input-group mb-3 col-6">
                            <span class="input-group-text fw-500" style="width: 100px;">WhatsApp</span>
                            <input id="new_contact_whatsapp" type="number" class="form-control" aria-label="WhatsApp" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-7">
                        <div class="input-group mb-0 col-6">
                            <span class="input-group-text fw-500" style="width: 100px;">Correo</span>
                            <input id="new_contact_email" type="email" maxlength="95" class="form-control" aria-label="Correo" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_contact">Añadir</button>
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
                        <textarea class="form-control" placeholder="Describe el nuevo beneficio" id="nameBeneficio" required autocomplete="off" minlength="5" maxlength="190" style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_beneficio">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_new_slider" tabindex="-1" aria-labelledby="modal_new_sliderLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_new_sliderLabel">AÑADIR IMAGEN O VIDEO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-700 ps-3">¿FOTO O VIDEO?</p>
                    <div class="d-flex ps-4 mb-3">
                        <div class="form-check me-4 user-select-none">
                            <input class="form-check-input" type="radio" name="is_image" value="yes" id="form_slider_is_image" checked>
                            <label class="form-check-label" for="form_slider_is_image">
                                Foto
                            </label>
                        </div>

                        <div class="form-check user-select-none">
                            <input class="form-check-input" type="radio" name="is_image" value="no" id="form_slider_is_video">
                            <label class="form-check-label" for="form_slider_is_video">
                                Video
                            </label>
                        </div>
                    </div>

                    <div class="mb-3 ps-3 pe-4" id="form_slider_video_parent">
                        <label for="form_slider_video" class="form-label fw-500 text-black">SUBIR VIDEO:</label>
                        <input class="form-control" placeholder="Ingresar el link de YouTube" id="form_slider_video" autocomplete="off">
                    </div>

                    <div class="mb-3 ps-3 pe-4" id="form_slider_image_parent">
                        <label for="form_slider_image" class="form-label fw-500 text-black">SUBIR IMAGEN:</label>
                        <input type="file" class="form-control" id="form_slider_image" autocomplete="off">
                    </div>

                    <div class="mb-3 ps-3 pe-4">
                        <label for="form_slider_description" class="form-label fw-500 text-black">DESCRIPCIÓN: <span class="fw-400" id="character_input_slider">(0/95)</span></label>
                        <textarea class="form-control" placeholder="Ingrese la descripción de la imagen/video" id="form_slider_description" autocomplete="off" maxlength="95" style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_slider">Añadir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bayer_modal" id="modal_newmodulo" tabindex="-1" aria-labelledby="modal_newmoduloLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modal_newmoduloLabel">AÑADIR MÓDULO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 ps-3 pe-4">
                        <label for="nameModulo" class="form-label fw-500 text-black">NOMBRE DEL MÓDULO:</label>
                        <textarea class="form-control" placeholder="Describe el nuevo módulo" id="nameModulo" required autocomplete="off" minlength="5" maxlength="198" style="height: 90px; resize: none"></textarea>
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
                        <textarea class="form-control" placeholder="Describe el nuevo indicador" id="nameIndicador" required autocomplete="off" minlength="5" maxlength="198" style="height: 90px; resize: none"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_add_indicador" data-id="">Añadir</button>
                </div>
            </div>
        </div>
    </div>
