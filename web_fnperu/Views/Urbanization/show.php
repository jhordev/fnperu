<div class="bg-dark" id="header_top_curso">

    <div class="row contaner_general mx-auto">

        <div class="py-4 py-lg-5 px-3 px-lg-4 text-start d-flex flex-column justify-content-center" id="container_data_curso">
            <h1 class="fw-bolder pt-2 pb-2 text-white mb-0" style="font-size: clamp(28px, 5vw, 46px); line-height: 1.2;" id="title_curso"><?= $urbanization['name'] ?></h1>
            <p id="border_title_curso" class="mb-3"></p>

            <p class="fs-17 text_introduccion_uno text-justify"><?= $urbanization['introduction_one'] ?></p>
            <p class="mt-3 pb-0 fs-16 fw-500 fecha_inicio">UBICACIÓN - Urbanización:
                <?php if ($urbanization['coordinates']) { ?>
                    <a target="_blank" href="https://www.google.com/maps?q=<?= $urbanization['coordinates'] ?>" class="span_maps me-2 text-info fw-400 text-decoration-none">
                        <i>Google Maps</i> <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                <?php } else { ?>
                    ---
                <?php } ?>
            </p>


            <p class="mt-2 pb-2 fs-16 fw-500 fecha_inicio">UBICACIÓN - Oficina:
                <?php if ($urbanization['office']) { ?>
                    <a target="_blank" href="https://www.google.com/maps?q=<?= $urbanization['office'] ?>" class="span_maps me-2 text-info fw-400 text-decoration-none">
                        <i>Google Maps</i> <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                <?php } else { ?>
                    ---
                <?php } ?>
            </p>

            <div class="d-grid d-md-flex gap-3 mt-4">
                <?php if ($urbanization['plan'] != '') { ?>

                    <a class="btn btn-warning px-4 py-3 py-md-2 link_brochure fw-700 shadow-sm d-flex align-items-center justify-content-center text-dark" style="border-radius: 8px; font-size: 16px;" target="_blank" href="<?= $assets_url ?>/admin/docs/house-plans/<?= $urbanization['plan'] ?>">DESCARGAR PLANO <i class="ms-2 fa-solid fa-up-right-from-square"></i></a>

                <?php }

                if ($firstContacts != null) { ?>
                    <a target="_blank" class="data_curso_first_contact text-white ms-0 ms-md-2 btn-success btn py-3 py-md-2 fw-700 shadow-sm d-flex align-items-center justify-content-center" style="border-radius: 8px; font-size: 16px;" href="https://wa.me/51<?= $firstContacts['whatsapp'] ?>?text=Hola,%20información%20por%20favor"><i class="fa-brands fa-whatsapp fs-5 me-2"></i> WhatsApp</a>
                <?php } ?>
            </div>
        </div>

        <div class="py-4 py-lg-5 px-0 px-md-3 px-lg-4 d-flex align-items-center justify-content-center" id="container_img_principal">
            <div class="overflow-hidden w-100">

                <?php if ($urbanization['video_overlay'] == 1 && $urbanization['youtube_video'] != '') { ?>
                    <iframe class="w-100" height="315" src="https://www.youtube.com/embed/<?= $urbanization['youtube_video'] ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } else { ?>

                    <img src="<?= $assets_url ?>/admin/images/urbanization/<?= ($urbanization['image'] == '') ? 'sin_imagen.jpg' : $urbanization['image'] ?>" alt="">

                <?php } ?>

            </div>

        </div>
    </div>

</div>

<div class="<?= $slider != [] ? 'mt-2' : 'mt-4' ?>">

    <div class="contaner_general mx-auto mb-3 container_main_detalle row">

        <?php if($slider != []) { ?>
            <div class="mx-0 px-0">
                <div id="main_carousel" class="mx-0 py-3">
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

                        <p id="main_description" class="mt-2 fs-16 text-white"></p>
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

        <section id="seccion_main">

            <?php if ($urbanization['introduction_two'] != '') { ?>

                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                    <h5 class="card-header py-3 fw-600 border-bottom-0">INTRODUCCIÓN:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>

                    <div class="card-body background_card_body">
                        <p class="card-text text-justify"><?= $urbanization['introduction_two'] ?></p>
                    </div>
                </div>
            <?php }

            if ($modules != []) { ?>

                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                    <h5 class="card-header py-3 fw-600 border-bottom-0">CONTENIDO DEL PROYECTO:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>

                    <div class="card-body background_card_body accordion" id="accordion_modulos">
                        <?php
                            foreach ($modules as $key => $value)
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
                                            <?= $value['name'] ?>
                                        </button>
                                    </h2>

                                    <div id="collapse_mod_<?= $key ?>" class="accordion-collapse collapse <?= ($key != 0) ? '' : 'show' ?>" aria-labelledby="heading_mod_<?= $key ?>" data-bs-parent="#accordion_modulos">
                                        <div class="accordion-body">

                                        <?php foreach ($value['indicators'] as $llave => $valor) { ?>

                                            <div class="mb-0 mx-0">

                                                <span>❑ <?= $valor['name'] ?></span>

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

            if ($benefits != []) { ?>

                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                    <h5 class="card-header py-3 fw-600 border-bottom-0">BENEFICIOS:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>

                    <div class="card-body background_card_body">
                        <?php
                            foreach ($benefits as $key => $value)
                            { ?>
                                <div class="d-flex mb-1">
                                    <i class="fa-solid fa-check d-block me-2 mt-1"></i>
                                    <p class="text-justify"><?= $value['name'] ?></p>
                                </div>
                        <?php }
                        ?>

                    </div>
                </div>

            <?php }

            if ($docs != []) { ?>

                <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                    <h5 class="card-header py-3 fw-600 border-bottom-0">DOCUMENTOS ENTREGADOS:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>

                    <div class="card-body background_card_body">
                        <?php
                            foreach ($docs as $key => $value)
                            { ?>
                                <div class="d-flex mb-1">
                                    <i class="fa-solid fa-check d-block me-2 mt-1"></i>
                                    <p class="text-justify"><?= $value['name'] ?></p>
                                </div>
                        <?php }
                        ?>

                    </div>
                </div>

            <?php } ?>

            <?php if ($contacts != []) { ?>
                <div class="card procedimiento_matricula pb-4 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">

                    <h5 class="card-header py-3 fw-600 border-bottom-0">PARA ATENCIÓN PERSONALIZADA COMUNÍCATE A LOS SIGUIENTES CONTACTOS:</h5>

                    <div class="background_card_body">
                        <div class="bordecito_minimal_main"></div>
                    </div>

                    <?php foreach ($contacts as $contact) { ?>
                        <div class="card-body pt-2 background_card_body pb-1">

                            <?php if ($contact['name']) { ?>
                                <p class="card-text mb-2"><span class="fs-20">☛</span> <?= $contact['name'] ?></p>
                            <?php } ?>

                            <div class="buttons_contacto <?= !$contact['name'] ? 'mt-2' : 'ms-4-5' ?>">
                                <?php if (!$contact['name']) { ?>
                                    <span class="card-text fs-20">☛</span>
                                <?php } ?>

                                <?php if ($contact['whatsapp']) { ?>
                                    <a target="_blank" href="https://wa.me/51<?= $contact['whatsapp'] ?>?text=Hola,%20información%20por%20favor" class="btn_whatsapp_main ms-3">WHATSAPP &nbsp; <?= $contact['whatsapp'] ?></a>
                                <?php } ?>

                                <?php if ($contact['email']) { ?>
                                    <a class="btn_correo_main <?= $contact['whatsapp'] ? '' : 'ms-3' ?>" >CORREO: &nbsp; <?= $contact['email'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

        </section>

        <section id="seccion_lateral">
            <div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
                <div class="card-body">

                    <p class="mb-1 fs-17 fw-500">Precios desde:</p>

                    <button class="btn btn-danger py-3 px-4 fs-25 btn_precio_big w-100 fw-bold shadow-sm" style="border-radius: 10px;">S/ <?= $urbanization['price'] == null ? '-.--' : $urbanization['price'] ?></button>

                    <div class="bordecito_minimal"></div>

                    <p class="">Síguenos en Facebook:</p>

                    <div class="mt-3 container_facebook">
                        <div class="fb-page" data-href="https://www.facebook.com/FNCONSTRUCTORES" data-tabs="timeline" data-width="400" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/FNCONSTRUCTORES" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/FNCONSTRUCTORES">
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

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v13.0&appId=1153960901666853&autoLogAppEvents=1" nonce="RG8Wnxs3"></script>
