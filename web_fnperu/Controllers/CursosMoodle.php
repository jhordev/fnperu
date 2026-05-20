<?php

    namespace FNPERU\Controllers;
    use ADMINFN\Models\FNPeru\CategoriasCursosMoodleModel;
    use ADMINFN\Models\FNPeru\CursosMoodleModel;
    use FNPERU\Core\Controller;
    
    class CursosMoodle extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function categorias()
        {
            if (!isset($_POST['parent']) || !isset($_POST['key'])) {
                header("HTTP/1.0 404 Not Found");
                $this -> view(['WebTemplate/404']); die;
            }

            if (!ctype_digit($_POST['parent']) || $_POST['key'] != 'SinPass#$%*(*/-PorSiLasDudas62875461') {
                header("HTTP/1.0 404 Not Found");
                $this -> view(['WebTemplate/404']); die;
            }

            $parent = intval($_POST['parent']);

            $categoriasModel = new CategoriasCursosMoodleModel;
            $dataCategorias = $categoriasModel -> getCategoriasByParent($parent);

            $rutas = '';
            $parentAxiliar = $parent;
            $ultimoNoLink = false;

            if ($parent != 0) 
            {
                do {
                    $parentCate = $categoriasModel -> getCategoriasById($parentAxiliar);

                    if ($parentCate != false) {
                        if ($rutas != '') {
                            $rutas = ' - ' . $rutas;
                        }
                        
                        if ($ultimoNoLink) {
                            $rutas = '<a style="text-decoration: none" href="?id=1&parent=' . $parentCate['id'] . '">' . $parentCate['name'] . '</a>' . $rutas;
                        } else {
                            $rutas = $parentCate['name'] . $rutas;
                            $ultimoNoLink = true;
                        }
                        
                        $parentAxiliar = $parentCate['parent'];
                    }
                    
                } while ($parentCate != false && $parentAxiliar != 0);

                $rutas = '<h3>' . $rutas . '</h3>';
            }

            json([ 'categorias' => $dataCategorias, 'rutas' => $rutas ]);
        }

        public function cursos()
        {
            if (!isset($_POST['parent']) || !isset($_POST['key'])) {
                header("HTTP/1.0 404 Not Found");
                $this -> view(['WebTemplate/404']); die;
            }

            if (!ctype_digit($_POST['parent']) || $_POST['key'] != 'SinPass#$%*(*/-PorSiLasDudas62875461') {
                header("HTTP/1.0 404 Not Found");
                $this -> view(['WebTemplate/404']); die;
            }
            
            $parent = intval($_POST['parent']);

            $categoriasModel = new CursosMoodleModel;

            $dataImagenes = $categoriasModel -> getImagenesCursos();
            $newImgenes = [];
            
            foreach ($dataImagenes as $key => $value) {
                $newImgenes[$value['instanceid']] = [$value['id'], $value['filename']];
            }

            $dataCategorias = $categoriasModel -> getCursosByParent($parent);

            foreach ($dataCategorias as $key => $value) 
            {
                if (isset( $newImgenes[$value['id']] )) 
                {
                    $dataCategorias[$key]['id_img'] = $newImgenes[$value['id']][0];
                    $dataCategorias[$key]['img'] = $newImgenes[$value['id']][1];
                }
                else
                {
                    $dataCategorias[$key]['id_img'] = '';
                    $dataCategorias[$key]['img'] = '';
                }
            }

            json($dataCategorias);
        }
    }
    