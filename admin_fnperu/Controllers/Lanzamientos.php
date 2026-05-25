<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;
    use ADMINFN\Models\FNPeru\CursosModel;
    use ADMINFN\Models\FNPeru\LanzamientoModel;

    class Lanzamientos extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $this -> verifyLogin();
        }

        public function index() 
        {
            $data['page_title'] = 'Cursos';
            $data['page_active'] = 'lanzamientos';
            $data['page_css'] = 'lanzamientos/table';
            $data['page_js'] = 'lanzamientos/table';
            $data['page_datatable'] = true;
            $data['page_swalert'] = true;

            $this -> view(['Template/header', 'Lanzamientos/table', 'Template/footer'], $data);
        }

        public function newLanzamiento()
        {
            $this -> isPost();

            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];

            if ( !isset($this -> post['idcurso']) || !isset($this -> post['fecha_inicio']) || !isset($this -> post['fecha_fin']) 
            || !isset($this -> post['costo']) ) 
            {
                json($return);
            }

            $this -> post['idcurso'] = trim($this -> post['idcurso']);
            $this -> post['fecha_inicio'] = trim($this -> post['fecha_inicio']);
            $this -> post['fecha_fin'] = trim($this -> post['fecha_fin']);
            $this -> post['costo'] = trim($this -> post['costo']);

            if ($this -> post['idcurso'] == '') {
                $return['message'] = 'Ingrese un curso válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if (!ctype_digit($this -> post['idcurso'])) {
                json($return);
            }

            $idCurso = intval($this -> post['idcurso']);

            $cursosModel = new CursosModel;
            $cusoIndicado = $cursosModel -> getCursoActivosTableById($idCurso);

            if ($cusoIndicado == false) {
                json($return);
            }

            $timeFechaUno = date_create_from_format('Y-m-d', $this -> post['fecha_inicio']);
            $timeFechaDos = date_create_from_format('Y-m-d', $this -> post['fecha_fin']);

            if ($timeFechaUno == false || $timeFechaDos == false) {
                json($return);
            }

            $lanzamientoModel = new LanzamientoModel;
            $datosLanzamiento = $lanzamientoModel -> getLanzamientosByIdCurso($idCurso, $timeFechaUno -> format('Y-m-d'));

            if ($datosLanzamiento != []) {
                $return['message'] = 'El curso tiene otro lanzamiento activo o las fechas de sus otros lanzamientos se cruzan';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ($timeFechaUno >= $timeFechaDos) {
                $return['message'] = 'Verificar que las fechas de lanzamiento estén ingresados de forma correcta';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $precio = explode('.', $this -> post['costo']);

            if (!isset($precio[1])) {
                $precio[1] = '0';
            }

            if ($precio[1] == '') {
                $precio[1] = '0';
            }

            if ( count($precio) > 2 || !ctype_digit($precio[1]) || !ctype_digit($precio[0]) ) {
                $return['message'] = 'Precio No Válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if (intval($precio[0]) < 0 || intval($precio[0]) > 10000 || intval($precio[1]) < 0 || intval($precio[1]) > 99 ) {
                $return['message'] = 'Precio No Válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $precio = floatval($precio[0] . '.' . $precio[1]);

            $arrayAux = [
                'lanzamiento_curso' => $idCurso,
                'lanzamiento_inicio' => $timeFechaUno -> format('Y-m-d'),
                'lanzamiento_fin' => $timeFechaDos -> format('Y-m-d'),
                'lanzamiento_costo' => $precio
            ];

            $insert = $lanzamientoModel -> value($arrayAux) -> insert();

            if ($insert > 0) {
                $return['status'] = true;
            }

            json($return);
        }
        
        public function getLanzamientos()
        {
            $lanzamientoModel = new LanzamientoModel;
            $lanzamientoData = $lanzamientoModel -> getLanzamientosTable();

            $estado = [
                '<div class="text-center">Culminado</div>',
                '<div class="text-center fw-700 text-success active_lanza">Activo</div>'
            ];

            $tipoBadge = [
                '<div class="text-center"><span class="badge bg-primary">Curso</span></div>',
                '<div class="text-center"><span class="badge bg-warning text-dark">Taller</span></div>'
            ];

            $action = [
                ' d-block',
                '<div class="text-center',
                '"> <a ',
                ' type="button" class="fw-bold btn_ver_lanzamiento text-decoration-none text-primary">Ver Más <i class="fa-solid fa-angles-right"></i></a></div>'
            ];

            foreach ($lanzamientoData as $key => $value)
            {
                $lanzamientoData[$key]['numero'] = $key + 1;
                $lanzamientoData[$key]['tipo_label'] = $tipoBadge[intval($value['curso_tipo'])];
                $lanzamientoData[$key]['lanzamiento_estado'] = $estado[$value['lanzamiento_estado']];
                $lanzamientoData[$key]['inicio_fin'] = '<div class="text-center">' . date('d/m/Y', strtotime($value['lanzamiento_inicio'])) . ' - ' . date('d/m/Y', strtotime($value['lanzamiento_fin'])) . '</div>';
                $lanzamientoData[$key]['lanzamiento_costo'] = '<div class="text-center">S/ ' . $value['lanzamiento_costo'] . '</div>';
                $lanzamientoData[$key]['lanzamiento_creacion'] = date('d-m-Y', strtotime($value['lanzamiento_creacion']));

                $lanzamientoData[$key]['acciones'] = $action[1] . $action[0] . $action[2] .
                'data-idcurso="' . $value['curso_id'] . '"' .
                'data-idlanzamiento="' . $value['lanzamiento_id'] . '"' .
                'data-nombre="' . $value['curso_nombre'] . '"' .
                'data-fecha_inicio="' . $value['lanzamiento_inicio'] . '"' .
                'data-fecha_fin="' . $value['lanzamiento_fin'] . '"' .
                'data-costo="' . $value['lanzamiento_costo'] . '"' .
                'data-creacion="' . $lanzamientoData[$key]['lanzamiento_creacion'] . '"' .
                'data-estado="' . (($value['lanzamiento_estado'] == 1) ? 'ACTIVO' : 'CULMINADO') . '"'
                . $action[3];
                $action[0] = '';

                $lanzamientoData[$key]['lanzamiento_creacion'] = '<div class="text-center">' . $lanzamientoData[$key]['lanzamiento_creacion'] . '</div>';
            }

            json($lanzamientoData);
        }

        public function getTodos()
        {
            $cursosModel = new CursosModel;
            $data = $cursosModel -> getTodosActivosTable();

            $tipoBadge = [
                '<div class="text-center"><span class="badge bg-primary">Curso</span></div>',
                '<div class="text-center"><span class="badge bg-warning text-dark">Taller</span></div>'
            ];

            $estado = [
                '<div class="text-center"><span class="position-relative pe-2">No Publicado<span class="position-absolute top-0 start-100 translate-bottom p-2 bg-info border border-light rounded-circle"></span></span></div>',
                '<div class="text-center"><span class="position-relative pe-2">Publicado<span class="position-absolute top-0 start-100 translate-bottom p-2 bg-success border border-light rounded-circle"></span></span></div>'
            ];

            $action = [' d-block', '<div class="text-center', '"> <a data-id="', '" data-nombre="', '" class="fw-bold text-decoration-none text-primary btn_select_curso" type="button">Elegir <i class="fa-solid fa-hand-pointer"></i></a></div>'];

            foreach ($data as $key => $value)
            {
                $data[$key]['numero']       = $key + 1;
                $data[$key]['tipo_label']   = $tipoBadge[intval($value['curso_tipo'])];
                $data[$key]['curso_publico'] = $estado[intval($value['curso_publico'])];
                $data[$key]['acciones_select'] = $action[1] . $action[0] . $action[2] . $value['curso_id'] . $action[3] . $value['curso_nombre'] . $action[4];
                $action[0] = '';
                $data[$key]['curso_creacion'] = '<div class="text-center">' . date('d-m-Y', strtotime($value['curso_creacion'])) . '</div>';
            }

            json($data);
        }

        public function deleteLanzamiento()
        {
            $this -> isPost();
            
            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];

            if ( !isset($this -> post['idlanzamiento_edit']) ) {
                json($return);
            }

            if ( !ctype_digit($this -> post['idlanzamiento_edit']) ) {
                json($return);
            }

            $idLanzamiento = intval($this -> post['idlanzamiento_edit']);

            $lanzamientoModel = new LanzamientoModel;
            $lanzamientoData = $lanzamientoModel -> getLanzamientosById($idLanzamiento);

            if ($lanzamientoData == false) {
                json($return);
            }

            $update = $lanzamientoModel -> query('UPDATE lanzamiento SET lanzamiento_eliminado = 1, lanzamiento_estado = 0 WHERE lanzamiento_id = :lanzamiento_id');
            $update -> bindValue(':lanzamiento_id', $idLanzamiento);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }

            json($return);
        }

        public function culminarLanzamiento()
        {
            $this -> isPost();
            
            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];

            if ( !isset($this -> post['idlanzamiento_edit']) ) {
                json($return);
            }

            if ( !ctype_digit($this -> post['idlanzamiento_edit']) ) {
                json($return);
            }

            $idLanzamiento = intval($this -> post['idlanzamiento_edit']);

            $lanzamientoModel = new LanzamientoModel;
            $lanzamientoData = $lanzamientoModel -> getLanzamientosById($idLanzamiento);

            if ($lanzamientoData == false) {
                json($return);
            }

            if ($lanzamientoData['lanzamiento_estado'] == 0) {
                $return['status'] = true;
                json($return);
            }

            $update = $lanzamientoModel -> query('UPDATE lanzamiento SET lanzamiento_estado = 0 WHERE lanzamiento_id = :lanzamiento_id');
            $update -> bindValue(':lanzamiento_id', $idLanzamiento);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }

            json($return);
        }

        public function activarLanzamiento()
        {
            $this -> isPost();
            
            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];

            if ( !isset($this -> post['idlanzamiento_edit']) ) {
                json($return);
            }

            if ( !ctype_digit($this -> post['idlanzamiento_edit']) ) {
                json($return);
            }

            $idLanzamiento = intval($this -> post['idlanzamiento_edit']);

            $lanzamientoModel = new LanzamientoModel;
            $lanzamientoData = $lanzamientoModel -> getLanzamientosById($idLanzamiento);

            if ($lanzamientoData == false) {
                json($return);
            }

            if ($lanzamientoData['lanzamiento_estado'] == 1) {
                $return['status'] = true;
                json($return);
            }

            $lanzaActivas = $lanzamientoModel -> getLanzamientosByIdCursoActivo($lanzamientoData['lanzamiento_curso']);

            if ($lanzaActivas != []) {
                $return['message'] = 'El curso tiene otro lanzamiento activo o las fechas de sus otros lanzamientos se cruzan';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $update = $lanzamientoModel -> query('UPDATE lanzamiento SET lanzamiento_estado = 1 WHERE lanzamiento_id = :lanzamiento_id');
            $update -> bindValue(':lanzamiento_id', $idLanzamiento);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }

            json($return);
        }

        public function updateLanzamiento()
        {
            $this -> isPost();

            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];

            if ( !isset($this -> post['idlanzamiento_edit']) || !isset($this -> post['fecha_inicio_edit']) || 
            !isset($this -> post['fecha_fin_edit']) || !isset($this -> post['costo_edit']) ) 
            {
                json($return);
            }

            $this -> post['idlanzamiento_edit'] = trim($this -> post['idlanzamiento_edit']);
            $this -> post['fecha_inicio_edit'] = trim($this -> post['fecha_inicio_edit']);
            $this -> post['fecha_fin_edit'] = trim($this -> post['fecha_fin_edit']);
            $this -> post['costo_edit'] = trim($this -> post['costo_edit']);

            if (!ctype_digit($this -> post['idlanzamiento_edit'])) {
                json($return);
            }

            $idLanzamiento = intval($this -> post['idlanzamiento_edit']);

            $lanzamientoModel = new LanzamientoModel;
            $dataLanzamiento = $lanzamientoModel -> getLanzamientosById($idLanzamiento);

            if ($dataLanzamiento == false) {
                json($return);
            }

            if ( $dataLanzamiento['lanzamiento_inicio'] == $this -> post['fecha_inicio_edit'] && 
            $dataLanzamiento['lanzamiento_fin'] == $this -> post['fecha_fin_edit'] &&
            $dataLanzamiento['lanzamiento_costo'] == $this -> post['costo_edit'] ) 
            {
                $return['status'] = true;
                json($return);
            }
            
            $timeFechaUno = date_create_from_format('Y-m-d', $this -> post['fecha_inicio_edit']);
            $timeFechaDos = date_create_from_format('Y-m-d', $this -> post['fecha_fin_edit']);

            if ($timeFechaUno == false || $timeFechaDos == false) {
                json($return);
            }

            if ($timeFechaUno >= $timeFechaDos) {
                $return['message'] = 'Verificar que las fechas de lanzamiento estén ingresados de forma correcta';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $precio = explode('.', $this -> post['costo_edit']);

            if (!isset($precio[1])) {
                $precio[1] = '0';
            }

            if ($precio[1] == '') {
                $precio[1] = '0';
            }

            if ( count($precio) > 2 || !ctype_digit($precio[1]) || !ctype_digit($precio[0]) ) {
                $return['message'] = 'Precio No Válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if (intval($precio[0]) < 0 || intval($precio[0]) > 10000 || intval($precio[1]) < 0 || intval($precio[1]) > 99 ) {
                $return['message'] = 'Precio No Válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $precio = floatval($precio[0] . '.' . $precio[1]);

            $update = $lanzamientoModel -> query('UPDATE lanzamiento SET lanzamiento_inicio = :lanzamiento_inicio, lanzamiento_fin = :lanzamiento_fin, lanzamiento_costo = :lanzamiento_costo WHERE lanzamiento_id = :lanzamiento_id');
            $update -> bindValue(':lanzamiento_id', $idLanzamiento);
            $update -> bindValue(':lanzamiento_costo', $precio);
            $update -> bindValue(':lanzamiento_inicio', $timeFechaUno -> format('Y-m-d'));
            $update -> bindValue(':lanzamiento_fin', $timeFechaDos -> format('Y-m-d'));
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }

            json($return);
        }
    }
    