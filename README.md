# FN Perú — Guía de Despliegue a Producción

## Estructura del proyecto

```
fnperu-main/
├── public_html/          → Raíz servida por Apache (DocumentRoot)
│   └── assets/           → CSS, JS, imágenes compartidas
├── web_fnperu/           → Sitio web principal (MVC propio)
│   └── Config/.env       → ⚙️  Variables de entorno del sitio
├── admin_fnperu/         → Panel administrador
│   └── Config/.env       → ⚙️  Variables de entorno del admin
├── cursos_moodle/        → Módulo de integración con Moodle
│   └── Config/Config.php → ⚙️  URLs de conexión con Moodle
└── db_backups/           → Backups de bases de datos
```

El campus Moodle vive en una carpeta **separada** del proyecto:
```
/var/www/html/campus/     → Instalación de Moodle 3.11
/var/moodledata/          → Datos de Moodle (fuera de public_html)
```

---

## Requisitos del servidor

| Componente | Versión mínima | Recomendado |
|------------|---------------|-------------|
| PHP        | 7.4           | **8.0.x**   |
| MySQL      | 5.7           | **8.0.x**   |
| Apache     | 2.4           | **2.4.x**   |
| mod_rewrite| —             | Habilitado  |

### Extensiones PHP requeridas

```
curl, gd, intl, mbstring, mysqli, pdo_mysql,
soap, xml, xmlreader, xmlwriter, zip
```

Instalar en Ubuntu/Debian:
```bash
sudo apt install php8.0 php8.0-curl php8.0-gd php8.0-intl \
  php8.0-mbstring php8.0-mysql php8.0-soap php8.0-xml php8.0-zip
```

---

## Bases de datos

El proyecto usa **dos bases de datos** MySQL:

| Base de datos          | Uso                                      |
|------------------------|------------------------------------------|
| `u175908272_fn_peru`   | Datos del sitio: cursos, urbanizaciones  |
| `u175908272_campus`    | Moodle (prefijo `mdl_`)                  |

### Crear usuario y bases de datos

```sql
CREATE DATABASE u175908272_fn_peru CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE u175908272_campus  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER 'fnperu'@'localhost' IDENTIFIED BY 'TU_PASSWORD_SEGURA';
GRANT ALL PRIVILEGES ON u175908272_fn_peru.* TO 'fnperu'@'localhost';
GRANT ALL PRIVILEGES ON u175908272_campus.*  TO 'fnperu'@'localhost';
FLUSH PRIVILEGES;
```

### Importar datos

```bash
mysql -u fnperu -p u175908272_fn_peru < db_backups/u175908272_fn_peru.sql
mysql -u fnperu -p u175908272_campus  < db_backups/u175908272_campus.sql
```

---

## Pasos para subir a producción

### 1. Subir archivos

Subir todo el contenido de `fnperu-main/` al servidor. La carpeta `public_html/` debe ser el DocumentRoot de Apache.

Subir `campus/` (Moodle) en una ubicación accesible y configurar el Alias en Apache.

### 2. Configurar Apache

```apache
<VirtualHost *:443>
    ServerName fnconstructores.com
    DocumentRoot /ruta/en/servidor/fnperu-main/public_html

    <Directory /ruta/en/servidor/fnperu-main/public_html>
        Options FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # Alias para el campus Moodle
    Alias /campus /ruta/en/servidor/campus

    <Directory /ruta/en/servidor/campus>
        Options FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # SSL (Let's Encrypt o certificado del hosting)
    SSLEngine on
    SSLCertificateFile    /ruta/al/certificado.crt
    SSLCertificateKeyFile /ruta/al/certificado.key
</VirtualHost>
```

Habilitar mod_rewrite:
```bash
sudo a2enmod rewrite ssl
sudo systemctl restart apache2
```

### 3. Configurar PHP (php.ini)

```ini
upload_max_filesize = 20M
post_max_size       = 25M
max_input_vars      = 5000
max_execution_time  = 300
memory_limit        = 256M
```

### 4. Actualizar variables de entorno

Editar los 3 archivos de configuración cambiando `localhost` por el dominio real:

#### `web_fnperu/Config/.env`
```
base_url   = https://fnconstructores.com
base_host  = fnconstructores.com
assets_url = https://fnconstructores.com/assets
base_path  = /ruta/absoluta/fnperu-main/web_fnperu
public_path= /ruta/absoluta/fnperu-main/public_html
development= false
```

#### `admin_fnperu/Config/.env`
```
base_url   = https://fnconstructores.com/dashboard
base_host  = fnconstructores.com/dashboard
assets_url = https://fnconstructores.com/assets
base_path  = /ruta/absoluta/fnperu-main/admin_fnperu
public_path= /ruta/absoluta/fnperu-main/public_html
development= false
```

#### `cursos_moodle/Config/Config.php`
```php
define('HOST_CURL', 'http://localhost');        // siempre localhost (comunicación interna)
define('BASE_URL',  'https://fnconstructores.com');
define('CAMPUS_URL','https://fnconstructores.com/campus');
```

### 5. Configurar Moodle (`campus/config.php`)

```php
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'u175908272_campus';
$CFG->dbuser    = 'fnperu';
$CFG->dbpass    = 'TU_PASSWORD_SEGURA';
$CFG->wwwroot   = 'https://fnconstructores.com/campus';
$CFG->dataroot  = '/ruta/fuera/de/public_html/moodledata';
$CFG->forcelogin = true;
// En producción con HTTPS quitar esta línea o dejar en false:
// $CFG->cookiesecure = false;
```

> **Importante:** `dataroot` debe estar **fuera** del DocumentRoot por seguridad.

### 6. Permisos de carpetas

```bash
# Carpetas de subida de archivos (escritura para el servidor web)
chmod -R 755 public_html/assets/admin/images/
chmod -R 755 public_html/assets/admin/docs/
chmod -R 755 admin_fnperu/Writable/

# Moodle dataroot
chmod -R 755 /ruta/moodledata/
chown -R www-data:www-data /ruta/moodledata/

# Moodle campus
chown -R www-data:www-data /ruta/campus/
```

### 7. Moodle — Actualizar URL en base de datos

Si cambias el dominio, ejecutar en MySQL:
```sql
UPDATE mdl_config SET value = 'https://fnconstructores.com/campus'
WHERE name = 'wwwroot';

-- Desactivar cookie segura si hay problemas de sesión en HTTP
UPDATE mdl_config SET value = '0' WHERE name = 'cookiesecure';
```

Luego purgar caché de Moodle:
```bash
php /ruta/campus/admin/cli/purge_caches.php
```

---

## Credenciales del sistema (cambiar en producción)

| Sistema        | Usuario  | Contraseña          | Dónde cambiar                        |
|----------------|----------|---------------------|--------------------------------------|
| Admin panel    | `admin`  | `2022.FNperu-admin` | `admin_fnperu/Controllers/Login.php` línea 54 |
| Moodle admin   | `admin`  | *(definida al crear)* | Panel Moodle → Administración        |
| MySQL          | `fnperu` | *(definida al crear)* | Los 3 archivos de configuración      |

> **Nota de seguridad:** La contraseña del admin panel está hardcodeada en el controlador. Cambiarla antes de ir a producción.

---

## App Moodle (móvil)

Para que los alumnos accedan desde la app oficial de Moodle:
1. El sitio debe tener una **URL pública** (no funciona con localhost)
2. Activar en Moodle: `Administración → Características avanzadas → Habilitar servicios web para dispositivos móviles`
3. Los alumnos descargan la app **"Moodle"** e ingresan la URL: `https://fnconstructores.com/campus`

---

## Checklist de despliegue

- [ ] Subir archivos al servidor
- [ ] Crear bases de datos e importar backups
- [ ] Actualizar `web_fnperu/Config/.env`
- [ ] Actualizar `admin_fnperu/Config/.env`
- [ ] Actualizar `cursos_moodle/Config/Config.php`
- [ ] Actualizar `campus/config.php`
- [ ] Configurar VirtualHost de Apache con SSL
- [ ] Habilitar `mod_rewrite`
- [ ] Configurar `php.ini` con límites de subida
- [ ] Dar permisos de escritura a carpetas de uploads
- [ ] Actualizar `wwwroot` de Moodle en base de datos si cambia el dominio
- [ ] Purgar caché de Moodle
- [ ] Cambiar contraseña del admin panel en código
- [ ] Poner `development = false` en ambos `.env`
- [ ] Verificar que `campus/` apunte correctamente con el Alias de Apache
- [ ] Probar login web, login admin y login Moodle
