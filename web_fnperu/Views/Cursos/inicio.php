<!-- ===== Hero Section ===== -->
<section class="hero-section">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5500" data-bs-pause="hover">

        <!-- Indicators -->
        <div class="carousel-indicators hero-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Carousel Inner -->
        <div class="carousel-inner h-100">

            <!-- Slide 1 -->
            <div class="carousel-item active hero-slide hero-slide-fallback">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fa-solid fa-award"></i>
                        <span>N° 1 en Nueva Cajamarca</span>
                    </div>
                    <h1 class="hero-title">
                        La <span class="accent">#1</span> en Habilitaciones Urbanas en la Selva Peruana
                    </h1>
                    <p class="hero-subtitle">
                        Transformamos terrenos en sueños. Más de 500 familias ya confían en F&N Constructores S.A.C. para hacer realidad sus proyectos de vivienda.
                    </p>
                    <div class="hero-cta-group">
                        <a href="<?= $base_url ?>/urbanizaciones" class="hero-cta hero-cta-primary">
                            <i class="fa-solid fa-building"></i> Ver Urbanizaciones
                        </a>
                        <a href="<?= $base_url ?>/cursos" class="hero-cta hero-cta-secondary">
                            <i class="fa-solid fa-graduation-cap"></i> Ver Cursos
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-number">500+</span>
                            <span class="hero-stat-label">Familias</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="hero-stat-number">10+</span>
                            <span class="hero-stat-label">Proyectos</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="hero-stat-number">8</span>
                            <span class="hero-stat-label">Años</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item hero-slide hero-slide-fallback">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fa-solid fa-city"></i>
                        <span>Líderes en Desarrollo Urbano</span>
                    </div>
                    <h1 class="hero-title">
                        Expertos en Desarrollo Urbano desde <span class="accent">2015</span>
                    </h1>
                    <p class="hero-subtitle">
                        Proyectos que impulsan el crecimiento de la Amazonía peruana con infraestructura de calidad, planificación sostenible y el respaldo de ingenieros especializados.
                    </p>
                    <div class="hero-cta-group">
                        <a href="<?= $base_url ?>/urbanizaciones" class="hero-cta hero-cta-primary">
                            <i class="fa-solid fa-map-location-dot"></i> Conoce Nuestras Obras
                        </a>
                        <a href="https://wa.me/51990252507?text=Hola,%20quiero%20información%20sobre%20urbanizaciones" target="_blank" class="hero-cta hero-cta-secondary">
                            <i class="fa-brands fa-whatsapp"></i> Contactar Ahora
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-number">100%</span>
                            <span class="hero-stat-label">Compromiso</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="hero-stat-number">15+</span>
                            <span class="hero-stat-label">Hectáreas</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="hero-stat-number">24/7</span>
                            <span class="hero-stat-label">Soporte</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item hero-slide hero-slide-escuela">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fa-solid fa-book-open"></i>
                        <span>Aprende con los Mejores</span>
                    </div>
                    <h1 class="hero-title">
                        Capacitación Profesional de <span class="accent">Alto Nivel</span>
                    </h1>
                    <p class="hero-subtitle">
                        Cursos y talleres especializados dictados por ingenieros con años de experiencia. Certificación física y digital para impulsar tu carrera.
                    </p>
                    <div class="hero-cta-group">
                        <a href="<?= $base_url ?>/cursos" class="hero-cta hero-cta-primary">
                            <i class="fa-solid fa-graduation-cap"></i> Ver Cursos
                        </a>
                        <?php if (!empty($web_config['campus_virtual_visible'])) { ?>
                        <a href="<?= $base_url ?>/campus" target="_blank" class="hero-cta hero-cta-secondary">
                            <i class="fa-solid fa-university"></i> Campus Virtual
                        </a>
                        <?php } ?>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-number">50+</span>
                            <span class="hero-stat-label">Cursos</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="hero-stat-number">1000+</span>
                            <span class="hero-stat-label">Alumnos</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="hero-stat-number">100%</span>
                            <span class="hero-stat-label">Online</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev hero-control hero-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="hero-control-icon"><i class="fa-solid fa-chevron-left"></i></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next hero-control hero-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="hero-control-icon"><i class="fa-solid fa-chevron-right"></i></span>
            <span class="visually-hidden">Siguiente</span>
        </button>

    </div>
</section>


<!-- ===== Sección Sobre Nosotros ===== -->
<section class="about-section py-5">
    <div class="container">

        <!-- Header Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <span class="about-label animate__animated animate__fadeInDown">Sobre Nosotros</span>
                <h2 class="about-title animate__animated animate__fadeInUp">
                    Líderes en Habilitaciones Urbanas en la <span class="text-accent">Selva Peruana</span>
                </h2>
                <p class="about-text-lead animate__animated animate__fadeInUp animate__delay-1s">
                    Transformamos terrenos en sueños. Más de 8 años construyendo comunidades con infraestructura de calidad en Nueva Cajamarca y la Amazonía peruana.
                </p>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="row g-4 mb-5">
            <div class="col-6 col-lg-3">
                <div class="about-stat-card text-center animate__animated animate__fadeInUp" data-delay="0">
                    <div class="about-stat-icon">
                        <i class="fa-solid fa-house-chimney"></i>
                    </div>
                    <div class="about-stat-number">500+</div>
                    <div class="about-stat-label">Familias Confían</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="about-stat-card text-center animate__animated animate__fadeInUp" data-delay="100">
                    <div class="about-stat-icon">
                        <i class="fa-solid fa-city"></i>
                    </div>
                    <div class="about-stat-number">10+</div>
                    <div class="about-stat-label">Proyectos</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="about-stat-card text-center animate__animated animate__fadeInUp" data-delay="200">
                    <div class="about-stat-icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="about-stat-number">8+</div>
                    <div class="about-stat-label">Años Experiencia</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="about-stat-card text-center animate__animated animate__fadeInUp" data-delay="300">
                    <div class="about-stat-icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="about-stat-number">1000+</div>
                    <div class="about-stat-label">Alumnos Capacitados</div>
                </div>
            </div>
        </div>

        <!-- Feature Cards Grid -->
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="about-card animate__animated animate__fadeInUp" data-delay="0">
                    <div class="about-card-icon">
                        <i class="fa-solid fa-file-shield"></i>
                    </div>
                    <h5 class="about-card-title">Proyectos Certificados</h5>
                    <p class="about-card-text">Documentación legal y técnica completa para cada proyecto.</p>
                    <div class="about-card-hover"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="about-card animate__animated animate__fadeInUp" data-delay="100">
                    <div class="about-card-icon">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <h5 class="about-card-title">Equipo Profesional</h5>
                    <p class="about-card-text">Ingenieros y arquitectos especializados en desarrollo urbano.</p>
                    <div class="about-card-hover"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="about-card animate__animated animate__fadeInUp" data-delay="200">
                    <div class="about-card-icon">
                        <i class="fa-solid fa-road"></i>
                    </div>
                    <h5 class="about-card-title">Infraestructura</h5>
                    <p class="about-card-text">Servicios básicos, vías pavimentadas y áreas verdes.</p>
                    <div class="about-card-hover"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="about-card animate__animated animate__fadeInUp" data-delay="300">
                    <div class="about-card-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h5 class="about-card-title">Atención 24/7</h5>
                    <p class="about-card-text">Acompañamiento desde la consulta hasta la entrega de tu lote.</p>
                    <div class="about-card-hover"></div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center animate__animated animate__fadeInUp animate__delay-1s">
            <a href="<?= $base_url ?>/nosotros" class="btn btn-about-primary">
                <i class="fa-solid fa-arrow-right"></i> Conocer Más Sobre Nosotros
            </a>
        </div>

    </div>
</section>

<!-- ===== Sección Call to Action (Parallax Relacional) ===== -->
<section class="parallax-cta-section" style="background-image: url('<?= $assets_url ?>/admin/images/general/fondo_banner_2.png');">
    <div class="parallax-cta-overlay"></div>
    <div class="parallax-cta-container">
        <div class="parallax-cta-content">
            <span class="parallax-cta-tag animate__animated animate__fadeInUp">PROYECTANDO EL FUTURO</span>
            <h2 class="parallax-cta-title animate__animated animate__fadeInUp">Construimos Hogares, Formamos Profesionales</h2>
            <p class="parallax-cta-desc animate__animated animate__fadeInUp">
                Impulsamos el desarrollo integral de la Amazonía peruana a través de habilitaciones urbanas sostenibles y educación de alto nivel en ingeniería y arquitectura.
            </p>
            <div class="parallax-cta-buttons animate__animated animate__fadeInUp">
                <a href="<?= $base_url ?>/urbanizaciones" class="btn-parallax btn-parallax-primary">
                    <i class="fa-solid fa-map-location-dot"></i> Conocer Urbanizaciones
                </a>
                <a href="<?= $base_url ?>/cursos" class="btn-parallax btn-parallax-secondary">
                    <i class="fa-solid fa-graduation-cap"></i> Explorar Cursos y Talleres
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== Sección de Nubes (Transición) ===== -->
<section class="antes_footer cta-to-footer-divider">
    <div class="elementor-shape elementor-shape-top element_nubes" data-negative="false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="xMidYMax slice">
            <path class="elementor-shape-fill" d="M0 0v6.7c1.9-.8 4.7-1.4 8.5-1 9.5 1.1 11.1 6 11.1 6s2.1-.7 4.3-.2c2.1.5 2.8 2.6 2.8 2.6s.2-.5 1.4-.7c1.2-.2 1.7.2 1.7.2s0-2.1 1.9-2.8c1.9-.7 3.6.7 3.6.7s.7-2.9 3.1-4.1 4.7 0 4.7 0 1.2-.5 2.4 0 1.7 1.4 1.7 1.4h1.4c.7 0 1.2.7 1.2.7s.8-1.8 4-2.2c3.5-.4 5.3 2.4 6.2 4.4.4-.4 1-.7 1.8-.9 2.8-.7 4 .7 4 .7s1.7-5 11.1-6c9.5-1.1 12.3 3.9 12.3 3.9s1.2-4.8 5.7-5.7c4.5-.9 6.8 1.8 6.8 1.8s.6-.6 1.5-.9c.9-.2 1.9-.2 1.9-.2s5.2-6.4 12.6-3.3c7.3 3.1 4.7 9 4.7 9s1.9-.9 4 0 2.8 2.4 2.8 2.4 1.9-1.2 4.5-1.2 4.3 1.2 4.3 1.2.2-1 1.4-1.7 2.1-.7 2.1-.7-.5-3.1 2.1-5.5 5.7-1.4 5.7-1.4 1.5-2.3 4.2-1.1c2.7 1.2 1.7 5.2 1.7 5.2s.3-.1 1.3.5c.5.4.8.8.9 1.1.5-1.4 2.4-5.8 8.4-4 7.1 2.1 3.5 8.9 3.5 8.9s.8-.4 2 0 1.1 1.1 1.1 1.1 1.1-1.1 2.3-1.1 2.1.5 2.1.5 1.9-3.6 6.2-1.2 1.9 6.4 1.9 6.4 2.6-2.4 7.4 0c3.4 1.7 3.9 4.9 3.9 4.9s3.3-6.9 10.4-7.9 11.5 2.6 11.5 2.6.8 0 1.2.2c.4.2.9.9.9.9s4.4-3.1 8.3.2c1.9 1.7 1.5 5 1.5 5s.3-1.1 1.6-1.4c1.3-.3 2.3.2 2.3.2s-.1-1.2.5-1.9 1.9-.9 1.9-.9-4.7-9.3 4.4-13.4c5.6-2.5 9.2.9 9.2.9s5-6.2 15.9-6.2 16.1 8.1 16.1 8.1.7-.2 1.6-.4V0H0z"></path>
        </svg>
    </div>
</section>

<div class="antes_footer">
    <div class="contaner_general d-flex">

        <div class="why_fnperu">
            <p class="title">¿POR QUE FN PERÚ?</p>
            <div class="border_line"></div>
            <p class="text">Somos un grupo de profesionales capacitados en el área de la ingeniería y nuestra pasión es enseñar, capacitar e innovar, temas relacionados con la ingeniería y arquitectura. Nuestra institución no sólo se preocupa por brindar la mejor formación profesional, sino que también se centra en fomentar los valores que hagan de cada miembro de la comunidad</p>
            <div class="text-center">
                <a class="btn_cursos" href="<?= $base_url ?>/cursos">CURSOS</a>
                <a class="btn_talleres" href="<?= $base_url ?>/talleres">TALLERES</a>
            </div>
        </div>

        <div class="why_cualidades">

            <div class="cualidad">
                <div class="uael-icon-wrap elementor-animation- elemt_icon mx-auto">
					<span class="uael-icon">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.924 489.924" style="enable-background:new 0 0 489.924 489.924;" xml:space="preserve">
                            <g>
                                <path d="M440.018,160.014c-2.253-5.164-8.244-7.547-13.438-5.284c-5.164,2.253-7.537,8.268-5.284,13.438   c31.791,73.002,15.95,156.549-40.364,212.858c-36.326,36.326-84.625,56.334-135.994,56.334c-44.846,0-87.351-15.253-121.594-43.297   l72.039-15.429c5.513-1.182,9.032-6.61,7.846-12.122c-1.186-5.513-6.65-9.037-12.112-7.846L99.584,378.27   c-5.513,1.181-9.032,6.61-7.846,12.122l19.599,91.539c2.34,9.22,11.057,8.027,12.113,7.846c5.127-0.879,9.031-6.61,7.845-12.122   l-13.229-61.809c36.477,27.214,80.543,41.931,126.873,41.931c56.822,0,110.245-22.131,150.43-62.315   C457.663,333.181,475.188,240.766,440.018,160.014z"></path>
                                <path d="M108.985,108.988c70.354-70.358,182.099-74.693,257.583-13.033l-72.034,15.426c-5.513,1.181-9.031,6.61-7.845,12.122   c1.027,4.79,5.253,8.069,9.968,8.069c0.556,0.794,93.687-19.828,93.687-19.828c7.884-1.783,8.414-9.475,7.845-12.122L378.58,8.085   c-1.176-5.508-6.629-9.062-12.112-7.846c-5.512,1.181-9.032,6.61-7.846,12.122l13.247,61.857   c-83.248-61.934-201.831-55.163-277.32,20.336c-62.285,62.279-79.811,154.7-44.65,235.453c1.674,3.843,6.299,7.987,13.438,5.284   c4.922-1.863,7.537-8.27,5.284-13.438C36.83,248.85,52.671,165.297,108.985,108.988z"></path>
                                <path d="M149.032,247.818l-32.4,32.551v15.276h73.036v-17.265h-48.43l25.048-25.521c7.653-7.834,12.896-14.251,15.749-19.243   c2.852-4.992,4.278-10.245,4.278-15.738c0-9.782-3.375-17.497-10.083-23.151c-6.729-5.654-14.543-8.477-23.462-8.477   c-8.919,0-16.19,1.778-21.855,5.343c-5.645,3.566-10.827,8.869-15.507,15.889l14.523,8.406   c5.805-8.959,13.077-13.448,21.854-13.448c4.982,0,9.1,1.507,12.373,4.51c3.254,3.003,4.882,6.648,4.882,10.928   c0,4.278-1.526,8.506-4.579,12.674C161.406,234.732,156.263,240.487,149.032,247.818z"></path>
                                <polygon points="266.36,295.646 266.36,268.759 279.195,268.759 279.195,252.408 266.36,252.408 266.36,232.853 249.246,232.853    249.246,252.408 223.735,252.408 262.383,188.842 242.677,188.842 203.408,252.86 203.408,268.759 249.246,268.759    249.246,295.646  "></polygon>
                                <path d="M372.4,295.646V245.84c0-10.596-2.812-18.691-8.477-24.295c-5.645-5.604-13.057-8.406-22.236-8.406   c-5.705,0-11.028,1.426-15.97,4.278c-4.942,2.852-8.617,6.779-11.068,11.761v-46.753h-17.115v113.222h17.115v-44.001   c0-7.543,2.189-13.267,6.568-17.194c4.379-3.918,9.521-5.876,15.427-5.876c12.434,0,18.64,7.482,18.64,22.458v44.613H372.4z"></path>
                            </g>
                        </svg>
                    </span>
				</div>

                <p class="text-center mt-2 fw-700">Tu propio horario</p>
                <p class="text-center mt-2">Acceso las 24 horas del día. Para que aprendas a tu propio ritmo.</p>

            </div>

            <div class="cualidad">

                <div class="uael-icon-wrap elementor-animation- elemt_icon mx-auto">
                    <span class="uael-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" style="enable-background:new 0 0 128 128;" viewBox="0 0 128 128" xml:space="preserve"><g><polygon points="91,45 83,45 83,73 73,73 73,119 61,119 61,73 51,73 51,45 43,45 43,81 53,81 53,127 81,127 81,81 91,81  "></polygon><path d="M53,15c0,7.7,6.3,14,14,14s14-6.3,14-14S74.7,1,67,1S53,7.3,53,15z M73,15c0,3.3-2.7,6-6,6s-6-2.7-6-6s2.7-6,6-6   S73,11.7,73,15z"></path><path d="M19,25c0,7.7,6.3,14,14,14s14-6.3,14-14s-6.3-14-14-14S19,17.3,19,25z M39,25c0,3.3-2.7,6-6,6s-6-2.7-6-6s2.7-6,6-6   S39,21.7,39,25z"></path><polygon points="113,83 103,83 103,119 87,119 87,127 111,127 111,91 121,91 121,51 113,51  "></polygon><path d="M87,25c0,7.7,6.3,14,14,14s14-6.3,14-14s-6.3-14-14-14S87,17.3,87,25z M101,19c3.3,0,6,2.7,6,6s-2.7,6-6,6s-6-2.7-6-6   S97.7,19,101,19z"></path><polygon points="31,83 21,83 21,51 13,51 13,91 23,91 23,127 47,127 47,119 31,119  "></polygon></g></svg>								</span>
                </div>

                <p class="text-center mt-2 fw-700">Confianza</p>
                <p class="text-center mt-2">Apoyo privado de tutores online y participación premiado en el foro por responder o debatir.</p>
            </div>

            <div class="cualidad">

                <div class="uael-icon-wrap elementor-animation- elemt_icon mx-auto">
                    <span class="uael-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 2" id="Layer_2" viewBox="0 0 64 64"><title></title><path d="M46,26a6.911,6.911,0,0,1-.99,3.508,1,1,0,0,0,1.741.984A8.953,8.953,0,0,0,48,26V15a1,1,0,0,0-2,0Z"></path><path d="M64,9.091A1,1,0,0,0,63,8H53V2h2.75a1,1,0,0,0,0-2H20a1,1,0,0,0,0,2H51V26A15,15,0,0,1,36,41H28A15.017,15.017,0,0,1,13,26V19a1,1,0,0,0-2,0v5.136A23.231,23.231,0,0,1,2.17,10H11v5a1,1,0,0,0,2,0V2h3a1,1,0,0,0,0-2H7A1,1,0,0,0,7,2h4V8H1A1,1,0,0,0,0,9.091,24.742,24.742,0,0,0,11.029,26.569,17,17,0,0,0,27,42.949V62H17a1,1,0,0,0,0,2H47a1,1,0,0,0,0-2H37V54a1,1,0,0,0-2,0v8H29V43h6v7a1,1,0,0,0,2,0V42.944A16.921,16.921,0,0,0,52.976,26.566,24.743,24.743,0,0,0,64,9.091ZM53,24.136V10h8.83A23.231,23.231,0,0,1,53,24.136Z"></path><path d="M20,11a1,1,0,0,0,1-1V8a1,1,0,0,0-2,0v2A1,1,0,0,0,20,11Z"></path><path d="M20,19a1,1,0,0,0,1-1V16a1,1,0,0,0-2,0v2A1,1,0,0,0,20,19Z"></path><path d="M28,10V8a1,1,0,0,0-2,0v2a1,1,0,0,0,2,0Z"></path><path d="M47,11a1,1,0,0,0,1-1V7a1,1,0,0,0-2,0v3A1,1,0,0,0,47,11Z"></path></svg>								</span>
                </div>

                <p class="text-center mt-2 fw-700">Calidad</p>
                <p class="text-center mt-2">Cursos online realizados con la información actualizada y docentes capacitados.</p>
            </div>

            <div class="cualidad">

                <div class="uael-icon-wrap elementor-animation- elemt_icon mx-auto">
                    <span class="uael-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Calque_1" viewBox="0 0 100 100" xml:space="preserve">
                            <g>
                                <path d="M60.95,40.82c-0.8,1.48-2.351,2.41-4.04,2.41c-0.75,0-1.49-0.19-2.16-0.55c-1.27-0.68-2.16-1.95-2.36-3.38   c-0.05-0.33-0.3-0.59-0.63-0.65s-0.66,0.1-0.819,0.39L45.4,49.37l-8.8-4.73c1.18-0.55,2.17-1.47,2.81-2.65   c1.59-2.98,0.47-6.7-2.5-8.29c-0.89-0.48-1.89-0.73-2.9-0.73c-2.26,0-4.33,1.23-5.4,3.22c-0.63,1.19-0.85,2.52-0.66,3.81   l-8.79-4.72l4.72-8.8c0.55,1.18,1.47,2.17,2.66,2.81c0.89,0.48,1.89,0.73,2.89,0.73c2.26,0,4.33-1.24,5.4-3.23   c1.6-2.97,0.48-6.69-2.5-8.29c-1.16-0.63-2.52-0.86-3.81-0.66l4.73-8.8l10.31,5.54c0.3,0.16,0.66,0.11,0.9-0.12   c0.25-0.23,0.31-0.59,0.17-0.9c-0.62-1.3-0.57-2.84,0.11-4.11c0.8-1.49,2.34-2.41,4.03-2.41c0.75,0,1.5,0.19,2.16,0.54   c1.08,0.58,1.86,1.54,2.221,2.71c0.35,1.17,0.229,2.41-0.351,3.49c-0.689,1.27-1.95,2.15-3.38,2.36c-0.33,0.05-0.59,0.3-0.65,0.63   s0.11,0.66,0.4,0.82l10.32,5.54l-5.55,10.32c-0.16,0.3-0.11,0.66,0.119,0.9c0.23,0.25,0.591,0.31,0.9,0.17   c0.61-0.29,1.29-0.44,1.96-0.44c0.75,0,1.5,0.19,2.16,0.54c1.08,0.58,1.86,1.54,2.22,2.71C61.65,38.5,61.52,39.74,60.95,40.82z">
                                </path>
                                <path d="M85.38,78.08c0,2.52-2.05,4.57-4.57,4.57c-1.449,0-2.819-0.7-3.68-1.86c-0.2-0.271-0.55-0.38-0.87-0.28   c-0.31,0.11-0.529,0.4-0.529,0.74v11.72h-9.98c0.78-1.05,1.21-2.33,1.21-3.67c0-3.38-2.74-6.12-6.12-6.12s-6.13,2.74-6.13,6.12   c0,1.34,0.44,2.62,1.22,3.67H45.95v-9.89c1.03,0.72,2.26,1.12,3.53,1.12h0.14c3.38,0,6.12-2.75,6.12-6.12   c0-3.38-2.74-6.13-6.12-6.13h-0.14c-1.27,0-2.5,0.399-3.53,1.12V63.18h11.71c0.33,0,0.63-0.21,0.729-0.529   c0.11-0.32,0-0.67-0.27-0.86c-1.16-0.86-1.86-2.24-1.86-3.68c0-2.521,2.061-4.58,4.58-4.58c2.521,0,4.57,2.06,4.57,4.58   c0,1.439-0.69,2.81-1.851,3.68c-0.27,0.19-0.38,0.54-0.279,0.86c0.109,0.319,0.399,0.529,0.739,0.529H75.73V74.9   c0,0.34,0.22,0.64,0.529,0.739c0.32,0.101,0.67-0.01,0.87-0.279c0.86-1.16,2.23-1.86,3.68-1.86C83.33,73.5,85.38,75.55,85.38,78.08   z">
                                </path>
                                <path d="M54.06,78.08c0,2.49-2.01,4.53-4.5,4.57c-1.51-0.021-2.9-0.771-3.74-2.03c-0.2-0.29-0.55-0.41-0.88-0.311   c-0.32,0.091-0.55,0.4-0.55,0.74v11.92h-9.97c0.78-1.05,1.21-2.33,1.21-3.67c0-3.38-2.74-6.12-6.12-6.12   c-3.38,0-6.13,2.74-6.13,6.12c0,1.34,0.44,2.62,1.22,3.67h-9.98V82.98c1.04,0.779,2.32,1.22,3.67,1.22c3.38,0,6.12-2.75,6.12-6.12   c0-3.38-2.74-6.13-6.12-6.13c-1.35,0-2.63,0.439-3.67,1.22V63.19h11.71c0.33,0,0.63-0.221,0.73-0.54c0.11-0.32,0-0.67-0.27-0.86   c-1.16-0.86-1.86-2.24-1.86-3.68c0-2.521,2.06-4.57,4.58-4.57c2.52,0,4.57,2.05,4.57,4.57c0,1.439-0.69,2.819-1.85,3.68   c-0.27,0.19-0.38,0.54-0.28,0.86c0.11,0.319,0.4,0.54,0.74,0.54h11.7v11.92c0,0.34,0.23,0.64,0.55,0.739   c0.33,0.101,0.68-0.029,0.88-0.31c0.83-1.26,2.23-2.01,3.73-2.04C52.04,73.54,54.06,75.58,54.06,78.08z">
                                </path>
                            </g>
                        </svg>
                    </span>
                </div>

                <p class="text-center mt-2 fw-700">Experiencia</p>
                <p class="text-center mt-2">Cursos , talleres gratis y de paga, con las que puedas enriquecer tu aprendizaje.</p>
            </div>

            <div class="cualidad">

                <div class="uael-icon-wrap elementor-animation- elemt_icon mx-auto">
                    <span class="uael-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_3" style="enable-background:new 0 0 64 64;" viewBox="0 0 64 64" xml:space="preserve"><g><path d="M62,1H2C1.447,1,1,1.448,1,2v44c0,0.552,0.447,1,1,1h11.82l-1.806,10.835c-0.062,0.371,0.09,0.746,0.393,0.969   c0.302,0.224,0.703,0.258,1.041,0.09L21,55.118l7.553,3.776C28.694,58.965,28.848,59,29,59c0.21,0,0.419-0.066,0.594-0.196   c0.303-0.223,0.454-0.598,0.393-0.969L28.18,47H49v6h-3c-0.553,0-1,0.448-1,1v3h-1c-0.553,0-1,0.448-1,1v4c0,0.552,0.447,1,1,1h16   c0.553,0,1-0.448,1-1v-4c0-0.552-0.447-1-1-1h-1v-3c0-0.552-0.447-1-1-1h-3v-6h7c0.553,0,1-0.448,1-1V2C63,1.448,62.553,1,62,1z    M11.569,35.667C11.569,35.667,11.568,35.667,11.569,35.667c-0.319,0.903-0.497,1.843-0.547,2.801C9.805,37.77,9,36.462,9,35V13   c0-2.206,1.794-4,4-4h38c2.206,0,4,1.794,4,4v22c0,0.714-0.194,1.394-0.547,2H48c-0.553,0-1,0.448-1,1v1H31c0-5.514-4.486-10-10-10   C16.77,29,12.979,31.679,11.569,35.667z M54,41h-4h-1v-2h6v2H54z M13.455,36.333C14.583,33.143,17.615,31,21,31   c4.411,0,8,3.589,8,8s-3.589,8-8,8s-8-3.589-8-8C13,38.085,13.153,37.188,13.455,36.333z M21.447,53.105   c-0.281-0.141-0.613-0.141-0.895,0l-6.243,3.122l1.454-8.725C17.289,48.446,19.079,49,21,49s3.711-0.554,5.237-1.497l1.454,8.725   L21.447,53.105z M28.981,45c0.878-1.165,1.516-2.52,1.818-4H47v1c0,0.552,0.447,1,1,1h1v2H28.981z M59,61H45v-2h1h12h1V61z M57,57   H47v-2h3h4h3V57z M51,53V43h2v10H51z M61,45h-6v-2h1c0.553,0,1-0.448,1-1v-4c0-0.337-0.177-0.62-0.433-0.802   C56.842,36.504,57,35.766,57,35V13c0-3.309-2.691-6-6-6H13c-3.309,0-6,2.691-6,6v22c0,2.614,1.717,4.895,4.154,5.688   c0.274,1.599,0.927,3.067,1.865,4.312H3V3h58V45z"></path><path d="M21,45c3.309,0,6-2.691,6-6s-2.691-6-6-6s-6,2.691-6,6S17.691,45,21,45z M21,35c2.206,0,4,1.794,4,4s-1.794,4-4,4   s-4-1.794-4-4S18.794,35,21,35z"></path><rect height="2" width="12" x="26" y="13"></rect><rect height="2" width="22" x="21" y="17"></rect><rect height="2" width="12" x="26" y="21"></rect></g></svg>								</span>
                </div>

                <p class="text-center mt-2 fw-700">Certificación</p>
                <p class="text-center mt-2">La Entrega de la certificación es a la puerta de tu casa, en plazo de 9 días, Después de haberlo solicitado.</p>
            </div>

            <div class="cualidad">

                <div class="uael-icon-wrap elementor-animation-  elemt_icon mx-auto">
                    <span class="uael-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" style="enable-background:new 0 0 256 256;" viewBox="0 0 256 256" xml:space="preserve"><g><path d="M26.5,65c-3.3-8.6-5.9-17.6-7.8-26.7c-0.7-3.5-1.4-6.9-2-10.4c-0.4-2.2-0.7-4.5-1.1-6.8c-0.2-1.1-0.3-2.3-0.5-3.4L15.1,17   c0-0.2-0.1-0.5-0.1-0.7c0.5,0,1,0.1,1.5,0.2l0.9,0.1c2.3,0.3,4.5,0.6,6.8,1c4.5,0.7,8.9,1.5,13.1,2.4c8.8,1.9,17.5,4.4,25.8,7.5   c2.5,0.9,5.2-0.3,6.2-2.8c0.9-2.5-0.3-5.2-2.8-6.2c-8.7-3.3-17.8-5.9-27.1-7.9c-4.3-0.9-8.9-1.8-13.6-2.5c-2.3-0.4-4.7-0.7-7-1   L17.8,7c-2.2-0.3-5.1-0.7-8.2,0.7c-2.5,1.2-4.1,3.8-4.3,7c-0.1,1.4,0.1,2.7,0.2,3.7l0.1,0.6c0.2,1.2,0.3,2.4,0.5,3.6   c0.3,2.3,0.7,4.7,1.1,7c0.6,3.6,1.3,7.2,2.1,10.8c2,9.6,4.8,19,8.2,28.2c0.7,1.9,2.5,3.1,4.5,3.1c0.6,0,1.1-0.1,1.7-0.3   C26.2,70.3,27.4,67.5,26.5,65z"></path><path d="M249.3,227.2c-2.6-2.6-3.2-7.3-3.9-12c-1.4-9.7-5.5-27.6-17.9-38.7c-5.4-4.8-11.7-7.7-18.7-8.6   c-10.6-1.4-21.7,2.4-30.3,10.4c-8.6,8-13.2,18.7-12.6,29.5c1.1,20.6,20.6,32,37,35.6c4.6,1,9.3,2,12,4.6c0.9,0.9,2.2,1.4,3.5,1.4   c0.7,0,1.3-0.1,2-0.4c3.2-1.5,3-5.1,2.9-6.6c-0.4-5.8-3.9-9.5-6.6-12.4c-1-1.1-2-2.2-2.8-3.2c-0.9-1.3-1.3-2.7-1-3.8   c0.3-1,1.1-1.8,2.5-2.5c3-1.4,7.2-1.1,9.8,0.8c1.6,1.1,2.9,2.9,4.4,4.7c2.2,2.8,4.7,5.9,8.4,7.8c1.8,0.9,3.6,1.5,5.9,1.8   c1.5,0.1,4.9,0.3,6.4-2.9C251.1,230.9,250.7,228.7,249.3,227.2z M230.8,213.5c-5.4-3.9-13.4-4.6-19.5-1.7c-3.9,1.9-6.7,5-7.7,8.7   c-1,3.8-0.1,8.1,2.4,11.7c0.6,0.9,1.3,1.7,2,2.5c-1.1-0.3-2.1-0.5-3.1-0.7c-13.1-2.8-28.6-11.5-29.5-26.7c-0.4-7.9,3.1-15.9,9.6-22   c5.6-5.2,12.6-8.1,19.4-8.1c1,0,2.1,0.1,3.1,0.2c5.1,0.7,9.7,2.8,13.6,6.3c7.4,6.6,12.8,18.6,14.8,33.1c0.1,0.7,0.2,1.4,0.3,2.2   C234.7,217,233,215,230.8,213.5z"></path><path d="M185.1,147.3l-4.8-13c-2-5.3-4.2-10.6-6.6-15.7l40.2-40.2c3.1-3.1,4-7.8,2.1-11.8c-1.9-4-5.9-6.4-10.3-6.1l-68.1,5   c-15.3-16-32.9-29.1-52.5-38.8c-0.5-0.3-1-0.5-1.7-0.8c-1.8-0.9-4-0.5-5.4,0.9L25.4,79.3c-1.4,1.4-1.8,3.6-0.9,5.5l0.7,1.4   c9.8,19.7,22.8,37.4,38.9,52.7l-5,68.2c-0.3,4.4,2.1,8.5,6.1,10.3c1.4,0.7,2.9,1,4.4,1c2.7,0,5.4-1.1,7.4-3.1l40.2-40.3   c5.1,2.4,10.4,4.6,15.6,6.5l13,4.8c1.7,0.6,3.7,0.2,5-1.1l33.1-32.9C185.3,151,185.8,149,185.1,147.3z M146.4,176.2l-10.1-3.8   c-6-2.2-12-4.8-17.8-7.6c-1.8-0.9-4-0.5-5.5,0.9l-42.6,42.7c-0.1,0.1-0.5,0.5-1.1,0.2c-0.6-0.3-0.6-0.7-0.5-0.9l5.1-70.5   c0.1-1.5-0.5-2.9-1.5-3.9C56.8,119,44.1,102.2,34.6,83.6l47.7-47.7c18.7,9.5,35.5,22.2,49.9,37.7c1,1.1,2.4,1.6,3.9,1.5l70.4-5.2   c0,0,0,0,0,0c0.2,0,0.6,0,0.9,0.5c0.3,0.6-0.1,1-0.2,1.1l-42.6,42.6c-1.4,1.4-1.8,3.6-0.9,5.5c2.8,5.8,5.4,11.8,7.7,18l3.7,10.1   L146.4,176.2z"></path><path d="M83.7,84.9c-4.4,4.4-6.9,10.3-6.9,16.6c0,6.3,2.4,12.2,6.9,16.6c4.4,4.4,10.3,6.9,16.6,6.9c0,0,0,0,0,0   c6.3,0,12.2-2.4,16.6-6.9c9.1-9.1,9.1-24,0-33.2C107.7,75.8,92.9,75.8,83.7,84.9z M110.1,111.3c-2.6,2.6-6.1,4.1-9.8,4.1   c0,0,0,0,0,0c-3.7,0-7.2-1.4-9.8-4.1c-2.6-2.6-4.1-6.1-4.1-9.8c0-3.7,1.5-7.2,4.1-9.8c2.7-2.7,6.3-4.1,9.8-4.1   c3.6,0,7.1,1.4,9.8,4.1C115.5,97.1,115.5,105.9,110.1,111.3z"></path></g></svg>								</span>
                </div>

                <p class="text-center mt-2 fw-700">Facilidad</p>
                <p class="text-center mt-2">80% de nuestros talleres son gratuitos. Sin prerequisitos ni conocimiento previo.</p>
            </div>

        </div>
    </div>
</div>
