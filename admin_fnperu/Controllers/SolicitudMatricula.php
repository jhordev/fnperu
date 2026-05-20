<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;
    use ADMINFN\Helpers\Helper;
    use ADMINFN\Models\FNPeru\SolicitudMatriculaModel;

    class SolicitudMatricula extends BaseController
    {
        public function __construct() 
        {
            parent::__construct();
            $this -> verifyLogin();
        }

        public function index()
        {
            $data['page_title'] = 'Solicitud de Matrícula';
            $data['page_active'] = 'soli_matricula';
            $data['page_css'] = 'solicitudmatricula/solicitud';
            $data['page_js'] = 'solicitudmatricula/solicitud';
            $data['page_datatable'] = true;
            $data['page_swalert'] = true;

            $solicitud = new SolicitudMatriculaModel;
            $dataSoli = $solicitud -> getSolicitudesPendientes();

            if ($dataSoli == []) {
                $data['default_value'] = 1;
            } else {
                $data['default_value'] = 2;
            }

            $this -> view(['Template/header', 'SolicitudMatricula/solicitud', 'Template/footer'], $data);
        }

        public function imgVaucher(string $name = null)
        {
            $existe = false;

            if ($name != null) 
            {
                $name = Helper::base_path() . '/../admin_fnperu/Writable/Images/VaucherSolMatricula/' . $name;

                if (file_exists($name)) {
                    $existe = true;
                }
            }

            header("Content-type: image/png");
            header("Content-Disposition: inline; filename=" . $name);
    
            if ($existe) {
                readfile($name);
            }
        }

        public function getSolicitudes()
        {
            if (!isset($_POST['estado'])) {
                json([]);
            }

            $solicitudModel = new SolicitudMatriculaModel;
            $soliData = $solicitudModel -> getSolicitudesTable($_POST['estado']);
            
            $estado = [
                '<div class="text-center fw-700 text-danger active_lanza">
                    ANULADO
                </div>', 
                '<div class="text-center fw-700 text-success active_lanza">
                    ATENDIDO
                </div>', 
                '<div class="text-center fw-700 color-warning active_lanza">
                    PENDIENTE
                </div>'
            ];

            $action = [
                ' d-block', 
                '<div class="text-center', 
                '"> <a ',
                ' type="button" class="fw-bold btn_ver_solicitud text-decoration-none text-primary">Ver Más <i class="fa-solid fa-angles-right"></i><span class="data d-none">',
                '</span></a>
                </div>'
            ];
            
            foreach ($soliData as $key => $value) 
            { 
                $soliData[$key]['numero'] = $key + 1;

                $value['code'] = 'SOL-MAT-' . str_pad($value['sol_id'], 4, 0, STR_PAD_LEFT);
                $soliData[$key]['code'] = '<div class="text-center">' . $value['code'] . '</div>';

                $soliData[$key]['nombre_completo'] = $value['sol_nombres'] . ' ' . $value['sol_apellido_paterno'] . ' ' . $value['sol_apellido_materno'];

                $soliData[$key]['sol_dni'] = '<div class="text-center">' . $value['sol_dni'] . '</div>';

                $value['sol_recepcion'] = date('h:i a - d/m/Y', strtotime($value['sol_creacion']));
                $soliData[$key]['sol_creacion'] = '<div class="text-center">' . date('d/m/Y', strtotime($value['sol_creacion'])) . '</div>';

                $value['href_img'] = $this -> base_url() . '/solicitudmatricula/imgvaucher/' . $value['sol_vaucher'];

                $soliData[$key]['sol_estado'] = $estado[$value['sol_estado']];
                
                $soliData[$key]['acciones'] = $action[1] . $action[0] . $action[2] .  $action[3] . json_encode($value) .  $action[4];
                $action[0] = '';
            }

            json($soliData);
        }

        public function save()
        {
            $this -> isPost();
            
            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];
            
            if (!isset($this -> post['action']) || !isset($this -> post['id'])) {
                json($return);
            }
            
            if (!ctype_digit($this -> post['id'])) {
                json($return);
            }

            $this -> post['id'] = intval($this -> post['id']);

            // if($this -> post['action'] == 'image') {
            //     $this -> post['data'] = 'image';
            // }

            // if($this -> post['action'] == 'brochure') {
            //     $this -> post['data'] = 'brochure';
            // }

            $this -> post['data'] = trim($this -> post['data'] );

            $solicitud = new SolicitudMatriculaModel;
            $dataSoli = $solicitud -> getSolicitudById($this -> post['id']);

            if ($dataSoli == false) {
                json($return);
            }
            
            if ($this -> post['action'] == 'to_atendidos') 
            {
                if ($dataSoli['sol_estado'] == 1) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $solicitud -> query('UPDATE solicitud_matricula SET sol_estado = 1 WHERE sol_id = :sol_id');
                $update -> bindValue(':sol_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }

                json($return);
            }
            
            if ($this -> post['action'] == 'to_pendientes') 
            {
                if ($dataSoli['sol_estado'] == 2) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $solicitud -> query('UPDATE solicitud_matricula SET sol_estado = 2 WHERE sol_id = :sol_id');
                $update -> bindValue(':sol_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }

                json($return);
            }
            
            if ($this -> post['action'] == 'to_anulados') 
            {
                if ($dataSoli['sol_estado'] == 0) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $solicitud -> query('UPDATE solicitud_matricula SET sol_estado = 0 WHERE sol_id = :sol_id');
                $update -> bindValue(':sol_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }

                json($return);
            }

            if ($this -> post['action'] == 'cambiar_voucher') 
            { 
                if (!isset($this -> files['data']['error']) || !isset($this -> files['data']['name']) || !isset($this -> files['data']['size']) || !isset($this -> files['data']['tmp_name']) || !isset($this -> files['data']['type'])) 
                {
                    $return['message'] = 'La foto del Voucher no es válida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
                
                if ($this -> files['data']['error'] !== 0 || ($this -> files['data']['type'] !== 'image/jpeg' && $this -> files['data']['type'] !== 'image/png') || intval($this -> files['data']['size']) <= 100) 
                {
                    $return['message'] = 'La foto del Voucher no es válida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
                
                $extension = getExtension($this -> files['data']['name']);
                $newName = nameForFiles($dataSoli['sol_dni'], $extension) . '.' . $extension;
                
                if (trim($extension) == '' || trim($newName) == '') 
                {
                    $return['message'] = 'La foto del Voucher no es válida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $newName = date('ynjGis') . rand(100, 999) . '_' . $newName;
                $newPath = Helper::base_path() . '/../admin_fnperu/Writable/Images/VaucherSolMatricula/' . $newName;
                
                $auxMoveFile = move_uploaded_file($this -> files['data']['tmp_name'], $newPath);

                if ($auxMoveFile !== true) {
                    $return['message'] = 'Error al guardar la foto del Voucher';
                    json($return);
                }
                
                $stringImagenes = trim($dataSoli['sol_imagenes']);

                if ($dataSoli['sol_imagenes'] != '') {
                    $stringImagenes = '-||-' . $stringImagenes;
                }

                $stringImagenes = $dataSoli['sol_vaucher'] . '|-|' . date('d-m-Y') . $stringImagenes;

                $update = $solicitud -> query('UPDATE solicitud_matricula SET sol_imagenes = :sol_imagenes, sol_vaucher = :sol_vaucher WHERE sol_id = :sol_id');
                $update -> bindValue(':sol_imagenes', $stringImagenes);
                $update -> bindValue(':sol_vaucher', $newName);
                $update -> bindValue(':sol_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }

                json($return);
            }
            
            json($return);
        }
    }
    