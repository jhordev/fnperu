# ============================================
# FN PERU - Setup Instructions
# ============================================

## Primeros pasos

### 1. Configura los secrets en GitHub

Ve a tu repo en GitHub:
**Settings → Secrets and variables → Actions → New repository secret**

Añade estos secrets:

| Secret | Valor |
|--------|-------|
| `FTP_HOST` | `ftp.tudominio.com` o IP del servidor |
| `FTP_USERNAME` | Tu usuario FTP |
| `FTP_PASSWORD` | Tu password FTP |
| `FTP_SERVER_DIR` | Ruta en el servidor, ej: `/public_html/` |

### 2. Clona el repo en tu PC

```bash
git clone https://github.com/TU_USER/TU_REPO.git
cd TU_REPO
```

### 3. Trabaja normalmente

```bash
# Editas archivos
git add .
git commit -m "descripción del cambio"
git push
```

GitHub Actions subirá automáticamente los cambios al servidor.

---

## Estructura del proyecto

```
fnperu-main/
├── public_html/          → DocumentRoot (Apache)
│   └── dashboard/        → Admin panel entry
├── web_fnperu/           → Public site (namespace FNPERU)
├── admin_fnperu/         → Admin panel (namespace ADMINFN)
├── cursos_moodle/        → Moodle integration
├── campus/               → Moodle (completo)
├── db_backups/           → Backups DB (no se sube al repo)
└── require_funcions.php  → Shared helpers
```

## Configuración en servidor

### 1. Archivos `.env` (crear manualmente en server)

`web_fnperu/Config/.env` y `admin_fnperu/Config/.env` no se incluyen en el repo.
Créalos en el servidor con los valores de producción.

### 2. Config.php de Moodle

`campus/config.php` no se sube. Créalo manualmente:

```php
<?php
unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'tu_db_name';
$CFG->dbuser    = 'tu_db_user';
$CFG->dbpass    = 'tu_db_password';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = ['dbpersist' => 0, 'dbport' => 3306];

$CFG->wwwroot   = 'https://tudominio.com/campus';
$CFG->dataroot  = '/ruta/absoluta/moodledata';
$CFG->admin     = 'admin';
$CFG->directorypermissions = 0777;
$CFG->forcelogin = true;

require_once(__DIR__ . '/lib/setup.php');
```

### 3. Permisos

```bash
chmod -R 755 public_html/assets/admin/images/
chmod -R 755 public_html/assets/admin/docs/
chmod -R 755 admin_fnperu/Writable/
chmod -R 755 campus/moodledata/
```