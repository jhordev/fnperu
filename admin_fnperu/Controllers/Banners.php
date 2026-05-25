<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;
    use ADMINFN\Helpers\Helper;
    use ADMINFN\Models\FNPeru\BannersModel;

    class Banners extends BaseController
    {
        // Aspect ratio tolerance: width/height between 2.5 and 3.8  (target 3:1 = 1920×640)
        private const RATIO_MIN  = 2.5;
        private const RATIO_MAX  = 3.8;
        private const MIN_WIDTH  = 1200;
        private const MAX_BYTES  = 5 * 1024 * 1024; // 5 MB

        public function __construct()
        {
            parent::__construct();
            $this->verifyLogin();
        }

        public function index()
        {
            $data['page_title']    = 'Banners del Hero';
            $data['page_active']   = 'banners';
            $data['page_js']       = 'banners/table';
            $data['page_datatable'] = true;
            $data['page_swalert']  = true;
            $data['page_viewport'] = true;

            $this->view(['Template/header', 'Banners/table', 'Template/footer'], $data);
        }

        /* ── GET: lista para DataTable ── */
        public function getBanners()
        {
            $seccion = isset($_GET['seccion']) && $_GET['seccion'] === '1' ? 1 : 0;

            $model   = new BannersModel;
            $rows    = $model->getBySeccion($seccion);
            $assetsUrl = Helper::assets_url();

            foreach ($rows as $k => $row) {
                $rows[$k]['numero']  = $k + 1;
                $rows[$k]['preview'] = '<img src="' . $assetsUrl . '/admin/images/banners/' . htmlspecialchars($row['banner_imagen']) . '" style="height:54px;border-radius:6px;object-fit:cover;" alt="">';
                $rows[$k]['activo_label'] = $row['banner_activo'] == 1
                    ? '<span class="badge bg-success">Activo</span>'
                    : '<span class="badge bg-secondary">Oculto</span>';
                $rows[$k]['acciones'] = '
                    <div class="d-flex gap-1 justify-content-center">
                        <button class="btn btn-sm btn-outline-warning btn_toggle_banner" data-id="' . $row['banner_id'] . '" data-activo="' . $row['banner_activo'] . '" title="' . ($row['banner_activo'] ? 'Ocultar' : 'Activar') . '">
                            <i class="fa-solid ' . ($row['banner_activo'] ? 'fa-eye-slash' : 'fa-eye') . '"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger btn_delete_banner" data-id="' . $row['banner_id'] . '" data-img="' . htmlspecialchars($row['banner_imagen']) . '" title="Eliminar">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>';
            }

            json($rows);
        }

        /* ── POST: subir nuevo banner ── */
        public function subir()
        {
            $this->isPost();

            $return = ['status' => false, 'message' => 'Error inesperado', 'title' => 'ERROR', 'type' => 'danger'];

            $seccion = isset($this->post['seccion']) && $this->post['seccion'] === '1' ? 1 : 0;

            $f = $this->files['banner_img'] ?? null;

            if (!$f || $f['error'] !== 0 || !in_array($f['type'], ['image/jpeg', 'image/png']) || intval($f['size']) <= 100) {
                $return['message'] = 'Archivo no válido. Solo JPG o PNG.';
                $return['title']   = 'ALERTA';
                $return['type']    = 'warning';
                json($return);
            }

            if (intval($f['size']) > self::MAX_BYTES) {
                $return['message'] = 'La imagen supera el límite de 5 MB.';
                $return['title']   = 'ALERTA';
                $return['type']    = 'warning';
                json($return);
            }

            $imgInfo = @getimagesize($f['tmp_name']);
            if (!$imgInfo || $imgInfo[0] < self::MIN_WIDTH) {
                $return['message'] = 'La imagen debe tener al menos ' . self::MIN_WIDTH . ' px de ancho.';
                $return['title']   = 'ALERTA';
                $return['type']    = 'warning';
                json($return);
            }

            $ratio = $imgInfo[0] / $imgInfo[1];
            if ($ratio < self::RATIO_MIN || $ratio > self::RATIO_MAX) {
                $return['message'] = 'Proporción incorrecta. Se requiere una imagen panorámica de 3:1 (ej. 1920 × 640 px). La tuya tiene ' . $imgInfo[0] . '×' . $imgInfo[1] . ' px.';
                $return['title']   = 'ALERTA';
                $return['type']    = 'warning';
                json($return);
            }

            $ext     = ($f['type'] === 'image/png') ? 'png' : 'jpg';
            $newName = date('ynjGis') . rand(100, 999) . '_banner_' . ($seccion === 0 ? 'cursos' : 'urb') . '.' . $ext;
            $newPath = Helper::public_path() . '/assets/admin/images/banners/' . $newName;

            if (!move_uploaded_file($f['tmp_name'], $newPath)) {
                $return['message'] = 'Error al guardar la imagen.';
                json($return);
            }

            $model  = new BannersModel;
            $insert = $model->value([
                'banner_seccion' => $seccion,
                'banner_imagen'  => $newName,
                'banner_orden'   => 0,
                'banner_activo'  => 1,
            ])->insert();

            if ($insert > 0) {
                $return['status'] = true;
            }

            json($return);
        }

        /* ── POST: activar / desactivar ── */
        public function toggleActivo()
        {
            $this->isPost();

            $return = ['status' => false];

            $id     = intval($this->post['banner_id'] ?? 0);
            $activo = intval($this->post['activo']    ?? 0);

            if ($id <= 0) { json($return); }

            $nuevoEstado = $activo == 1 ? 0 : 1;
            $model = new BannersModel;
            $stmt  = $model->query('UPDATE banners_hero SET banner_activo = :a WHERE banner_id = :id');
            $stmt->bindValue(':a',  $nuevoEstado);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $return['status'] = true;
            }

            json($return);
        }

        /* ── POST: eliminar ── */
        public function eliminar()
        {
            $this->isPost();

            $return = ['status' => false];

            $id  = intval($this->post['banner_id'] ?? 0);
            $img = $this->post['banner_img'] ?? '';

            if ($id <= 0) { json($return); }

            $model = new BannersModel;
            $stmt  = $model->query('DELETE FROM banners_hero WHERE banner_id = :id');
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $filePath = Helper::public_path() . '/assets/admin/images/banners/' . basename($img);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
                $return['status'] = true;
            }

            json($return);
        }

        /* ── POST: reordenar ── */
        public function ordenar()
        {
            $this->isPost();

            $return = ['status' => false];

            if (empty($this->post['data'])) { json($return); }

            $ids = explode('-', $this->post['data']);
            foreach ($ids as $v) {
                if (!ctype_digit($v)) { json($return); }
            }

            $model = new BannersModel;
            foreach ($ids as $orden => $id) {
                $stmt = $model->query('UPDATE banners_hero SET banner_orden = :o WHERE banner_id = :id');
                $stmt->bindValue(':o',  $orden);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
            }

            $return['status'] = true;
            json($return);
        }
    }
