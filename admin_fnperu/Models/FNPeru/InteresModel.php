<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class InteresModel extends Model
    {
        public string $table    = 'intereses_curso';
        public string $dataBase = 'u175908272_fn_peru';

        public function getById(int $id)
        {
            return $this->where(['interes_id' => $id])->find();
        }

        public function getInteresesTable()
        {
            $stmt = $this->query('
                SELECT i.*, c.curso_nombre, c.curso_tipo
                FROM intereses_curso i
                INNER JOIN cursos c ON c.curso_id = i.interes_curso
                ORDER BY i.interes_estado ASC, i.interes_creacion DESC
            ');
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getStats(): array
        {
            $stmt = $this->query('
                SELECT interes_estado, COUNT(*) AS total
                FROM intereses_curso
                GROUP BY interes_estado
            ');
            $stmt->execute();
            $rows  = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $stats = ['total' => 0, '0' => 0, '1' => 0, '2' => 0];
            foreach ($rows as $row) {
                $stats[strval($row['interes_estado'])] = intval($row['total']);
                $stats['total'] += intval($row['total']);
            }
            return $stats;
        }
    }
