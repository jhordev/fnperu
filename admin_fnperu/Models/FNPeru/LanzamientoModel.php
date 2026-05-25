<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class LanzamientoModel extends Model
    {
        public $table = 'lanzamiento';
        public $dataBase = 'u175908272_fn_peru';

        public function getLanzamientosByIdCurso(int $idCurso, string $fecha_inicio)
        {
            $update = $this -> query('SELECT * FROM lanzamiento 
            WHERE lanzamiento_curso = :lanzamiento_curso AND lanzamiento_eliminado = 0 AND (lanzamiento_inicio >= :lanzamiento_inicio OR lanzamiento_estado = 1 )');
            $update -> bindValue(':lanzamiento_curso', $idCurso);
            $update -> bindValue(':lanzamiento_inicio', $fecha_inicio);
            $result = $update -> execute();

            $result = $update -> fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        }

        public function getLanzamientosByIdCursoActivo(int $idCurso)
        {
            $update = $this -> query('SELECT * FROM lanzamiento 
            WHERE lanzamiento_curso = :lanzamiento_curso AND lanzamiento_eliminado = 0 AND lanzamiento_estado = 1 ');
            $update -> bindValue(':lanzamiento_curso', $idCurso);
            $result = $update -> execute();

            $result = $update -> fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        }

        public function getLanzamientosById(int $idLanzamiento)
        {
            return $this -> where(['lanzamiento_eliminado' => 0, 'lanzamiento_id' => $idLanzamiento]) -> find();
        }
        
        public function getLanzamientosTable()
        {
            $update = $this -> query('SELECT * FROM cursos
            INNER JOIN lanzamiento ON lanzamiento.lanzamiento_curso = cursos.curso_id
            WHERE lanzamiento.lanzamiento_eliminado = 0 AND cursos.curso_estado = 1
            ORDER BY lanzamiento.lanzamiento_estado DESC, cursos.curso_tipo ASC');
            $result = $update -> execute();

            $result = $update -> fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        }
    }
    