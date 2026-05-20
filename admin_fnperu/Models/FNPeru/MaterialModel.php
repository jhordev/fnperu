<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class MaterialModel extends Model
    {
        public $table = 'material_entregado';
        public $dataBase = 'u175908272_fn_peru';

        public function getMaterialesByCurso(int $idCurso)
        {
            return $this -> where(['material_curso_id' => $idCurso]) -> orderBy(['material_orden' => 'asc', 'material_creacion' => 'asc']) -> findAll();
        }
    }
    