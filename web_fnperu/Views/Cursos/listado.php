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
            <div class="carousel-item active mini-hero-slide" style="background-image: url('<?= $assets_url ?>/admin/images/general/curso_banner_1.png');"></div>
            <div class="carousel-item mini-hero-slide" style="background-image: url('<?= $assets_url ?>/admin/images/general/curso_banner_2.png');"></div>
        </div>

        <!-- Controls -->
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

        <!-- Header + Filter -->
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-2">
            <div>
                <h2 class="fw-800 mb-1 text-dark" style="font-size:2rem; border-left:5px solid #005fff; padding-left:16px;">
                    Cursos y Talleres
                </h2>
                <p class="mb-0" style="padding-left:21px; color:#666; font-size:1rem; font-weight:400;">
                    Capacítate con los mejores profesionales y alcanza el siguiente nivel.
                </p>
            </div>

            <!-- Filter buttons -->
            <div class="filtro-bar" role="group" aria-label="Filtrar por tipo">
                <button class="filtro-btn active" data-filter="todos">
                    <i class="fa-solid fa-th-large me-1"></i> Todos
                </button>
                <button class="filtro-btn" data-filter="0">
                    <i class="fa-solid fa-graduation-cap me-1"></i> Cursos
                </button>
                <button class="filtro-btn" data-filter="1">
                    <i class="fa-solid fa-chalkboard-user me-1"></i> Talleres
                </button>
            </div>
        </div>

        <p id="resultado-count" class="mb-4" style="padding-left:21px; color:#999; font-size:0.88rem; font-weight:500;"></p>

        <!-- Cards grid -->
        <div class="row g-4" id="cursos_grid">

            <?php foreach ($cursos as $key => $value):
                $esTaller  = intval($value['curso_tipo']) === 1;
                $tipoLabel = $esTaller ? 'Taller' : 'Curso';
                $tipoColor = $esTaller ? '#7c3aed' : '#005fff';
                $tipoIcon  = $esTaller ? 'fa-chalkboard-user' : 'fa-graduation-cap';
                $hasLanza  = isset($value['lanzamiento_costo']);
            ?>

            <div class="col-12 col-md-6 col-lg-4 item-card" data-tipo="<?= $value['curso_tipo'] ?>">
                <div class="card border-0 shadow-sm h-100 position-relative"
                     style="border-radius:14px; overflow:hidden; transition: transform .25s, box-shadow .25s;"
                     onmouseenter="this.style.transform='translateY(-5px)';this.style.boxShadow='0 16px 40px rgba(0,0,0,.14)'"
                     onmouseleave="this.style.transform='';this.style.boxShadow=''">

                    <!-- Image wrapper -->
                    <div style="height:250px; overflow:hidden; position:relative; background:#dde0e6;">
                        <img src="<?= $assets_url ?>/admin/images/cursos/<?= ($value['curso_img_main'] == '') ? 'sin_imagen.jpg' : $value['curso_img_main'] ?>"
                             alt="<?= htmlspecialchars($value['curso_nombre']) ?>"
                             style="width:100%; height:100%; object-fit:cover; object-position:center; display:block;">

                        <!-- Tipo badge — top left -->
                        <div style="position:absolute; top:14px; left:14px; background:<?= $tipoColor ?>; color:#fff;
                                    border-radius:8px; padding:5px 13px; font-weight:800; font-size:12px;
                                    box-shadow:0 2px 8px rgba(0,0,0,.22); text-transform:uppercase; letter-spacing:.8px;">
                            <i class="fa-solid <?= $tipoIcon ?> me-1"></i><?= $tipoLabel ?>
                        </div>

                        <?php if ($hasLanza): ?>
                        <!-- Price badge — solo cuando hay lanzamiento activo -->
                        <div style="position:absolute; bottom:14px; left:14px; background:#005fff; color:#fff;
                                    border-radius:12px; padding:10px 20px; line-height:1.2;
                                    box-shadow:0 4px 16px rgba(0,0,0,.35);">
                            <small style="display:block; font-size:11px; font-weight:800; opacity:.85; letter-spacing:1.5px; text-transform:uppercase;">Inversión</small>
                            <span style="font-size:26px; font-weight:900; display:block; letter-spacing:-0.5px;">S/ <?= $value['lanzamiento_costo'] ?></span>
                        </div>
                        <?php endif; ?>

                        <!-- Premium badge — top right -->
                        <div style="position:absolute; top:14px; right:14px; background:#05b848; color:#fff;
                                    border-radius:8px; padding:6px 14px; font-weight:800; font-size:12px;
                                    box-shadow:0 2px 8px rgba(0,0,0,.2); text-transform:uppercase; letter-spacing:1px;">
                            <i class="fa-solid fa-star me-1"></i> Premium
                        </div>
                    </div>

                    <!-- Card body -->
                    <div class="card-body d-flex flex-column p-4">
                        <a href="<?= $base_url ?>/cursos/ver/<?= $value['curso_id'] ?>" class="text-decoration-none stretched-link">
                            <h5 class="fw-700 mb-3" style="font-size:1.18rem; color:#1a1a1a; line-height:1.35;"><?= htmlspecialchars($value['curso_nombre']) ?></h5>
                        </a>

                        <!-- Meta rows -->
                        <div class="d-flex flex-column gap-2 mb-3 flex-grow-1">

                            <?php if ($hasLanza): ?>

                            <!-- Duración — solo con lanzamiento -->
                            <div class="d-flex align-items-center gap-3">
                                <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:38px;height:38px;border-radius:10px;background:rgba(0,95,255,.12);color:#005fff;font-size:16px;">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <div>
                                    <div style="font-size:11px;font-weight:800;color:#888;text-transform:uppercase;letter-spacing:1px;margin-bottom:2px;">Duración</div>
                                    <span style="font-size:15px;color:#333;font-weight:600;"><?= $value['lanz_duracion'] ?></span>
                                </div>
                            </div>

                            <!-- Matrícula abierta -->
                            <div class="d-flex align-items-center gap-3 mt-1">
                                <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:38px;height:38px;border-radius:10px;background:rgba(5,184,72,.12);color:#05b848;font-size:16px;">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </span>
                                <div>
                                    <div style="font-size:11px;font-weight:800;color:#888;text-transform:uppercase;letter-spacing:1px;margin-bottom:2px;">Matrícula</div>
                                    <span style="font-size:15px;color:#05b848;font-weight:700;">Abierta</span>
                                </div>
                            </div>

                            <?php else: ?>

                            <!-- Próximamente — sin lanzamiento activo -->
                            <div class="d-flex align-items-center gap-3 mt-1">
                                <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:38px;height:38px;border-radius:10px;background:rgba(245,158,11,.12);color:#d97706;font-size:16px;">
                                    <i class="fa-solid fa-hourglass-half"></i>
                                </span>
                                <div>
                                    <div style="font-size:11px;font-weight:800;color:#888;text-transform:uppercase;letter-spacing:1px;margin-bottom:2px;">Disponibilidad</div>
                                    <span style="font-size:15px;color:#d97706;font-weight:700;">Próximamente</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 mt-1">
                                <span class="d-flex align-items-center justify-content-center flex-shrink-0"
                                      style="width:38px;height:38px;border-radius:10px;background:rgba(124,58,237,.1);color:#7c3aed;font-size:16px;">
                                    <i class="fa-solid fa-bell"></i>
                                </span>
                                <div>
                                    <div style="font-size:11px;font-weight:800;color:#888;text-transform:uppercase;letter-spacing:1px;margin-bottom:2px;">Inscripciones</div>
                                    <span style="font-size:15px;color:#7c3aed;font-weight:700;">Apertura muy pronto</span>
                                </div>
                            </div>

                            <?php endif; ?>

                        </div>

                        <!-- CTA -->
                        <div class="d-grid mt-3">
                            <?php if ($hasLanza): ?>
                            <a href="<?= $base_url ?>/cursos/ver/<?= $value['curso_id'] ?>" class="btn btn-dark fw-700 position-relative z-3"
                               style="border-radius:10px; letter-spacing:.6px; font-size:15px; padding:13px 20px;">
                                INSCRÍBETE AHORA <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                            <?php else: ?>
                            <a href="<?= $base_url ?>/cursos/ver/<?= $value['curso_id'] ?>" class="btn fw-700 position-relative z-3"
                               style="border-radius:10px; letter-spacing:.6px; font-size:15px; padding:13px 20px;
                                      border: 2px solid #1a1a1a; color:#1a1a1a; background:transparent;">
                                VER PROGRAMA <i class="fa-solid fa-book-open ms-2"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

            <?php endforeach; ?>

            <?php if (empty($cursos)): ?>
                <div class="col-12 text-center py-5 text-muted fs-5">
                    No hay cursos ni talleres disponibles. Muy pronto estarán disponibles.
                </div>
            <?php endif; ?>

        </div>

        <!-- Empty state per filter (JS injected) -->
        <div id="empty-filter" class="text-center py-5 text-muted fs-5 d-none">
            No hay resultados para este filtro.
        </div>

        <!-- Pagination -->
        <div id="cursos_pagination" class="mt-4"></div>

    </div>
</section>
