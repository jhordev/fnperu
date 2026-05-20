<?php

    namespace FNPERU\Controllers;

    use ADMINFN\Models\FNPeru\BeneficioCursoModel;
    use ADMINFN\Models\FNPeru\UrbanizationModel;
    use FNPERU\Core\BaseController;
    use ADMINFN\Models\FNPeru\CursosModel;
    use ADMINFN\Models\FNPeru\MaterialModel;
    use ADMINFN\Models\FNPeru\ModuloCursoModel;

    class Cursos extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            $data['page_title'] = '';
            $data['page_active'] = 'inicio';
            $data['page_owl'] = true;
            $data['page_css'] = 'pages/inicio';
            $data['page_js'] = 'cursos/inicio';
            $data['icofont'] = true;

            $urbanization = new UrbanizationModel();
            $data['urbanization'] = $urbanization -> getLast();

            $cursos = new CursosModel;
            $data['cursos'] = $cursos -> getLastCursosPublicados();
            $cursosConLanza = $cursos -> getLastCursosPublicadosConPrecio(date('Y-m-d'));
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

            $countDataCurso = count($data['cursos']);

            for ($index = 0; $index  < $countDataCurso; $index ++)
            {
                if ( isset($idArrayCursosConLanza[$data['cursos'][$index]['curso_id']]) )
                {
                    array_splice($data['cursos'], $index, 1);
                    $countDataCurso--;
                    $index--;
                }
            }

            $countLanza = count($newArrayLanza);

            for ($index = ($countLanza - 1); $index >= 0; $index--) {
                array_unshift($data['cursos'], $newArrayLanza[$index]);
            }

            //json($data['cursos']);

            $this -> view(['WebTemplate/header', 'Cursos/inicio', 'WebTemplate/footer'], $data);
        }

        public function ver(int $idCurso)
        {
            $cursos = new CursosModel;
            $data['curso'] = $cursos -> getCursoActivosPublicadosTableById($idCurso);

            if ($data['curso'] == false) {
                redirect($this -> base_url() . '/#cursos');
            }

            $dataLanza = $cursos -> getCursoPublicadoConPrecioByIdCurso($idCurso, date('Y-m-d'));

            if ($dataLanza != false)
            {
                $dataLanza['lanzamiento_inicio'] = date('d/m/Y', strtotime($dataLanza['lanzamiento_inicio']));
            }

            $data['dataLanza'] = $dataLanza;

            $auxClass = new MaterialModel;
            $data['materiales'] = $auxClass -> getMaterialesByCurso($idCurso);

            $auxClass = new BeneficioCursoModel;
            $data['beneficios'] = $auxClass -> getBeneficiosByCurso($idCurso);

            $auxClass = new ModuloCursoModel;
            $data['contenido'] = $auxClass -> getModulosConIndicadorByCursoINNER($idCurso);

            $data['page_title'] = $data['curso']['curso_nombre'];
            $data['page_active'] = 'cursos';
            $data['page_swalert'] = true;
            $data['icofont'] = true;
            $data['icomoon'] = true;
            $data['page_css'] = 'pages/ver-curso';
            $data['page_js'] = 'cursos/ver_curso';

            $this -> view(['WebTemplate/header', 'Cursos/detalle_curso', 'WebTemplate/footer'], $data);
        }
    }
