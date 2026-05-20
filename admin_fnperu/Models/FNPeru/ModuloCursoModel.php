<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class ModuloCursoModel extends Model
    {
        public $table = 'modulos_curso_web';
        public $dataBase = 'u175908272_fn_peru';

        public function getModulosByCurso(int $idCurso)
        {
            return $this -> where(['mod_curso_id' => $idCurso]) -> orderBy(['mod_orden' => 'asc', 'mod_creacion' => 'asc']) -> findAll();
        }

        public function getModulosConIndicadorByCurso(int $idCurso)
        {
            $update = $this -> query('SELECT * FROM modulos_curso_web
            LEFT JOIN indicadores_modulos ON indicadores_modulos.ind_modulo_id = modulos_curso_web.mod_id
            WHERE modulos_curso_web.mod_curso_id = :mod_curso_id
            ORDER BY modulos_curso_web.mod_orden, modulos_curso_web.mod_creacion, modulos_curso_web.mod_id, indicadores_modulos.ind_orden, indicadores_modulos.ind_creacion');
            $update -> bindValue(':mod_curso_id', $idCurso);
            $result = $update -> execute();

            if ($result == false) {
                return [];
            }

            $result = $update -> fetchAll(\PDO::FETCH_ASSOC);
            $result = $this -> ordenarModulosConIndicadores($result);

            return $result;
        }

        public function getModulosConIndicadorByCursoINNER(int $idCurso)
        {
            $update = $this -> query('SELECT * FROM modulos_curso_web
            INNER JOIN indicadores_modulos ON indicadores_modulos.ind_modulo_id = modulos_curso_web.mod_id
            WHERE modulos_curso_web.mod_curso_id = :mod_curso_id
            ORDER BY modulos_curso_web.mod_orden, modulos_curso_web.mod_creacion, modulos_curso_web.mod_id, indicadores_modulos.ind_orden, indicadores_modulos.ind_creacion');
            $update -> bindValue(':mod_curso_id', $idCurso);
            $result = $update -> execute();

            if ($result == false) {
                return [];
            }

            $result = $update -> fetchAll(\PDO::FETCH_ASSOC);
            $result = $this -> ordenarModulosConIndicadores($result);

            return $result;
        }

        private function ordenarModulosConIndicadores($result)
        {
            $newArray = [];
            $idAuxModulo = null;
            $index = -1;

            foreach ($result as $key => $value) 
            {
                if ($idAuxModulo != $value['mod_id']) 
                {
                    $idAuxModulo = $value['mod_id'];
                    $index++;
                    $newArray[$index] = [];
                    $newArray[$index]['mod_id'] = $value['mod_id'];
                    $newArray[$index]['mod_curso_id'] = $value['mod_curso_id'];
                    $newArray[$index]['mod_nombre'] = $value['mod_nombre'];
                    $newArray[$index]['mod_orden'] = $value['mod_orden'];
                    $newArray[$index]['indicadores'] = [];
                    $idAuxIndicador = null;
                    $indexIndicador = -1;
                }

                if ($value['ind_id'] != null) 
                {
                    $indexIndicador++;
                    $newArray[$index]['indicadores'][$indexIndicador] = [];
                    $newArray[$index]['indicadores'][$indexIndicador]['ind_id'] = $value['ind_id'];
                    $newArray[$index]['indicadores'][$indexIndicador]['ind_tipo'] = $value['ind_tipo'];
                    $newArray[$index]['indicadores'][$indexIndicador]['ind_nombre'] = $value['ind_nombre'];
                    $newArray[$index]['indicadores'][$indexIndicador]['ind_orden'] = $value['ind_orden'];
                }
            }

            $result = $newArray;

            return $result;
        }
    }
    