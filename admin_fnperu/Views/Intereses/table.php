
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fa-solid fa-bell bg-warning"></i>
                                </div>
                                <div>
                                    <span class="fw-500"><?= $page_title ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-lg-3">
                            <div class="card border-0 shadow-sm text-center py-3" style="border-radius:12px; border-left:4px solid #6c757d !important;">
                                <div style="font-size:2rem; font-weight:900; color:#6c757d;"><?= $stats['total'] ?></div>
                                <div style="font-size:.82rem; font-weight:700; color:#999; text-transform:uppercase; letter-spacing:.8px;">Total</div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="card border-0 shadow-sm text-center py-3" style="border-radius:12px; border-left:4px solid #f59e0b !important;">
                                <div style="font-size:2rem; font-weight:900; color:#d97706;"><?= $stats['0'] ?></div>
                                <div style="font-size:.82rem; font-weight:700; color:#999; text-transform:uppercase; letter-spacing:.8px;">Pendientes</div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="card border-0 shadow-sm text-center py-3" style="border-radius:12px; border-left:4px solid #0d6efd !important;">
                                <div style="font-size:2rem; font-weight:900; color:#0d6efd;"><?= $stats['1'] ?></div>
                                <div style="font-size:.82rem; font-weight:700; color:#999; text-transform:uppercase; letter-spacing:.8px;">Contactados</div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="card border-0 shadow-sm text-center py-3" style="border-radius:12px; border-left:4px solid #198754 !important;">
                                <div style="font-size:2rem; font-weight:900; color:#198754;"><?= $stats['2'] ?></div>
                                <div style="font-size:.82rem; font-weight:700; color:#999; text-transform:uppercase; letter-spacing:.8px;">Matriculados</div>
                            </div>
                        </div>
                    </div>

                    <style>
                        [data-tipo-filter].active { opacity:1 !important; }
                        [data-tipo-filter=""].active  { background:#6c757d !important; border-color:#6c757d !important; color:#fff !important; }
                        [data-tipo-filter="0"].active { background:#0d6efd !important; border-color:#0d6efd !important; color:#fff !important; }
                        [data-tipo-filter="1"].active { background:#7c3aed !important; border-color:#7c3aed !important; color:#fff !important; }
                    </style>

                    <!-- Filtros -->
                    <div class="mb-3 d-flex gap-3 flex-wrap align-items-center">
                        <div class="d-flex gap-2 align-items-center flex-wrap">
                            <span class="fw-700 text-dark me-1" style="font-size:.88rem;">FILTRAR POR TIPO:</span>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill fw-600 active" data-tipo-filter="" style="min-width:80px;">
                                <i class="fa-solid fa-th-large me-1"></i> Todos
                            </button>
                            <button class="btn btn-sm btn-outline-primary rounded-pill fw-600" data-tipo-filter="0" style="min-width:80px;">
                                <i class="fa-solid fa-graduation-cap me-1"></i> Cursos
                            </button>
                            <button class="btn btn-sm rounded-pill fw-600" data-tipo-filter="1"
                                    style="min-width:80px; border:1px solid #7c3aed; color:#7c3aed; background:transparent;">
                                <i class="fa-solid fa-chalkboard-user me-1"></i> Talleres
                            </button>
                        </div>

                        <div class="d-flex gap-2 align-items-center">
                            <span class="fw-700 text-dark" style="font-size:.88rem; white-space:nowrap;">FILTRAR POR CURSO:</span>
                            <select id="filtro_curso" class="form-select form-select-sm" style="min-width:260px; max-width:380px;">
                                <option value="">— Todos —</option>
                            </select>
                        </div>
                    </div>

                    <div class="app-main__content">
                        <table id="intereses_table" class="table table-hover table-striped table-bordered table_base table_action w-100">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>TIPO</th>
                                    <th>CURSO / TALLER</th>
                                    <th>NOMBRE</th>
                                    <th>EMAIL</th>
                                    <th>TELÉFONO</th>
                                    <th>FECHA</th>
                                    <th>ESTADO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal detalle / cambiar estado -->
    <div class="modal fade bayer_modal" id="modal_interes_edit" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">DETALLE DE INTERÉS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="from_interes_edit" autocomplete="off">
                        <input type="hidden" id="interes_id_edit" name="interes_id">

                        <div class="row mx-0">
                            <div class="mb-3 col-12 px-2">
                                <label class="form-label fw-500 text-black mb-1">CURSO / TALLER:</label>
                                <input type="text" class="form-control form-control-sm" id="curso_edit" disabled>
                            </div>
                            <div class="mb-3 col-12 col-md-6 px-2">
                                <label class="form-label fw-500 text-black mb-1">NOMBRE:</label>
                                <input type="text" class="form-control form-control-sm" id="nombre_edit" disabled>
                            </div>
                            <div class="mb-3 col-12 col-md-6 px-2">
                                <label class="form-label fw-500 text-black mb-1">EMAIL:</label>
                                <input type="text" class="form-control form-control-sm" id="email_edit" disabled>
                            </div>
                            <div class="mb-3 col-12 col-md-4 px-2">
                                <label class="form-label fw-500 text-black mb-1">TELÉFONO:</label>
                                <input type="text" class="form-control form-control-sm" id="telefono_edit" disabled>
                            </div>
                            <div class="mb-3 col-12 col-md-4 px-2">
                                <label class="form-label fw-500 text-black mb-1">FECHA DE REGISTRO:</label>
                                <input type="text" class="form-control form-control-sm" id="creacion_edit" disabled>
                            </div>
                            <div class="mb-3 col-12 col-md-4 px-2">
                                <label class="form-label fw-500 text-black mb-1">ESTADO:</label>
                                <select class="form-select form-select-sm" id="estado_edit" name="estado">
                                    <option value="0">⏳ Pendiente</option>
                                    <option value="1">📞 Contactado</option>
                                    <option value="2">✅ Matriculado</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2 px-2">
                            <button type="button" class="btn btn-danger btn-sm rounded" id="btn_delete_interes">
                                <i class="fa-solid fa-trash-can me-1"></i> Eliminar
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm rounded">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-white border border-primary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
