<?php

    namespace FNPERU\Controllers;
    use ADMINFN\Models\FNPeru\SolicitudMatriculaModel;
    use FNPERU\Core\BaseController;
    use FNPERU\Helpers\Helper;

    class SolicitudMatricula extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function enviar()
        {
            $this -> isPost();
            
            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];
            
            if ( !isset($this -> post['id_curso']) || !isset($this -> post['dni']) || !isset($this -> post['nombres']) || 
            !isset($this -> post['apellido_paterno']) || !isset($this -> post['apellido_materno']) || !isset($this -> post['celular']) || 
            !isset($this -> post['email']) || !isset($this -> post['residencia_lugar']) || 
            !isset($this -> post['residencia_direccion']) || !isset($this -> files['vaucher']) || !isset($this -> post['mensaje']) ) {
                json($return);
            }

            $idCurso = trim($this -> post['id_curso']);
            $dniAlumno = trim($this -> post['dni']);
            $nombreAlumno = trim($this -> post['nombres']);
            $apellidoPaterno = trim($this -> post['apellido_paterno']);
            $apellidoMaterno = trim($this -> post['apellido_materno']);
            $celularAlumno = str_replace(' ', '', $this -> post['celular']);
            $emailAlumno = trim($this -> post['email']);
            $residenciaLugar = trim($this -> post['residencia_lugar']);
            $residenciaDireccion = trim($this -> post['residencia_direccion']);
            $vaucherAlumno = $this -> files['vaucher'];
            $mensajeAlumno = trim($this -> post['mensaje']);

            if (!ctype_digit($idCurso)) {
                json($return);
            }

            $idCurso = intval($idCurso);

            if (!ctype_digit($dniAlumno) || strlen($dniAlumno) != 8) {
                $return['message'] = 'DNI no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ( mb_strlen($nombreAlumno) > 140 || mb_strlen($nombreAlumno) < 2 || !isAlphaDash($nombreAlumno, ' ()[]-_.,;:') ) {
                $return['message'] = 'Nombre no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $nombreAlumno = mb_ucfirst(mb_strtolower($nombreAlumno));

            if ( mb_strlen($apellidoPaterno) > 140 || mb_strlen($apellidoPaterno) < 2 || !isAlphaDash($apellidoPaterno, ' ()[]-_.,;:') ) {
                $return['message'] = 'Apellido Paterno no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $apellidoPaterno = mb_ucfirst(mb_strtolower($apellidoPaterno));

            if ( mb_strlen($apellidoMaterno) > 140 || mb_strlen($apellidoMaterno) < 2 || !isAlphaDash($apellidoMaterno, ' ()[]-_.,;:') ) {
                $return['message'] = 'Apellido Materno no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $apellidoMaterno = mb_ucfirst(mb_strtolower($apellidoMaterno));

            if (!ctype_digit($celularAlumno) || strlen($celularAlumno) != 9) {
                $return['message'] = 'Celular no válido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ( mb_strlen($residenciaLugar) > 180 || mb_strlen($residenciaLugar) < 2 || !isAlphaDash($residenciaLugar, " ()[]-_.°,;#@$\\\"/=+':`") ) 
            {
                $return['message'] = 'Lugar de Residencia no válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ( mb_strlen($residenciaDireccion) > 180 || mb_strlen($residenciaDireccion) < 2 || !isAlphaDash($residenciaDireccion, " (#$@)[/=+\]°`\\\"'-_.,;:") ) 
            {
                $return['message'] = 'Dirección de Residencia no válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ($emailAlumno == '') {
                $emailAlumno = null;
            } 
            else 
            {
                if ( mb_strlen($emailAlumno) > 180 || mb_strlen($emailAlumno) < 5 || !isAlphaDash($emailAlumno, ' ()[]-_.°=+,;:@') 
                || !filter_var($emailAlumno, FILTER_VALIDATE_EMAIL) ) 
                {
                    $return['message'] = 'Correo Electrónico no válido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
            }

            if ($mensajeAlumno == '') {
                $mensajeAlumno = null;
            } 
            else 
            {
                if ( mb_strlen($mensajeAlumno) > 400 || mb_strlen($mensajeAlumno) < 5 || !isAlphaDash($mensajeAlumno, " ()$[%*]-_#°`=+.,\\\"/;:'@") ) 
                {
                    $return['message'] = 'Mensaje no válido. Puede que el mensaje sea muy largo o tiene algún signo no permitido';
                    $return['title'] = 'ALERTA';
                    $return['type'] = 'warning';
                    json($return);
                }
            }
            
            if (!isset($vaucherAlumno['error']) || !isset($vaucherAlumno['name']) || !isset($vaucherAlumno['size']) || !isset($vaucherAlumno['tmp_name']) || !isset($vaucherAlumno['type'])) 
            {
                $return['message'] = 'La foto del Voucher no es válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }
            
            if ($vaucherAlumno['error'] !== 0 || ($vaucherAlumno['type'] !== 'image/jpeg' && $vaucherAlumno['type'] !== 'image/png') || intval($vaucherAlumno['size']) <= 100) 
            {
                $return['message'] = 'La foto del Voucher no es válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }
            
            $extension = getExtension($vaucherAlumno['name']);
            $newName = nameForFiles($dniAlumno, $extension) . '.' . $extension;
            
            if (trim($extension) == '' || trim($newName) == '') 
            {
                $return['message'] = 'La foto del Voucher no es válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $newName = date('ynjGis') . rand(100, 999) . '_' . $newName;
            $newPath = Helper::base_path() . '/../admin_fnperu/Writable/Images/VaucherSolMatricula/' . $newName;
            
            $auxMoveFile = move_uploaded_file($vaucherAlumno['tmp_name'], $newPath);
            
            if ($auxMoveFile !== true) {
                $return['message'] = 'Error al guardar la foto del Voucher';
                json($return);
            }

            $arrayAux = [
                'sol_curso_id' => $idCurso,
                'sol_dni' => $dniAlumno,
                'sol_nombres' => $nombreAlumno,
                'sol_apellido_paterno' => $apellidoPaterno,
                'sol_apellido_materno' => $apellidoMaterno,
                'sol_celular' => $celularAlumno,
                'sol_correo' => $emailAlumno,
                'sol_lugar_residencia' => $residenciaLugar,
                'sol_direccion_residencia' => $residenciaDireccion,
                'sol_vaucher' => $newName,
                'sol_mensaje' => $mensajeAlumno
            ];

            $solicitudes = new SolicitudMatriculaModel;
            $insert = $solicitudes -> value($arrayAux) -> insert();
            
            if ($insert > 0) {
                $return['status'] = true;
            }
            json($return);
        }
    }
    