
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fa-solid fa-images bg-primary"></i>
                                </div>
                                <div>
                                    <span class="fw-500"><?= $page_title ?></span>
                                    <div class="page-title-subheading" style="font-size:.82rem; color:#888;">
                                        Gestión de imágenes para los heroes del sitio
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-4" id="bannerTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-600" id="tab-home-btn" data-bs-toggle="tab" data-bs-target="#tab-home" type="button" role="tab">
                                <i class="fa-solid fa-house me-1"></i> Hero Home
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-600" id="tab-urb-btn" data-bs-toggle="tab" data-bs-target="#tab-urb" type="button" role="tab">
                                <i class="fa-solid fa-house-flag me-1"></i> Urbanizaciones
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-600" id="tab-cursos-btn" data-bs-toggle="tab" data-bs-target="#tab-cursos" type="button" role="tab">
                                <i class="fa-solid fa-graduation-cap me-1"></i> Cursos y Talleres
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="bannerTabsContent">

                        <!-- ===== TAB HERO HOME — tabla ===== -->
                        <div class="tab-pane fade show active" id="tab-home" role="tabpanel">

                            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px; border-left:4px solid #6f42c1 !important;">
                                <div class="card-body py-3 px-4">
                                    <p class="fw-700 mb-2" style="font-size:.9rem;"><i class="fa-solid fa-upload me-1" style="color:#6f42c1;"></i> SUBIR IMAGEN — HERO HOME</p>
                                    <p class="text-muted mb-2" style="font-size:.8rem;">Acepta cualquier tamaño y proporción &nbsp;|&nbsp; JPG / PNG / WebP &nbsp;|&nbsp; Máx. 5 MB</p>
                                    <form id="form_slot_home" enctype="multipart/form-data" class="d-flex gap-3 align-items-end flex-wrap">
                                        <div>
                                            <label class="form-label mb-1" style="font-size:.78rem; font-weight:600;">Slide</label>
                                            <select name="slot" class="form-select form-select-sm" style="max-width:160px;">
                                                <option value="0">Slide 1</option>
                                                <option value="2">Slide 3</option>
                                            </select>
                                        </div>
                                        <div>
                                            <input type="file" class="form-control form-control-sm" name="banner_img" accept="image/jpeg,image/png,image/webp" required style="max-width:320px;">
                                        </div>
                                        <button type="submit" class="btn btn-sm px-4 fw-600" style="background:#6f42c1;color:#fff;">
                                            <i class="fa-solid fa-floppy-disk me-1"></i> Subir
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="app-main__content">
                                <table id="banners_table_2" class="table table-hover table-striped table-bordered table_base w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:8%">SLIDE</th>
                                            <th style="width:22%">PREVIEW</th>
                                            <th style="width:28%">ARCHIVO</th>
                                            <th style="width:12%">ESTADO</th>
                                            <th style="width:17%">FECHA</th>
                                            <th style="width:13%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        </div>

                        <!-- ===== TAB URBANIZACIONES ===== -->
                        <div class="tab-pane fade" id="tab-urb" role="tabpanel">

                            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px; border-left:4px solid #f5c518 !important;">
                                <div class="card-body py-3 px-4">
                                    <p class="fw-700 mb-2" style="font-size:.9rem;"><i class="fa-solid fa-upload me-1 text-warning"></i> SUBIR NUEVO BANNER — URBANIZACIONES</p>
                                    <p class="text-muted mb-2" style="font-size:.8rem;">1920 × 640 px &nbsp;|&nbsp; Proporción 3:1 &nbsp;|&nbsp; JPG / PNG &nbsp;|&nbsp; Máx. 5 MB</p>
                                    <form id="form_subir_1" enctype="multipart/form-data" class="d-flex gap-3 align-items-end flex-wrap">
                                        <input type="hidden" name="seccion" value="1">
                                        <div>
                                            <input type="file" class="form-control form-control-sm" name="banner_img" accept="image/jpeg,image/png" required style="max-width:320px;">
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-sm px-4 fw-600 text-dark">
                                            <i class="fa-solid fa-floppy-disk me-1"></i> Subir Banner
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="app-main__content">
                                <table id="banners_table_1" class="table table-hover table-striped table-bordered table_base w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:4%">N°</th>
                                            <th style="width:22%">PREVIEW</th>
                                            <th style="width:33%">ARCHIVO</th>
                                            <th style="width:12%">ESTADO</th>
                                            <th style="width:16%">FECHA</th>
                                            <th style="width:13%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- ===== TAB CURSOS Y TALLERES ===== -->
                        <div class="tab-pane fade" id="tab-cursos" role="tabpanel">

                            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px; border-left:4px solid #0d6efd !important;">
                                <div class="card-body py-3 px-4">
                                    <p class="fw-700 mb-2" style="font-size:.9rem;"><i class="fa-solid fa-upload me-1 text-primary"></i> SUBIR NUEVO BANNER — CURSOS Y TALLERES</p>
                                    <p class="text-muted mb-2" style="font-size:.8rem;">1920 × 640 px &nbsp;|&nbsp; Proporción 3:1 &nbsp;|&nbsp; JPG / PNG &nbsp;|&nbsp; Máx. 5 MB</p>
                                    <form id="form_subir_0" enctype="multipart/form-data" class="d-flex gap-3 align-items-end flex-wrap">
                                        <input type="hidden" name="seccion" value="0">
                                        <div>
                                            <input type="file" class="form-control form-control-sm" name="banner_img" accept="image/jpeg,image/png" required style="max-width:320px;">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-600">
                                            <i class="fa-solid fa-floppy-disk me-1"></i> Subir Banner
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="app-main__content">
                                <table id="banners_table_0" class="table table-hover table-striped table-bordered table_base w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:4%">N°</th>
                                            <th style="width:22%">PREVIEW</th>
                                            <th style="width:33%">ARCHIVO</th>
                                            <th style="width:12%">ESTADO</th>
                                            <th style="width:16%">FECHA</th>
                                            <th style="width:13%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                    </div><!-- /tab-content -->

                </div>
            </div>
        </div>
    </div>
