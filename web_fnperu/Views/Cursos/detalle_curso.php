<div class="bg-dark" id="header_top_curso">
    
    <div class="row contaner_general pt-4 pb-4 pt-lg-0 pb-lg-0 mx-auto">

        <div class="py-4 py-lg-5 px-3 px-lg-4 text-start d-flex flex-column justify-content-center" id="container_data_curso">
            <h1 class="fw-bolder pt-2 pb-2 text-white mb-0" style="font-size: clamp(28px, 5vw, 46px); line-height: 1.2;" id="title_curso"><?= $curso['curso_nombre'] ?></h1>
            <p id="border_title_curso" class="mb-3"></p>
            <p class="fs-17 text_introduccion_uno text-justify"><?= $curso['curso_introduccion'] ?></p>
            <p class="mt-3 pb-2 fs-20 fw-500 fecha_inicio">FECHA DE INICIO: <?= isset($dataLanza['lanzamiento_inicio']) ? $dataLanza['lanzamiento_inicio'] : 'Muy Pronto' ?></p>

            <p class="fs-20 pb-3 incluye_certificado">* Incluye certificado físico y digital</p>

            <?php if ($curso['curso_brochure'] != '') { ?>
                <div class="d-grid d-md-flex gap-3 mt-4">
                    <a class="btn btn-warning px-4 py-3 py-md-2 link_brochure fw-700 shadow-sm d-flex align-items-center justify-content-center text-dark" style="border-radius: 8px; font-size: 16px;" target="_blank" href="<?= $assets_url ?>/admin/docs/brochure/<?= $curso['curso_brochure'] ?>">DESCARGAR BROCHURE <i class="ms-2 fa-solid fa-up-right-from-square"></i></a>
                    <button type="button" class="btn btn-primary px-4 py-3 py-md-2 fw-700 shadow-sm d-flex align-items-center justify-content-center" style="border-radius: 8px; font-size: 16px;" data-bs-toggle="modal" data-bs-target="#modal_newsolicitud">MATRICÚLATE AHORA <i class="ms-2 fa-solid fa-arrow-right"></i></button>
                </div>
            <?php } else { ?>
                <div class="d-grid d-md-flex gap-3 mt-4">
                    <button type="button" class="btn btn-primary px-4 py-3 py-md-2 fw-700 shadow-sm d-flex align-items-center justify-content-center" style="border-radius: 8px; font-size: 16px;" data-bs-toggle="modal" data-bs-target="#modal_newsolicitud">MATRICÚLATE AHORA <i class="ms-2 fa-solid fa-arrow-right"></i></button>
                </div>
            <?php } ?>
            
        </div>

        <div class="py-4 py-lg-5 px-0 px-md-3 px-lg-4 d-flex align-items-center justify-content-center" id="container_img_principal">
            <div class="overflow-hidden w-100">

                <?php if ($curso['curso_video_habil'] == 1 && $curso['curso_video'] != '') { ?>
                    <iframe class="w-100" height="315" src="https://www.youtube.com/embed/<?= $curso['curso_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } else { ?>

                    <img src="<?= $assets_url ?>/admin/images/cursos/<?= ($curso['curso_img_main'] == '') ? 'sin_imagen.jpg' : $curso['curso_img_main'] ?>" alt="">

                <?php } ?>
                
            </div>
            
        </div>
    </div>

</div>

<div class="mt-4">
    
    <div class="contaner_general mx-auto mb-3 container_main_detalle row">

        <section id="seccion_main">

            <?php if ($curso['curso_introduccion_dos'] != '') { ?>

                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                    <h5 class="card-header py-3 fw-600 border-bottom-0">INTRODUCCIÓN:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>
                    
                    <div class="card-body background_card_body">
                        <p class="card-text text-justify"><?= $curso['curso_introduccion_dos'] ?></p>
                    </div>
                </div>
            <?php } 
            
            if ($contenido != []) { ?>

                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                    <h5 class="card-header py-3 fw-600 border-bottom-0">CONTENIDO DEL CURSO:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>
                    
                    <div class="card-body background_card_body accordion" id="accordion_modulos">
                        <?php
                            foreach ($contenido as $key => $value)  
                            { ?>
                                <div class="accordion-item accordion-item_modulos">

                                    <h2 class="accordion-header user-select-none" id="heading_mod_<?= $key ?>">

                                        <button 
                                        class="accordion-button <?= ($key != 0) ? 'collapsed' : '' ?> text-dark fw-700" 
                                        type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse_mod_<?= $key ?>" 
                                        aria-expanded="<?= ($key != 0) ? 'false' : 'true' ?>" 
                                        aria-controls="collapse_mod_<?= $key ?>"
                                        style="background-color: #fbfbf8; box-shadow:none; padding: 12px 20px"
                                        >
                                            <?= $value['mod_nombre'] ?> 
                                        </button>
                                    </h2>

                                    <div id="collapse_mod_<?= $key ?>" class="accordion-collapse collapse <?= ($key != 0) ? '' : 'show' ?>" aria-labelledby="heading_mod_<?= $key ?>" data-bs-parent="#accordion_modulos">
                                        <div class="accordion-body">
                                            
                                        <?php foreach ($value['indicadores'] as $llave => $valor) { ?>

                                            <div class="mb-0 mx-0">

                                                <span>❑ <?= $valor['ind_nombre'] ?></span>
                                                
                                            </div>

                                        <?php } ?>
                                        
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        ?>
                        
                    </div>
                </div>

            <?php } 
            
            if ($beneficios != []) { ?>

                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                    <h5 class="card-header py-3 fw-600 border-bottom-0">BENEFICIOS:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>
                    
                    <div class="card-body background_card_body">
                        <?php
                            foreach ($beneficios as $key => $value)  
                            { ?>
                                <div class="d-flex mb-1">
                                    <i class="fa-solid fa-check d-block me-2 mt-1"></i>
                                    <p class="text-justify"><?= $value['beneficio_nombre'] ?></p>
                                </div>
                        <?php }
                        ?>
                        
                    </div>
                </div>

            <?php }
            
            if ($materiales != []) { ?>

                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                    <h5 class="card-header py-3 fw-600 border-bottom-0">MATERIALES ENTREGADOS:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>
                    
                    <div class="card-body background_card_body">
                        <?php
                            foreach ($materiales as $key => $value)  
                            { ?>
                                <div class="d-flex mb-1">
                                    <i class="fa-solid fa-check d-block me-2 mt-1"></i>
                                    <p class="text-justify"><?= $value['material_nombre'] ?></p>
                                </div>
                        <?php }
                        ?>
                        
                    </div>
                </div>

            <?php } ?>
            
            <div class="card procedimiento_matricula border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">

                <h5 class="card-header py-3 fw-600 border-bottom-0">PROCEDIMIENTO DE MATRÍCULA:</h5>

                <div class="background_card_body">
                    <div class="bordecito_minimal_main"></div>
                </div>
                
                <div class="card-body background_card_body pb-4">

                    <p class="card-text mb-3">IMPORTANTE: Para inscripciones, solicitud de ficha de inscripción y datos bancarios, comunicarse por los siguientes medios de contacto.</p>

                    <div class="text-center buttons_contacto">
                        <a target="_blank" href="https://wa.me/51<?= preg_replace('/\D/', '', $web_config['contacto_telefono_1'] ?? '') ?>?text=Hola,%20información%20por%20favor" class="btn_whatsapp_main">WHATSAPP &nbsp; <?= htmlspecialchars($web_config['contacto_telefono_1'] ?? '') ?></a>
                        <a class="btn_correo_main">CORREO: &nbsp; <?= htmlspecialchars($web_config['contacto_email'] ?? '') ?></a>
                    </div>
                </div>
            </div>

        </section>

        <section id="seccion_lateral">
            <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                <div class="card-body">
                    <button class="btn btn-danger py-3 px-4 fs-25 btn_precio_big w-100 fw-bold shadow-sm" style="border-radius: 10px;">S/ <?= isset($dataLanza['lanzamiento_costo']) ? $dataLanza['lanzamiento_costo'] : '-.--' ?></button>

                    <div class="d-grid gap-2 mt-2">
                        <button class="btn mt-3" id="btn_matricula" type="button">MATRICULATE</button>
                    </div>

                    <div class="bordecito_minimal"></div>

                    <div class="card mt-3 card_medios_pago border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                        <h5 class="card-header fw-600">Medios de Pagos</h5>
                        <div class="card-body">
                            <p class="card-text fw-400">Escríbenos para enviarte los detalles bancarios:</p>
                            <p class="card-text fw-400"><span class="fw-600">WhatsApp:</span> <?= htmlspecialchars($web_config['contacto_telefono_1'] ?? '') ?></p>
                            <p class="card-text fw-400"><span class="fw-600">Correo:</span> <?= htmlspecialchars($web_config['contacto_email'] ?? '') ?></p>
                        </div>
                    </div>

                    <div class="bordecito_minimal"></div>

                    <p class="fs-18 fw-700">Síguenos en Facebook</p>

                    <div class="mt-3 container_facebook">
                        <div class="fb-page" data-href="https://www.facebook.com/FNPERUINGENIERIA" data-tabs="timeline" data-width="400" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/FNPERUINGENIERIA" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/FNPERUINGENIERIA">
                                    Fnperú ingeniería y arquitectura
                                </a>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<div class="modal fade bayer_modal" id="modal_newsolicitud" tabindex="-1" aria-labelledby="modal_newsolicitudLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <form action="" id="from_newsolicitud" autocomplete="off">
                <div class="modal-header bg-light py-3">
                    <h5 class="modal-title fw-800 text-primary" id="modal_newsolicitudLabel">SOLICITUD DE MATRÍCULA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row mx-0">

                    <div class="mb-2 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Nombre del Curso:</label>
                        <input type="text" class="form-control py-2" disabled value="<?= $curso['curso_nombre'] ?>">
                    </div>

                    <input type="number" class="d-none" name="id_curso" value="<?= $curso['curso_id'] ?>">

                    <div class="mb-2 col-12 col-lg-3 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">DNI:</label>
                        <input type="number" class="form-control no-arrow py-2" required name="dni">
                    </div>

                    <div class="mb-2 col-12 col-lg-5 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Nombres:</label>
                        <input type="text" class="form-control py-2" minlength="2" maxlength="140" required name="nombres">
                    </div>

                    <div class="mb-2 col-12 col-lg-4 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Apellido Paterno:</label>
                        <input type="text" class="form-control py-2" minlength="2" maxlength="140" required name="apellido_paterno">
                    </div>

                    <div class="mb-2 col-12 col-lg-4 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Apellido Materno:</label>
                        <input type="text" class="form-control py-2" minlength="2" maxlength="140" required name="apellido_materno">
                    </div>

                    <div class="mb-2 col-12 col-lg-3 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Celular:</label>
                        <input type="number" class="form-control no-arrow py-2" min="900000000" max="999999999" required name="celular">
                    </div>

                    <div class="mb-2 col-12 col-lg-5 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Correo Electrónico: (Opcional)</label>
                        <input type="email" class="form-control py-2" minlength="5" maxlength="180" name="email">
                    </div>

                    <div class="mb-2 col-12 col-lg-6 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Lugar de Residencia:</label>
                        <input type="text" class="form-control py-2" minlength="5" maxlength="180" required name="residencia_lugar">
                    </div>

                    <div class="mb-2 col-12 col-lg-6 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Dirección de Residencia:</label>
                        <input type="text" class="form-control py-2" minlength="5" maxlength="180" required name="residencia_direccion">
                    </div>

                    <div class="mb-2 px-2">
                        <label class="form-label fw-600 text-dark mb-1 fs-15">Foto del Voucher:</label>
                        <input class="form-control py-2" type="file" accept="image/png, image/jpg, image/jpeg" required name="vaucher">
                    </div>
                    
                    <div class="mb-3 px-2">
                        <label for="" class="form-label fw-600 text-dark mb-1 fs-15">Mensaje: (Opcional)</label>
                        <textarea class="form-control resize-none py-2" rows="3" name="mensaje" minlength="5" maxlength="400"></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer bg-light py-3 justify-content-between">
                    <button type="button" class="btn btn-outline-secondary px-4 fw-600" style="border-radius: 8px;" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary px-4 fw-600" style="border-radius: 8px;">Enviar Solicitud <i class="fa-solid fa-paper-plane ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v13.0&appId=1153960901666853&autoLogAppEvents=1" nonce="RG8Wnxs3"></script>