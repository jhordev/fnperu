<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class IndicadorModuloCursoModel extends Model
    {
        public $table = 'indicadores_modulos';
        public $dataBase = 'u175908272_fn_peru';

        public function getIndicadoresByModulo(int $idCurso)
        {
            return $this -> where(['ind_modulo_id' => $idCurso]) -> orderBy(['ind_orden' => 'asc', 'ind_creacion' => 'asc']) -> findAll();
        }
    }
    