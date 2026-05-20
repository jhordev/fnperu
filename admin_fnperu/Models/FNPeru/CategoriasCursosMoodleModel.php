<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class CategoriasCursosMoodleModel extends Model
    {
        public $table = 'mdl_course_categories';
        public $dataBase = 'u175908272_campus';

        public function getCategoriasByParent(int $parent)
        {
            return $this -> where(['parent' => $parent, 'visible' => 1]) -> orderBy(['sortorder' => 'asc']) -> findAll();
        }

        public function getCategoriasById(int $id)
        {
            return $this -> where(['id' => $id, 'visible' => 1]) -> find();
        }

        public function getCategoriasAll()
        {
            return $this -> where(['visible' => 1]) -> orderBy(['sortorder' => 'asc']) -> findAll();
        }
    }
    