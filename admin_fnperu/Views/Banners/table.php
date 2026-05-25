
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
                                        Tamaño recomendado: <strong>1920 × 640 px</strong> &nbsp;|&nbsp; Proporción: <strong>3:1</strong> &nbsp;|&nbsp; Formatos: JPG / PNG &nbsp;|&nbsp; Máx. 5 MB
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Sección -->
                    <ul class="nav nav-tabs mb-4" id="bannerTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-600" id="tab-cursos-btn" data-bs-toggle="tab" data-bs-target="#tab-cursos" type="button" role="tab">
                                <i class="fa-solid fa-graduation-cap me-1"></i> Cursos y Talleres
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-600" id="tab-urb-btn" data-bs-toggle="tab" data-bs-target="#tab-urb" type="button" role="tab">
                                <i class="fa-solid fa-house-flag me-1"></i> Urbanizaciones
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="bannerTabsContent">

                        <!-- ===== TAB CURSOS ===== -->
                        <div class="tab-pane fade show active" id="tab-cursos" role="tabpanel">

                            <!-- Upload card -->
                            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px; border-left:4px solid #0d6efd !important;">
                                <div class="card-body py-3 px-4">
                                    <p class="fw-700 mb-2" style="font-size:.9rem;"><i class="fa-solid fa-upload me-1 text-primary"></i> SUBIR NUEVO BANNER — CURSOS Y TALLERES</p>
                                    <form id="form_subir_0" enctype="multipart/form-data" class="d-flex gap-3 align-items-end flex-wrap">
                                        <input type="hidden" name="seccion" value="0">
                                        <div>
                                            <label class="form-label fw-500 mb-1" style="font-size:.82rem;">Imagen (JPG / PNG · 1920×640 px · 3:1)</label>
                                            <input type="file" class="form-control form-control-sm" name="banner_img" accept="image/jpeg,image/png" required style="max-width:320px;">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-600">
                                            <i class="fa-solid fa-floppy-disk me-1"></i> Subir Banner
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Table -->
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

                        <!-- ===== TAB URBANIZACIONES ===== -->
                        <div class="tab-pane fade" id="tab-urb" role="tabpanel">

                            <!-- Upload card -->
                            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px; border-left:4px solid #f5c518 !important;">
                                <div class="card-body py-3 px-4">
                                    <p class="fw-700 mb-2" style="font-size:.9rem;"><i class="fa-solid fa-upload me-1 text-warning"></i> SUBIR NUEVO BANNER — URBANIZACIONES</p>
                                    <form id="form_subir_1" enctype="multipart/form-data" class="d-flex gap-3 align-items-end flex-wrap">
                                        <input type="hidden" name="seccion" value="1">
                                        <div>
                                            <label class="form-label fw-500 mb-1" style="font-size:.82rem;">Imagen (JPG / PNG · 1920×640 px · 3:1)</label>
                                            <input type="file" class="form-control form-control-sm" name="banner_img" accept="image/jpeg,image/png" required style="max-width:320px;">
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-sm px-4 fw-600 text-dark">
                                            <i class="fa-solid fa-floppy-disk me-1"></i> Subir Banner
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Table -->
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

                    </div><!-- /tab-content -->

                </div>
            </div>
        </div>
    </div>
