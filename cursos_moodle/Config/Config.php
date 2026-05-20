<?php

    // =============================================================
    // MÓDULO CURSOS MOODLE - FN Perú
    // Proyecto: cursos_moodle
    // Archivo:  cursos_moodle/Config/Config.php
    // =============================================================

    // URL interna para llamadas cURL al backend (Moodle API)
    // Este valor es la URL que el SERVIDOR usa para comunicarse con Moodle.
    // Generalmente siempre apunta a localhost (comunicación interna servidor-servidor).
    // LOCAL:      http://localhost
    // PRODUCCIÓN: http://localhost  (mantener localhost para comunicación interna)
    define('HOST_CURL', 'http://localhost');

    // URL base pública del sitio principal (para construir links de imágenes, assets)
    // LOCAL:      http://localhost
    // PRODUCCIÓN: https://fnconstructores.com
    define('BASE_URL', 'http://localhost');

    // URL pública del campus Moodle (para links de cursos y categorías)
    // LOCAL:      http://localhost/campus
    // PRODUCCIÓN: https://fnconstructores.com/campus
    define('CAMPUS_URL', 'http://localhost/campus');

    // Versión de media para cache-busting (incrementar al desplegar)
    define('MEDIA_VERSION', '0.0.0.1');
