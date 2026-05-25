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
            <div class="carousel-item active mini-hero-slide" style="background-image: url('<?= $assets_url ?>/admin/images/general/curso_banner_1.png');">
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item mini-hero-slide" style="background-image: url('<?= $assets_url ?>/admin/images/general/curso_banner_2.png');">
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

        <h2 class="fw-800 mb-2 text-dark" style="font-size:2rem; border-left:5px solid #005fff; padding-left:16px;">
            Nuestros Talleres
        </h2>
        <p class="mb-4" style="padding-left:21px; color:#666; font-size:1rem; font-weight:400;">
            Participa en nuestros talleres prácticos y aprende de forma interactiva con profesionales experimentados.
        </p>

        <div class="row g-4">

            <?php foreach ($talleres as $key => $value) { 
                $isFree = (!isset($value['lanzamiento_costo']) || $value['lanzamiento_costo'] == 0);
            ?>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 position-relative" style="border-radius:14px; overflow:hidden; transition: transform .25s, box-shadow .25s;"
                     onmouseenter="this.style.transform='translateY(-5px)';this.style.boxShadow='0 16px 40px rgba(0,0,0,.14)'"
                     onmouseleave="this.style.transform='';this.style.boxShadow=''">

                    <!-- Image wrapper -->
                    <div style="height:250px; overflow:hidden; position:relative; background:#dde0e6;">
                        <img src="<?= $assets_url ?>/admin/images/cursos/<?= ($value['curso_img_main'] == '') ? 'sin_imagen.jpg' : $value['curso_img_main'] ?>"
                             alt="<?= $value['curso_nombre'] ?>"
                             style="width:100%; height:100%; object-fit:cover; object-position:center; display:block;">
                        
                        <!-- Price badge -->
                        <div style="position:absolute; bottom:14px; left:14px; background:#005fff; color:#fff;
                                    border-radius:12px; padding:10px 20px; line-height:1.2;
                                    box-shadow:0 4px 16px rgba(0,0,0,.35);">
                            <small style="display:block; font-size:11px; font-weight:800; opacity:.85; letter-spacing:1.5px; text-transform:uppercase;">Inversión</small>
                            <span style="font-size:26px; font-weight:900; display:block; letter-spacing:-0.5px;">
                                <?= $isFree ? 'Gratuito' : 'S/ ' . $value['lanzamiento_costo'] ?>
                            </span>
                        </div>
                        
                        <!-- Premium/Gratuito Badge -->
                        <div style="position:absolute; top:14px; right:14px; background:<?= $isFree ? '#05b848' : '#e67e22' ?>; color:#fff;
                                    border-radius:8px; padding:6px 14px; font-weight:800; font-size:12px;
                                    box-shadow:0 2px 8px rgba(0,0,0,.2); text-transform:uppercase; letter-spacing:1px;">
                            <i class="fa-solid <?= $isFree ? 'fa-gift' : 'fa-star' ?> me-1"></i> <?= $isFree ? 'Gratis' : 'Premium' ?>
                        </div>
                    </div>

                    <!-- Card body -->
                    <div class="card-body d-flex flex-column p-4">
                        <a href="<?= $base_url ?>/talleres/ver/<?= $value['curso_id'] ?>" class="text-decoration-none stretched-link">
                            <h5 class="fw-700 mb-3" style="font-size:1.25rem; color:#1a1a1a; line-height:1.3;"><?= $value['curso_nombre'] ?></h5>
                        </a>

                        <!-- Meta rows -->
                        <div class="d-flex flex-column gap-2 mb-3 flex-grow-1">

                            <div class="d-flex align-items-center gap-3">
                                <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:38px;height:38px;border-radius:10px;background:rgba(0,95,255,.15);color:#005fff;font-size:16px;">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <div>
                                    <div style="font-size:11px;font-weight:800;color:#888;text-transform:uppercase;letter-spacing:1px; margin-bottom:2px;">Duración</div>
                                    <span style="font-size:15px; color:#333; font-weight:600;"><?= (!isset($value['lanz_duracion'])) ? '-- Meses' : $value['lanz_duracion'] ?></span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:38px;height:38px;border-radius:10px;background:rgba(5,184,72,.15);color:#05b848;font-size:16px;">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </span>
                                <div>
                                    <div style="font-size:11px;font-weight:800;color:#888;text-transform:uppercase;letter-spacing:1px; margin-bottom:2px;">Matrícula</div>
                                    <span style="font-size:15px; color:<?= (!isset($value['lanzamiento_costo'])) ? '#dc3545' : '#05b848' ?>; font-weight:700;">
                                        <?= (!isset($value['lanzamiento_costo'])) ? 'Muy Pronto' : 'Abierta' ?>
                                    </span>
                                </div>
                            </div>

                        </div>

                        <!-- CTA -->
                        <div class="d-grid mt-3">
                            <a href="<?= $base_url ?>/talleres/ver/<?= $value['curso_id'] ?>" class="btn btn-dark fw-700 position-relative z-3" style="border-radius:10px; letter-spacing:.6px; font-size:16px; padding:14px 20px;">
                                INSCRÍBETE AHORA <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <?php } if ($talleres == []) { ?>
                <div class="col-12 text-center py-5 text-muted fs-5">No hay talleres que mostrar. Muy pronto estarán disponibles.</div>
            <?php } ?>

        </div>
    </div>
</section>
