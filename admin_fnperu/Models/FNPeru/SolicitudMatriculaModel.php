<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class SolicitudMatriculaModel extends Model
    {
        public $table = 'solicitud_matricula';
        public $dataBase = 'u175908272_fn_peru';

        public function getSolicitudesTable(int $estado)
        {
            $update = $this -> query('SELECT solicitud_matricula.*, cursos.curso_nombre FROM solicitud_matricula
            INNER JOIN cursos ON cursos.curso_id = solicitud_matricula.sol_curso_id
            WHERE solicitud_matricula.sol_estado = :sol_estado
            ORDER BY solicitud_matricula.sol_creacion DESC');
            $update -> bindValue(':sol_estado', $estado);
            $result = $update -> execute();

            if ($result == false) {
                return [];
            }

            $result = $update -> fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        }

        public function getSolicitudById(int $soliId)
        {
            return $this -> where(['sol_id' => $soliId]) -> find();
        }

        public function getSolicitudesPendientes()
        {
            return $this -> where(['sol_estado' => 2]) -> findAll();
        }
    }
    