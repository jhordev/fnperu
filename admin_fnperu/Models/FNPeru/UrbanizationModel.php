<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class UrbanizationModel extends Model
    {
        public string $table = 'urbanization';
        public string $dataBase = 'u175908272_fn_peru';

        public function getUrbanizationTable()
        {
            return $this -> where(['status' => 1]) -> orderBy(['public' => 'desc', 'urbanization.order' => 'asc', 'created' => 'desc']) -> findAll();
        }

        public function getById(int $idCurso)
        {
            return $this -> where(['status' => 1, 'id' => $idCurso]) -> find();
        }

        public function getPublicById(int $idCurso)
        {
            return $this -> where(['status' => 1, 'public' => 1, 'id' => $idCurso]) -> find();
        }

        public function getLastCursos()
        {
            return $this -> where(['curso_estado' => 1]) -> orderBy(['curso_creacion' => 'desc']) -> findAll();
        }

        public function getLast()
        {
            return $this -> where(['status' => 1, 'public' => 1]) -> orderBy(['urbanization.order' => 'asc', 'created' => 'desc']) -> findAll();
        }
    }
