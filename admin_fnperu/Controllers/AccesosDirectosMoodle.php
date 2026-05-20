<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;
    use ADMINFN\Helpers\Helper;
    use ADMINFN\Models\FNPeru\CategoriasCursosMoodleModel;

    class AccesosDirectosMoodle extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $this -> verifyLogin();
        }

        public function index()
        {
            $data['page_title'] = 'Accesos Directos - Moodle';
            $data['page_active'] = 'accesos_directos';
            $data['page_js'] = 'accesos_directos/accesos';

            $categoriasMoodle = new CategoriasCursosMoodleModel;
            $dataCategoria = $categoriasMoodle -> getCategoriasAll();

            $maxNivel = 0;

            foreach ($dataCategoria as $key => $value) 
            {
                $nivel = explode('/', $value['path']);
                $countNiveles = count($nivel) - 2;

                if ($countNiveles > $maxNivel) {
                    $maxNivel = $countNiveles;
                }

                $dataCategoria[$key]['nivel'] = $countNiveles;

                if ($countNiveles == 0) {
                    $dataCategoria[$key]['padre'] = 0;
                } else {
                    $dataCategoria[$key]['padre'] = $nivel[$countNiveles];
                }
            }

            for ($index = $maxNivel; $index >= 1 ; $index--) 
            { 
                $countCategorias = count($dataCategoria);
                
                for ($indice = 0; $indice < $countCategorias; $indice++) 
                {
                    if ($dataCategoria[$indice]['nivel'] == $index) 
                    { 
                        $indexPadre = null;

                        foreach ($dataCategoria as $key => $value) 
                        {
                            if ($value['id'] == $dataCategoria[$indice]['padre']) 
                            {
                                $indexPadre = $key;
                                break;
                            }
                        }

                        if (is_null($indexPadre)) {
                            break;
                        }

                        if (!isset($dataCategoria[$indexPadre]['contenido'])) {
                            $dataCategoria[$indexPadre]['contenido'] = [];
                        }

                        array_push($dataCategoria[$indexPadre]['contenido'], $dataCategoria[$indice]);

                        array_splice($dataCategoria, $indice, 1);
                        $countCategorias--;
                        $indice--;
                    }
                }
            }

            $data['categorias'] = $dataCategoria;

            $this -> view(['Template/header', 'AccesosDirectos/directos', 'Template/footer'], $data);
        }

        public function changeImg()
        {
            $this -> isPost();

            $return = [
                'status' => false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];
            
            if ( !isset($this -> files['input_img']) || !isset($this -> post['id_cat']) ) 
            {
                json($return);
            }

            $imagenCategoria = $this -> files['input_img'];

            if ( !ctype_digit($this -> post['id_cat']) ) {
                json($return);
            }

            $idCategoria = intval($this -> post['id_cat']);

            $categoriasMoodle = new CategoriasCursosMoodleModel;
            $dataCategoria = $categoriasMoodle -> getCategoriasById($idCategoria);

            if ($dataCategoria == false) {
                json($return);
            }

            if (!isset($imagenCategoria['error']) || !isset($imagenCategoria['name']) || !isset($imagenCategoria['size']) || !isset($imagenCategoria['tmp_name']) || !isset($imagenCategoria['type'])) 
            {
                $return['message'] = 'La imagen no es válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }
            
            if ($imagenCategoria['error'] !== 0 || ($imagenCategoria['type'] !== 'image/jpeg' && $imagenCategoria['type'] !== 'image/png') || intval($imagenCategoria['size']) <= 100) 
            {
                $return['message'] = 'La imagen no es válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }
            
            $extension = getExtension($imagenCategoria['name']);
            $newName = nameForFiles($dataCategoria['name'], $extension) . '.' . $extension;
            
            if (trim($extension) == '' || trim($newName) == '') 
            {
                $return['message'] = 'La imagen no es válida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            $newName = date('ynjGis') . rand(100, 999) . '_' . $newName;
            $newPath = Helper::base_path() . '/../public_html/assets/moodle/images/categorias/' . $newName;
            
            $auxMoveFile = move_uploaded_file($imagenCategoria['tmp_name'], $newPath);
            
            if ($auxMoveFile !== true) {
                $return['message'] = 'Error al guardar la imagen';
                json($return);
            }

            $update = $categoriasMoodle -> query('UPDATE mdl_course_categories SET cat_course_imagen = :cat_course_imagen WHERE id = :id');
            $update -> bindValue(':cat_course_imagen', $newName);
            $update -> bindValue(':id', $idCategoria);
            $result = $update -> execute();

            if ($result === true && $update -> rowCount() === 1) {
                $return['status'] = true;
            }

            json($return);
        }
    }
    