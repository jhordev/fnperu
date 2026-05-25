<?php

    namespace FNPERU\Controllers;

    use ADMINFN\Models\FNPeru\BeneficioCursoModel;
    use FNPERU\Core\BaseController;
    use ADMINFN\Models\FNPeru\CursosModel;
    use ADMINFN\Models\FNPeru\MaterialModel;
    use ADMINFN\Models\FNPeru\ModuloCursoModel;

    class Talleres extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function listado()
        {
            $data['page_title'] = 'Nuestros Talleres';
            $data['page_active'] = 'talleres';
            $data['page_css'] = 'pages/nuestros-cursos'; // Reuses courses listing styles
            $data['icofont'] = true;

            $cursos = new CursosModel;
            $allCursos = $cursos -> getLastCursosPublicados();
            
            // Filter: name must contain 'taller' (case-insensitive)
            $data['talleres'] = array_values(array_filter($allCursos, function($c) {
                return stripos($c['curso_nombre'], 'taller') !== false;
            }));

            $cursosConLanzaRaw = $cursos -> getLastCursosPublicadosConPrecio(date('Y-m-d'));
            $cursosConLanza = array_values(array_filter($cursosConLanzaRaw, function($c) {
                return stripos($c['curso_nombre'], 'taller') !== false;
            }));

            $newArrayLanza = array();
            $auxIdCurso = null;
            $idArrayCursosConLanza = [];

            foreach ($cursosConLanza as $key => $value)
            {
                if ($auxIdCurso != $value['curso_id'])
                {
                    $auxIdCurso = $value['curso_id'];
                    $idArrayCursosConLanza[$auxIdCurso] = true;

                    $datetime1 = new \DateTime($value['lanzamiento_inicio']);
                    $datetime2 = new \DateTime($value['lanzamiento_fin']);
                    $interval = $datetime1 -> diff($datetime2);

                    $value['lanz_duracion'] = $interval -> format('%m');
                    $value['lanz_duracion'] = ($value['lanz_duracion'] < 10) ? '0' . $value['lanz_duracion'] : $value['lanz_duracion'];

                    if ($value['lanz_duracion'] == 1 && $value['lanz_duracion'] != 0) {
                        $value['lanz_duracion'] .= ' Mes';
                    }

                    if ($value['lanz_duracion'] == 0) {
                        $value['lanz_duracion'] = $interval -> format('%d');

                        $value['lanz_duracion'] = ($value['lanz_duracion'] < 10) ? '0' . $value['lanz_duracion'] : $value['lanz_duracion'];

                        if ($value['lanz_duracion'] == 1) {
                            $value['lanz_duracion'] .= ' Día';
                        } else {
                            $value['lanz_duracion'] .= ' Días';
                        }
                    }
                    else if($value['lanz_duracion'] != 1)
                    {
                        $value['lanz_duracion'] .= ' Meses';
                    }

                    $newArrayLanza[] = $value;
                }
            }

            $countDataCurso = count($data['talleres']);

            for ($index = 0; $index  < $countDataCurso; $index ++)
            {
                if ( isset($idArrayCursosConLanza[$data['talleres'][$index]['curso_id']]) )
                {
                    array_splice($data['talleres'], $index, 1);
                    $countDataCurso--;
                    $index--;
                }
            }

            $countLanza = count($newArrayLanza);

            for ($index = ($countLanza - 1); $index >= 0; $index--) {
                array_unshift($data['talleres'], $newArrayLanza[$index]);
            }

            $this -> view(['WebTemplate/header', 'Talleres/listado', 'WebTemplate/footer'], $data);
        }

        public function ver(int $idTaller)
        {
            $cursos = new CursosModel;
            $data['curso'] = $cursos -> getCursoActivosPublicadosTableById($idTaller);

            if ($data['curso'] == false) {
                redirect($this -> base_url() . '/talleres');
            }

            // If it's a course and not a workshop, redirect to courses/ver
            if (stripos($data['curso']['curso_nombre'], 'taller') === false) {
                redirect($this -> base_url() . '/cursos/ver/' . $idTaller);
            }

            $dataLanza = $cursos -> getCursoPublicadoConPrecioByIdCurso($idTaller, date('Y-m-d'));

            if ($dataLanza != false)
            {
                $dataLanza['lanzamiento_inicio'] = date('d/m/Y', strtotime($dataLanza['lanzamiento_inicio']));
            }

            $data['dataLanza'] = $dataLanza;

            $auxClass = new MaterialModel;
            $data['materiales'] = $auxClass -> getMaterialesByCurso($idTaller);

            $auxClass = new BeneficioCursoModel;
            $data['beneficios'] = $auxClass -> getBeneficiosByCurso($idTaller);

            $auxClass = new ModuloCursoModel;
            $data['contenido'] = $auxClass -> getModulosConIndicadorByCursoINNER($idTaller);

            $data['page_title'] = $data['curso']['curso_nombre'];
            $data['page_active'] = 'talleres';
            $data['page_swalert'] = true;
            $data['icofont'] = true;
            $data['icomoon'] = true;
            $data['page_css'] = 'pages/ver-curso'; // Reuse courses details styling
            $data['page_js'] = 'cursos/ver_curso';  // Reuse courses details JS

            $this -> view(['WebTemplate/header', 'Cursos/detalle_curso', 'WebTemplate/footer'], $data);
        }
    }
