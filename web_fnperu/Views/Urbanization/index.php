<!-- ===== Mini Hero Section ===== -->
<section class="mini-hero-section">
    <div id="miniHeroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4500" data-bs-pause="hover">

        <!-- Indicators -->
        <div class="carousel-indicators hero-indicators">
            <button type="button" data-bs-target="#miniHeroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#miniHeroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>

        <!-- Carousel Inner -->
        <div class="carousel-inner h-100">
            <!-- Slide 1 -->
            <div class="carousel-item active mini-hero-slide" style="background-image: url('<?= $assets_url ?>/admin/images/general/urb_banner_1.png');">
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item mini-hero-slide" style="background-image: url('<?= $assets_url ?>/admin/images/general/urb_banner_2.png');">
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev hero-control hero-control-prev" type="button" data-bs-target="#miniHeroCarousel" data-bs-slide="prev">
            <span class="hero-control-icon"><i class="fa-solid fa-chevron-left"></i></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next hero-control hero-control-next" type="button" data-bs-target="#miniHeroCarousel" data-bs-slide="next">
            <span class="hero-control-icon"><i class="fa-solid fa-chevron-right"></i></span>
            <span class="visually-hidden">Siguiente</span>
        </button>

    </div>
</section>

<section class="py-5" style="background:#f4f6f9;">
    <div class="container">

        <h2 class="fw-800 mb-2 text-dark" style="font-size:2rem; border-left:5px solid #f5c518; padding-left:16px;">
            Nuestras Habilitaciones Urbanas
        </h2>
        <p class="mb-4" style="padding-left:21px; color:#666; font-size:1rem; font-weight:400;">
            Encuentra el lote ideal para construir tu hogar o invertir con respaldo profesional.
        </p>

        <div class="row g-4">

            <?php foreach ($urbanization as $key => $value) { ?>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 position-relative" style="border-radius:14px; overflow:hidden; transition: transform .25s, box-shadow .25s;"
                     onmouseenter="this.style.transform='translateY(-5px)';this.style.boxShadow='0 16px 40px rgba(0,0,0,.14)'"
                     onmouseleave="this.style.transform='';this.style.boxShadow=''">

                    <!-- Image wrapper: fixed height, clips any image size -->
                    <div style="height:290px; overflow:hidden; position:relative; background:#dde0e6;">
                        <img src="<?= $assets_url ?>/admin/images/urbanization/<?= ($value['image'] == '') ? 'sin_imagen.jpg' : $value['image'] ?>"
                             alt="<?= $value['name'] ?>"
                             style="width:100%; height:100%; object-fit:cover; object-position:center; display:block;">
                        <!-- Price badge -->
                        <div style="position:absolute; bottom:14px; left:14px; background:#f5c518; color:#1a1a1a;
                                    border-radius:12px; padding:10px 20px; line-height:1.2;
                                    box-shadow:0 4px 16px rgba(0,0,0,.35);">
                            <small style="display:block; font-size:11px; font-weight:800; opacity:.65; letter-spacing:1.5px; text-transform:uppercase;">Desde</small>
                            <span style="font-size:26px; font-weight:900; display:block; letter-spacing:-0.5px;">S/ <?= $value['price'] == null ? '-.--' : $value['price'] ?></span>
                        </div>
                    </div>

                    <!-- Card body -->
                    <div class="card-body d-flex flex-column p-4">
                        <a href="<?= $base_url ?>/urbanizaciones/ver/<?= $value['id'] ?>" class="text-decoration-none stretched-link">
                            <h5 class="fw-700 mb-3" style="font-size:1.25rem; color:#1a1a1a; line-height:1.3;"><?= $value['name'] ?></h5>
                        </a>

                        <!-- Location rows -->
                        <div class="d-flex flex-column gap-2 mb-3 flex-grow-1">

                            <div class="d-flex align-items-center gap-3">
                                <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:38px;height:38px;border-radius:10px;background:rgba(245,197,24,.15);color:#b8880a;font-size:16px;">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <div class="flex-grow-1">
                                    <div style="font-size:11px;font-weight:800;color:#888;text-transform:uppercase;letter-spacing:1px; margin-bottom:3px;">Urbanización</div>
                                    <?php if ($value['coordinates']) { ?>
                                        <a href="https://www.google.com/maps?q=<?= $value['coordinates'] ?>"
                                           target="_blank"
                                           class="btn btn-outline-primary btn-sm position-relative d-inline-flex align-items-center"
                                           style="z-index: 10; font-size:12px; font-weight:600; border-radius:6px; padding: 3px 10px;">
                                            <i class="fa-solid fa-map-location-dot me-1"></i> Ver en Mapa
                                        </a>
                                    <?php } else { ?>
                                        <span style="font-size:13px;color:#bbb;font-weight:500;">No disponible</span>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:38px;height:38px;border-radius:10px;background:rgba(245,197,24,.15);color:#b8880a;font-size:16px;">
                                    <i class="fa-solid fa-building"></i>
                                </span>
                                <div class="flex-grow-1">
                                    <div style="font-size:11px;font-weight:800;color:#888;text-transform:uppercase;letter-spacing:1px; margin-bottom:3px;">Oficina</div>
                                    <?php if ($value['office']) { ?>
                                        <a href="https://www.google.com/maps?q=<?= $value['office'] ?>"
                                           target="_blank"
                                           class="btn btn-outline-primary btn-sm position-relative d-inline-flex align-items-center"
                                           style="z-index: 10; font-size:12px; font-weight:600; border-radius:6px; padding: 3px 10px;">
                                            <i class="fa-solid fa-map-location-dot me-1"></i> Ver en Mapa
                                        </a>
                                    <?php } else { ?>
                                        <span style="font-size:13px;color:#bbb;font-weight:500;">No disponible</span>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>

                        <!-- CTA -->
                        <div class="d-grid mt-3">
                            <a href="<?= $base_url ?>/urbanizaciones/ver/<?= $value['id'] ?>" class="btn btn-dark fw-700 position-relative z-3" style="border-radius:10px; letter-spacing:.6px; font-size:16px; padding:14px 20px;">
                                <i class="fa-solid fa-comment-dots me-2"></i>¡COTIZA AHORA!
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <?php } if ($urbanization == []) { ?>
                <div class="col-12 text-center py-4 text-muted fs-6">No hay Habilitaciones Urbanas que mostrar. Muy pronto estarán disponibles.</div>
            <?php } ?>

        </div>
    </div>
</section>
