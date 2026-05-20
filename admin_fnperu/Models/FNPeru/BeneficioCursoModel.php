<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class BeneficioCursoModel extends Model
    {
        public $table = 'beneficio_curso';
        public $dataBase = 'u175908272_fn_peru';

        public function getBeneficiosByCurso(int $idCurso)
        {
            return $this -> where(['beneficio_curso_id' => $idCurso]) -> orderBy(['beneficio_orden' => 'asc', 'beneficio_creacion' => 'asc']) -> findAll();
        }
    }
    