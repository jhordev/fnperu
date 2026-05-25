<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;
    use ADMINFN\Models\FNPeru\InteresModel;

    class Intereses extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $this->verifyLogin();
        }

        public function index()
        {
            $data['page_title']    = 'Intereses de Inscripción';
            $data['page_active']   = 'intereses';
            $data['page_js']       = 'intereses/table';
            $data['page_datatable'] = true;
            $data['page_swalert']  = true;

            $model         = new InteresModel;
            $data['stats'] = $model->getStats();

            $this->view(['Template/header', 'Intereses/table', 'Template/footer'], $data);
        }

        public function getIntereses()
        {
            $model = new InteresModel;
            $rows  = $model->getInteresesTable();

            $estadoBadge = [
                '<div class="text-center"><span class="badge bg-warning text-dark">Pendiente</span></div>',
                '<div class="text-center"><span class="badge bg-primary">Contactado</span></div>',
                '<div class="text-center"><span class="badge bg-success">Matriculado</span></div>',
            ];

            $tipoBadge = [
                '<div class="text-center"><span class="badge bg-primary">Curso</span></div>',
                '<div class="text-center"><span class="badge" style="background:#7c3aed">Taller</span></div>',
            ];

            foreach ($rows as $key => $value) {
                $telefono = $value['interes_telefono'] ?? '';

                $rows[$key]['numero']      = $key + 1;
                $rows[$key]['tipo_label']  = $tipoBadge[intval($value['curso_tipo'])];
                $rows[$key]['estado_label']= $estadoBadge[intval($value['interes_estado'])];
                $rows[$key]['interes_telefono'] = $telefono == ''
                    ? '<div class="text-center text-muted">—</div>'
                    : '<div class="text-center">' . htmlspecialchars($telefono) . '</div>';
                $rows[$key]['interes_creacion'] = '<div class="text-center">'
                    . date('d/m/Y H:i', strtotime($value['interes_creacion'])) . '</div>';

                $rows[$key]['acciones'] =
                    '<div class="text-center">'
                    . '<button type="button" class="btn btn-sm btn-outline-primary fw-600 rounded btn_ver_interes" '
                    . 'data-id="'       . $value['interes_id']  . '" '
                    . 'data-curso="'    . htmlspecialchars($value['curso_nombre'],    ENT_QUOTES) . '" '
                    . 'data-nombre="'   . htmlspecialchars($value['interes_nombre'],  ENT_QUOTES) . '" '
                    . 'data-email="'    . htmlspecialchars($value['interes_email'],   ENT_QUOTES) . '" '
                    . 'data-telefono="' . htmlspecialchars($telefono,                 ENT_QUOTES) . '" '
                    . 'data-estado="'   . intval($value['interes_estado']) . '" '
                    . 'data-creacion="' . date('d/m/Y H:i', strtotime($value['interes_creacion'])) . '">'
                    . '<i class="fa-solid fa-eye me-1"></i>Ver</button></div>';
            }

            json($rows);
        }

        public function updateEstado()
        {
            $this->isPost();

            $return = [
                'status'  => false,
                'message' => 'Ocurrió un error inesperado',
                'title'   => 'ERROR',
                'type'    => 'danger'
            ];

            if (!isset($this->post['interes_id']) || !isset($this->post['estado'])) {
                json($return);
            }

            if (!ctype_digit($this->post['interes_id'])) {
                json($return);
            }

            $estado = intval($this->post['estado']);
            if ($estado < 0 || $estado > 2) {
                json($return);
            }

            $id    = intval($this->post['interes_id']);
            $model = new InteresModel;

            if ($model->getById($id) == false) {
                json($return);
            }

            $stmt = $model->query('UPDATE intereses_curso SET interes_estado = :estado WHERE interes_id = :id');
            $stmt->bindValue(':estado', $estado, \PDO::PARAM_INT);
            $stmt->bindValue(':id',     $id,     \PDO::PARAM_INT);
            $stmt->execute();

            $return['status'] = true;
            json($return);
        }

        public function deleteInteres()
        {
            $this->isPost();

            $return = [
                'status'  => false,
                'message' => 'Ocurrió un error inesperado',
                'title'   => 'ERROR',
                'type'    => 'danger'
            ];

            if (!isset($this->post['interes_id']) || !ctype_digit($this->post['interes_id'])) {
                json($return);
            }

            $id    = intval($this->post['interes_id']);
            $model = new InteresModel;

            if ($model->getById($id) == false) {
                json($return);
            }

            $stmt = $model->query('DELETE FROM intereses_curso WHERE interes_id = :id');
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $result = $stmt->execute();

            if ($result === true) {
                $return['status'] = true;
            }

            json($return);
        }
    }
