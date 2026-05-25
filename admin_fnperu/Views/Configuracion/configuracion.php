
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fa-solid fa-sliders bg-plum-plate"></i>
                                </div>
                                <div>
                                    <span class="fw-500">Configuraciones Web</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="app-main__content">
                        <div class="row">

                            <!-- ===== Datos de Contacto ===== -->
                            <div class="col-12 col-lg-7 mb-3">
                                <div class="main-card mb-3 card">
                                    <div class="card-header d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-address-card text-primary me-1"></i>
                                        <strong>Datos de Contacto</strong>
                                    </div>
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label class="form-label fw-500">Correo electrónico</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                                <input type="email" class="form-control config-text-input"
                                                       id="input_contacto_email"
                                                       data-key="contacto_email"
                                                       value="<?= htmlspecialchars($config['contacto_email']['config_value'] ?? '') ?>">
                                                <button class="btn btn-primary btn-config-save" type="button"
                                                        data-key="contacto_email" data-target="input_contacto_email">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-500">Teléfono 1</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                                <input type="text" class="form-control config-text-input"
                                                       id="input_contacto_telefono_1"
                                                       data-key="contacto_telefono_1"
                                                       value="<?= htmlspecialchars($config['contacto_telefono_1']['config_value'] ?? '') ?>">
                                                <button class="btn btn-primary btn-config-save" type="button"
                                                        data-key="contacto_telefono_1" data-target="input_contacto_telefono_1">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-500">Teléfono 2</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                                <input type="text" class="form-control config-text-input"
                                                       id="input_contacto_telefono_2"
                                                       data-key="contacto_telefono_2"
                                                       value="<?= htmlspecialchars($config['contacto_telefono_2']['config_value'] ?? '') ?>">
                                                <button class="btn btn-primary btn-config-save" type="button"
                                                        data-key="contacto_telefono_2" data-target="input_contacto_telefono_2">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-0">
                                            <label class="form-label fw-500">Dirección</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                                <input type="text" class="form-control config-text-input"
                                                       id="input_contacto_direccion"
                                                       data-key="contacto_direccion"
                                                       value="<?= htmlspecialchars($config['contacto_direccion']['config_value'] ?? '') ?>">
                                                <button class="btn btn-primary btn-config-save" type="button"
                                                        data-key="contacto_direccion" data-target="input_contacto_direccion">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- ===== Campus Virtual ===== -->
                            <div class="col-12 col-lg-5 mb-3">
                                <div class="main-card mb-3 card">
                                    <div class="card-header d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-graduation-cap text-primary me-1"></i>
                                        <strong>Campus Virtual</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between gap-3">
                                            <div>
                                                <p class="mb-1 fw-500">Mostrar botón en la web</p>
                                                <small class="text-muted">
                                                    Desactívalo cuando el campus no esté disponible.
                                                    Oculta el botón en el encabezado y el hero del sitio público.
                                                </small>
                                            </div>
                                            <div class="form-check form-switch fs-4 mb-0 flex-shrink-0">
                                                <input class="form-check-input config-toggle"
                                                       type="checkbox"
                                                       role="switch"
                                                       id="toggle_campus_virtual_visible"
                                                       data-key="campus_virtual_visible"
                                                       <?= (isset($config['campus_virtual_visible']) && $config['campus_virtual_visible']['config_value'] == 1) ? 'checked' : '' ?>>
                                                <label class="form-check-label visually-hidden"
                                                       for="toggle_campus_virtual_visible">Campus Virtual</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
