<div class="page-heading about-heading header-text" style="background-image: url(<?= $base_url ?>/assets/admin/images/general/nosotros.jpg)">
    <div class="row mx-0">
        <div class="text-content mx-0">
            <h4>CONTACTO</h4>
        </div>
    </div>
</div>

<div class="contaner_general">
    <div id="info_contacto">

        <div class="info_contacto_text">

            <p class="subtema">Más Información:</p>
            <p class="border_for_subtema"></p>

            <p class="fs-18 icon_list">
                <span class="icon"><i class="fa-solid fa-house-chimney"></i></span>
                <span class="text">Dirección: <?= htmlspecialchars($web_config['contacto_direccion'] ?? '') ?></span>
            </p>

            <p class="fs-18 icon_list">
                <span class="icon"><i class="fa-solid fa-phone"></i></span>
                <span class="text">Teléfono: <?= htmlspecialchars($web_config['contacto_telefono_1'] ?? '') ?><?= !empty($web_config['contacto_telefono_2']) ? ' / ' . htmlspecialchars($web_config['contacto_telefono_2']) : '' ?></span>
            </p>

            <p class="fs-18 icon_list">
                <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                <span class="text">Email: <?= htmlspecialchars($web_config['contacto_email'] ?? '') ?></span>
            </p>

            <div class="container_facebook">
                <div class="fb-page" data-href="https://www.facebook.com/FNPERUINGENIERIA" data-tabs="timeline" data-width="500" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/FNPERUINGENIERIA" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/FNPERUINGENIERIA">
                            Fnperú ingeniería y arquitectura
                        </a>
                    </blockquote>
                </div>
            </div>
        </div>

        <div class="info_contacto_form">

            <form autocomplete="off" method="POST">

                <p class="subtema">Formulario de Contacto</p>
                <p class="border_for_subtema"></p>

                <div class="mb-3">
                    <label class="form-label fw-500 mb-1">Nombres y Apellidos:</label>
                    <input type="text" class="form-control" autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-500 mb-1">Teléfono:</label>
                    <input type="text" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-500 mb-1">Email:</label>
                    <input type="text" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-500 mb-1">Asunto:</label>
                    <input type="text" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-500 mb-1">Mensaje:</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>

                <div class="text-end">
                    <button id="btn_submit" type="submit">ENVIAR INFORMACIÓN</button>
                </div>

            </form>

        </div>

    </div>
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v13.0&appId=1153960901666853&autoLogAppEvents=1" nonce="RG8Wnxs3"></script>