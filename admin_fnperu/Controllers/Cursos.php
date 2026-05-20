<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;
    use ADMINFN\Helpers\Helper;
    use ADMINFN\Models\FNPeru\BeneficioCursoModel;
    use ADMINFN\Models\FNPeru\CursosModel;
    use ADMINFN\Models\FNPeru\IndicadorModuloCursoModel;
    use ADMINFN\Models\FNPeru\MaterialModel;
    use ADMINFN\Models\FNPeru\ModuloCursoModel;

    class Cursos extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $this -> verifyLogin();
        }

        public function index()
        {
            $data['page_title'] = 'Cursos';
            $data['page_active'] = 'cursos';
            $data['page_css'] = 'cursos/cursos';
            $data['page_js'] = 'cursos/cursos';
            $data['page_datatable'] = true;

            $this -> view(['Template/header', 'Cursos/cursos', 'Template/footer'], $data);
        }
        
        public function ordenar()
        {
            $data['page_title'] = 'Ordenar Cursos';
            $data['page_active'] = 'cursos';
            // $data['page_css'] = 'cursos/cursos';
            $data['page_js'] = 'cursos/ordenarcursos';
            $data['page_sortable'] = true;
            // $data['page_datatable'] = true;

            $cursos = new CursosModel;
            $data['cursos'] = $cursos -> getLastCursosPublicados();

            $this -> view(['Template/header', 'Cursos/ordenarcursos', 'Template/footer'], $data);
        }
        
        public function ponerOrden()
        {
            $this -> isPost();
            
            $return = [];
            $return['status'] = false;

            if ($this -> post['data'] == '') {
                json($return);
            }

            $dataOrden = explode('-', $this -> post['data']);

            if ($dataOrden == []) {
                json($return);
            }

            foreach ($dataOrden as $key => $value) {
                if (!ctype_digit($value)) {
                    json($return);
                }
            }

            $cursos = new CursosModel;

            foreach ($dataOrden as $key => $value) 
            {
                $update = $cursos -> query('UPDATE cursos SET curso_orden = :curso_orden WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_orden', $key);
                $update -> bindValue(':curso_id', $value);
                $result = $update -> execute();
                
                if ($result !== true) {
                    json($return);
                }
            }

            $return['status'] = true;
            json($return);
        }

        public function editar(int $idCurso)
        {
            $data['page_title'] = 'Editar Curso';
            $data['page_active'] = 'cursos';
            $data['page_js'] = 'cursos/editar';
            $data['page_css'] = 'cursos/editar';
            $data['page_swalert'] = true;
            $data['page_sortable'] = true;
            
            $cursos = new CursosModel;
            $data['curso'] = $cursos -> getCursoActivosTableById($idCurso);

            if ($data['curso'] == false) {
                redirect($this -> base_url() . '/cursos');
            }

            $auxClass = new MaterialModel;
            $data['materiales'] = $auxClass -> getMaterialesByCurso($idCurso);

            $auxClass = new BeneficioCursoModel;
            $data['beneficios'] = $auxClass -> getBeneficiosByCurso($idCurso);

            $auxClass = new ModuloCursoModel;
            $data['modulos'] = $auxClass -> getModulosConIndicadorByCurso($idCurso);
            
            $this -> view(['Template/header', 'Cursos/edit', 'Template/footer'], $data);
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

            $this -> post['id'] = intval($this -> post['id']);

            if($this -> post['action'] == 'image') {
                $this -> post['data'] = 'image';
            }

            if($this -> post['action'] == 'brochure') {
                $this -> post['data'] = 'brochure';
            }

            if (!isset($this -> post['data'])) {
                json($return);
            }

            $this -> post['data'] = trim($this -> post['data'] );

            $cursos = new CursosModel;
            $dataCurso = $cursos -> getCursoActivosTableById($this -> post['id']);

            if ($dataCurso == false) {
                json($return);
            }

            if ($this -> post['action'] == 'name') 
            {
                if ($this -> post['data'] == $dataCurso['curso_nombre']) {
                    $return['status'] = true;
                    json($return);
                }

                if ( mb_strlen($this -> post['data']) > 198 || mb_strlen($this -> post['data']) < 5 || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                    $return['message'] = 'Nombre del curso no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_nombre = :curso_nombre WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_nombre', $this -> post['data']);
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'video') 
            {
                $video = trim($this -> post['data']);

                $video = explode( 'https://www.youtube.com/watch?v=', $video);
                
                if (count($video) > 1) {
                    if (trim($video[1]) != '') {
                        $video = explode('&', $video[1]);
                        $video = trim($video[0]);
                        if ($video == '') {
                            $video = null;
                        }
                    } else {
                        $video = null;
                    }
                } else {
                    $video = null;
                }

                if ($video == null) 
                {
                    $video = trim($this -> post['data']);

                    $video = explode( 'https://youtu.be/', $video);
                    
                    if (count($video) > 1) {
                        if (trim($video[1]) != '') {
                            $video = explode('&', $video[1]);
                            $video = trim($video[0]);
                            if ($video == '') {
                                $video = null;
                            }
                        } else {
                            $video = null;
                        }
                    } else {
                        $video = null;
                    }
                }

                if ($video == null) {
                    $return['message'] = 'Link del no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                if ( mb_strlen($video) > 20 || mb_strlen($video) < 3 || !isAlphaDash($video, ' ()[]-_.,;:') ) {
                    $return['message'] = 'Link del no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
                
                if ($video == $dataCurso['curso_video']) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_video = :curso_video WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_video', $video);
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'orden_material') 
            {
                if ($this -> post['data'] == '') {
                    json($return);
                }

                $dataOrden = explode('-', $this -> post['data']);

                if ($dataOrden == []) {
                    json($return);
                }

                foreach ($dataOrden as $key => $value) {
                    if (!ctype_digit($value)) {
                        json($return);
                    }
                }

                foreach ($dataOrden as $key => $value) 
                {
                    $update = $cursos -> query('UPDATE material_entregado SET material_orden = :material_orden WHERE material_id = :material_id AND material_curso_id = :material_curso_id');
                    $update -> bindValue(':material_orden', $key);
                    $update -> bindValue(':material_id', $value);
                    $update -> bindValue(':material_curso_id', $this -> post['id']);
                    $result = $update -> execute();
                    
                    if ($result !== true) {
                        json($return);
                    }
                }

                $return['status'] = true;
                json($return);
            }

            if ($this -> post['action'] == 'orden_bienes') 
            {
                if ($this -> post['data'] == '') {
                    json($return);
                }

                $dataOrden = explode('-', $this -> post['data']);

                if ($dataOrden == []) {
                    json($return);
                }

                foreach ($dataOrden as $key => $value) {
                    if (!ctype_digit($value)) {
                        json($return);
                    }
                }

                foreach ($dataOrden as $key => $value) 
                {
                    $update = $cursos -> query('UPDATE beneficio_curso SET beneficio_orden = :beneficio_orden WHERE beneficio_id = :beneficio_id AND beneficio_curso_id = :beneficio_curso_id');
                    $update -> bindValue(':beneficio_orden', $key);
                    $update -> bindValue(':beneficio_id', $value);
                    $update -> bindValue(':beneficio_curso_id', $this -> post['id']);
                    $result = $update -> execute();
                    
                    if ($result !== true) {
                        json($return);
                    }
                }

                $return['status'] = true;
                json($return);
            }

            if ($this -> post['action'] == 'orden_modulos') 
            {
                if ($this -> post['data'] == '') {
                    json($return);
                }

                $dataOrden = explode('-', $this -> post['data']);

                if ($dataOrden == []) {
                    json($return);
                }

                foreach ($dataOrden as $key => $value) {
                    if (!ctype_digit($value)) {
                        json($return);
                    }
                }

                foreach ($dataOrden as $key => $value) 
                {
                    $update = $cursos -> query('UPDATE modulos_curso_web SET mod_orden = :mod_orden WHERE mod_id = :mod_id AND mod_curso_id = :mod_curso_id');
                    $update -> bindValue(':mod_orden', $key);
                    $update -> bindValue(':mod_id', $value);
                    $update -> bindValue(':mod_curso_id', $this -> post['id']);
                    $result = $update -> execute();
                    
                    if ($result !== true) {
                        json($return);
                    }
                }

                $return['status'] = true;
                json($return);
            }

            if ($this -> post['action'] == 'orden_indicadores') 
            {
                if ($this -> post['data'] == '') {
                    json($return);
                }

                $dataOrden = explode('-', $this -> post['data']);

                if ($dataOrden == []) {
                    json($return);
                }

                foreach ($dataOrden as $key => $value) {
                    if (!ctype_digit($value)) {
                        json($return);
                    }
                }

                foreach ($dataOrden as $key => $value) 
                {
                    $update = $cursos -> query('UPDATE indicadores_modulos SET ind_orden = :ind_orden WHERE ind_id = :ind_id');
                    $update -> bindValue(':ind_orden', $key);
                    $update -> bindValue(':ind_id', $value);
                    $result = $update -> execute();
                    
                    if ($result !== true) {
                        json($return);
                    }
                }

                $return['status'] = true;
                json($return);
            }

            if ($this -> post['action'] == 'intro_uno') 
            {
                if ($this -> post['data'] == $dataCurso['curso_introduccion']) {
                    $return['status'] = true;
                    json($return);
                }

                if ( mb_strlen($this -> post['data']) > 498 || ($this -> post['data']  != '' && mb_strlen($this -> post['data']) < 15)  || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                    $return['message'] = 'Introducción 1 no valida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_introduccion = :curso_introduccion WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_introduccion', $this -> post['data']);
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'intro_dos') 
            {
                if ($this -> post['data'] == $dataCurso['curso_introduccion_dos']) {
                    $return['status'] = true;
                    json($return);
                }

                if ( mb_strlen($this -> post['data']) > 990 || ($this -> post['data']  != '' && mb_strlen($this -> post['data']) < 15)  || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                    $return['message'] = 'Introducción 2 no valida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_introduccion_dos = :curso_introduccion_dos WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_introduccion_dos', $this -> post['data']);
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'publicar') 
            {
                if ($dataCurso['curso_publico'] == 1) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_publico = 1 WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'publicar_video') 
            {
                if ($dataCurso['curso_video_habil'] == 1) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_video_habil = 1 WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'add_material') 
            {
                if ( mb_strlen($this -> post['data']) > 198 || mb_strlen($this -> post['data']) < 5 || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                    $return['message'] = 'Nombre del Material no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
                
                $arrayAux = [
                    'material_curso_id' => $this -> post['id'],
                    'material_nombre' => $this -> post['data'],
                    'material_orden' => 127
                ];

                $materialModel = new MaterialModel;
                $insert = $materialModel -> value($arrayAux) -> insert();
                
                if ($insert > 0) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'add_modulo') 
            { 
                if ( mb_strlen($this -> post['data']) > 198 || mb_strlen($this -> post['data']) < 5 || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                    $return['message'] = 'Nombre del Módulo no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $arrayAux = [
                    'mod_curso_id' => $this -> post['id'],
                    'mod_nombre' => $this -> post['data'],
                    'mod_orden' => 127
                ];

                $moduloModel = new ModuloCursoModel;
                $insert = $moduloModel -> value($arrayAux) -> insert();
                
                if ($insert > 0) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'add_indicador') 
            { 
                $arrayData = explode('--||--', $this -> post['data']);

                if (!isset($arrayData[0]) || !isset($arrayData[1])) {
                    json($return);
                }

                $nameIndicador = trim($arrayData[0]);
                $idModulo = $arrayData[1];

                if (!ctype_digit($idModulo)) {
                    json($return);
                }

                if ( mb_strlen($nameIndicador) > 198 || mb_strlen($nameIndicador) < 5 || !isAlphaDash($nameIndicador, ' ()[]-_.,;:') ) {
                    $return['message'] = 'Nombre del Indicador no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $arrayAux = [
                    'ind_modulo_id' => $idModulo,
                    'ind_nombre' => $nameIndicador,
                    'ind_orden' => 127
                ];

                $moduloModel = new IndicadorModuloCursoModel;
                $insert = $moduloModel -> value($arrayAux) -> insert();
                
                if ($insert > 0) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'delete_material') 
            {
                if ( !ctype_digit($this -> post['data']) ) {
                    json($return);
                }

                $materialModel = new MaterialModel;
                $update = $materialModel -> query('DELETE FROM material_entregado WHERE material_curso_id = :material_curso_id AND material_id = :material_id');
                $update -> bindValue(':material_curso_id', $this -> post['id']);
                $update -> bindValue(':material_id', $this -> post['data']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'delete_indicador') 
            {
                if ( !ctype_digit($this -> post['data']) ) {
                    json($return);
                }

                $materialModel = new MaterialModel;
                $update = $materialModel -> query('DELETE FROM indicadores_modulos WHERE ind_id = :ind_id');
                $update -> bindValue(':ind_id', $this -> post['data']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'add_beneficio') 
            {
                if ( mb_strlen($this -> post['data']) > 198 || mb_strlen($this -> post['data']) < 5 || !isAlphaDash($this -> post['data'], ' ()[]-_.,;:') ) {
                    $return['message'] = 'Nombre del Beneficio no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $arrayAux = [
                    'beneficio_curso_id' => $this -> post['id'],
                    'beneficio_nombre' => $this -> post['data'],
                    'beneficio_orden' => 127
                ];

                $beneficioModel = new BeneficioCursoModel;
                $insert = $beneficioModel -> value($arrayAux) -> insert();

                if ($insert > 0) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'delete_bien') 
            {
                if ( !ctype_digit($this -> post['data']) ) {
                    json($return);
                }

                $beneficioModel = new BeneficioCursoModel;
                $update = $beneficioModel -> query('DELETE FROM beneficio_curso WHERE beneficio_curso_id = :beneficio_curso_id AND beneficio_id = :beneficio_id');
                $update -> bindValue(':beneficio_curso_id', $this -> post['id']);
                $update -> bindValue(':beneficio_id', $this -> post['data']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'delete_modulo') 
            {
                if ( !ctype_digit($this -> post['data']) ) {
                    json($return);
                }

                $modelAux = new IndicadorModuloCursoModel;
                $indicadores = $modelAux -> getIndicadoresByModulo($this -> post['data']);

                if ($indicadores != []) {
                    $return['message'] = 'Para eliminar un módulo, este no debe tener algún indicador asociado';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
                
                $update = $modelAux -> query('DELETE FROM modulos_curso_web WHERE mod_curso_id = :mod_curso_id AND mod_id = :mod_id');
                $update -> bindValue(':mod_curso_id', $this -> post['id']);
                $update -> bindValue(':mod_id', $this -> post['data']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'ocultar') 
            {
                if ($dataCurso['curso_publico'] == 0) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_publico = 0 WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'ocultar_video') 
            {
                if ($dataCurso['curso_video_habil'] == 0) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_video_habil = 0 WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'delete_curso') 
            {
                if ($dataCurso['curso_estado'] == 0) {
                    $return['status'] = true;
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_estado = 0, curso_publico = 0 WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'image') 
            {
                if (!isset($this -> files['data']['error']) || !isset($this -> files['data']['name']) || !isset($this -> files['data']['size']) || !isset($this -> files['data']['tmp_name']) || !isset($this -> files['data']['type'])) 
                {
                    $return['message'] = 'Imagen no válida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
                
                if ($this -> files['data']['error'] !== 0 || ($this -> files['data']['type'] !== 'image/jpeg' && $this -> files['data']['type'] !== 'image/png') || intval($this -> files['data']['size']) <= 100)
                {
                    $return['message'] = 'Archivo no válido. Solo se permiten imágenes JPG o PNG.';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                if (intval($this -> files['data']['size']) > 5 * 1024 * 1024)
                {
                    $return['message'] = 'La imagen supera el tamaño máximo permitido de 5 MB.';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $extension = getExtension($this -> files['data']['name']);
                $newName = nameForFiles($dataCurso['curso_nombre'], $extension) . '.' . $extension;
                
                if (trim($extension) == '' || trim($newName) == '') 
                {
                    $return['message'] = 'Imagen no válida';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $newName = date('ynjGis') . rand(100, 999) . '_' . $newName;
                $newPath = Helper::public_path() . '/assets/admin/images/cursos/' . $newName;
                
                $auxMoveFile = move_uploaded_file($this -> files['data']['tmp_name'], $newPath);

                if ($auxMoveFile !== true) {
                    $return['message'] = 'Error al guardar la imagen';
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_img_main = :curso_img_main WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_img_main', $newName);
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }

            if ($this -> post['action'] == 'brochure') 
            {
                if (!isset($this -> files['data']['error']) || !isset($this -> files['data']['name']) || !isset($this -> files['data']['size']) || !isset($this -> files['data']['tmp_name']) || !isset($this -> files['data']['type'])) 
                {
                    $return['message'] = 'PDF no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
                
                if ($this -> files['data']['error'] !== 0 || $this -> files['data']['type'] !== 'application/pdf' || intval($this -> files['data']['size']) <= 100)
                {
                    $return['message'] = 'Archivo no válido. Asegúrese de seleccionar un PDF.';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                if (intval($this -> files['data']['size']) > 5 * 1024 * 1024)
                {
                    $return['message'] = 'El PDF supera el tamaño máximo permitido de 5 MB.';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
                
                $extension = getExtension($this -> files['data']['name']);
                $newName = nameForFiles($dataCurso['curso_nombre'], $extension) . '.' . $extension;
                
                if (trim($extension) == '' || trim($newName) == '') 
                {
                    $return['message'] = 'PDF no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }

                $newName = date('ynjGis') . rand(100, 999) . '_' . $newName;
                $newPath = Helper::public_path() . '/assets/admin/docs/brochure/' . $newName;
                
                $auxMoveFile = move_uploaded_file($this -> files['data']['tmp_name'], $newPath);

                if ($auxMoveFile !== true) {
                    $return['message'] = 'Error al guardar el PDF';
                    json($return);
                }

                $update = $cursos -> query('UPDATE cursos SET curso_brochure = :curso_brochure WHERE curso_id = :curso_id');
                $update -> bindValue(':curso_brochure', $newName);
                $update -> bindValue(':curso_id', $this -> post['id']);
                $result = $update -> execute();

                if ($result === true && $update -> rowCount() === 1) {
                    $return['status'] = true;
                }
                json($return);
            }
            
            json($return);
        }

        public function newCurso()
        {
            $this -> isPost();

            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'id' => 0,
                'type' => 'danger'
            ];

            if (!isset($this -> post['curso']) || 
            ( isset($this -> post['curso']) && 
            ( mb_strlen($this -> post['curso']) > 198 || mb_strlen($this -> post['curso']) < 5 || !isAlphaDash($this -> post['curso'], ' ()[]-_.,;:')) ) ) 
            {
                $return['message'] = 'Nombre del curso no valido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }
            
            $nombreCurso = $this -> post['curso'];

            $cursos = new CursosModel;
            $insert = $cursos -> value(['curso_nombre' => $nombreCurso]) -> insert();

            if ($insert > 0) {
                $return['status'] = true;
                $return['id'] = $insert;
            }

            json($return); 
        }

        public function getCursosActivos()
        {
            $cursos = new CursosModel;
            $cursosData = $cursos -> getCursosActivosTable();

            $sinBrochure = '<div class="text-center">No Tiene</div>';
            $estado = [
                '<div class="text-center">
                    <span class="position-relative pe-2">
                        No Publicado
                
                        <span class="position-absolute top-0 start-100 translate-bottom p-2 bg-info border border-light rounded-circle">
                            <span class="visually-hidden"></span>
                        </span>
                    </span>
                </div>', 
                '<div class="text-center">
                    <span class="position-relative pe-2">
                        Publicado
                
                        <span class="position-absolute top-0 start-100 translate-bottom p-2 bg-success border border-light rounded-circle">
                            <span class="visually-hidden"></span>
                        </span>
                    </span>
                </div>'
            ];

            $action = [
                ' d-block', 
                '<div class="text-center', 
                '"> <a href="' . $this -> base_url() . '/cursos/editar/',
                '" class="fw-bold text-decoration-none text-primary">Ver Más <i class="fa-solid fa-angles-right"></i></a>
                </div>'
            ];

            $actionDos = [
                ' d-block', 
                '<div class="text-center', 
                '"> <a data-id="',
                '" data-nombre="',
                '" class="fw-bold text-decoration-none text-primary btn_select_curso" type="button">Elegir <i class="fa-solid fa-hand-pointer"></i></a>
                </div>'
            ];

            $linkBrochure = [
                '<div class="text-center">
                    <a target="_blank" href="' . Helper::assets_url() . '/admin/docs/brochure/',
                '" class="fw-bold text-decoration-none">Ver Brochure <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </div>'
            ];
            
            foreach ($cursosData as $key => $value) 
            { 
                $cursosData[$key]['numero'] = $key + 1;
                $cursosData[$key]['curso_brochure'] = ($value['curso_brochure'] == '') ? $sinBrochure : $linkBrochure[0] . $cursosData[$key]['curso_brochure'] . $linkBrochure[1];
                $cursosData[$key]['curso_publico'] = $estado[$value['curso_publico']];
                $cursosData[$key]['acciones'] = $action[1] . $action[0] . $action[2] . $value['curso_id'] . $action[3];
                $action[0] = '';
                
                $cursosData[$key]['acciones_select'] = $actionDos[1] . $actionDos[0] . $actionDos[2] . $value['curso_id'] . $actionDos[3] . $value['curso_nombre'] . $actionDos[4];
                $actionDos[0] = '';

                $cursosData[$key]['curso_creacion'] = '<div class="text-center">' . date('d-m-Y', strtotime($value['curso_creacion'])) . '</div>';
            }

            json($cursosData);
        }
    }
    