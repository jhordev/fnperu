<?php

namespace ADMINFN\Models\FNPeru;
use ADMINFN\Core\Model;

class CursosModel extends Model
{
    public string $table    = 'cursos';
    public string $dataBase = 'u175908272_fn_peru';

    /* ── Cursos (tipo 0) ── */

    public function getCursosActivosTable()
    {
        return $this->where(['curso_estado' => 1, 'curso_tipo' => 0])
                    ->orderBy(['curso_publico' => 'desc', 'curso_orden' => 'asc', 'curso_creacion' => 'desc'])
                    ->findAll();
    }

    public function getLastCursosPublicados()
    {
        return $this->where(['curso_estado' => 1, 'curso_publico' => 1, 'curso_tipo' => 0])
                    ->orderBy(['curso_orden' => 'asc', 'curso_creacion' => 'desc'])
                    ->findAll();
    }

    public function getLastCursosPublicadosConPrecio(string $fechaMaxFin)
    {
        $stmt = $this->query('SELECT * FROM cursos
            INNER JOIN lanzamiento ON lanzamiento.lanzamiento_curso = cursos.curso_id
            WHERE lanzamiento.lanzamiento_eliminado = 0 AND cursos.curso_estado = 1
              AND cursos.curso_tipo = 0 AND lanzamiento.lanzamiento_fin >= :lanzamiento_fin
            ORDER BY cursos.curso_orden ASC, cursos.curso_id,
                     lanzamiento.lanzamiento_estado DESC, lanzamiento.lanzamiento_inicio DESC');
        $stmt->bindValue(':lanzamiento_fin', $fechaMaxFin);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /* ── Talleres (tipo 1) ── */

    public function getTalleresActivosTable()
    {
        return $this->where(['curso_estado' => 1, 'curso_tipo' => 1])
                    ->orderBy(['curso_publico' => 'desc', 'curso_orden' => 'asc', 'curso_creacion' => 'desc'])
                    ->findAll();
    }

    public function getLastTalleresPublicados()
    {
        return $this->where(['curso_estado' => 1, 'curso_publico' => 1, 'curso_tipo' => 1])
                    ->orderBy(['curso_orden' => 'asc', 'curso_creacion' => 'desc'])
                    ->findAll();
    }

    public function getLastTalleresPublicadosConPrecio(string $fechaMaxFin)
    {
        $stmt = $this->query('SELECT * FROM cursos
            INNER JOIN lanzamiento ON lanzamiento.lanzamiento_curso = cursos.curso_id
            WHERE lanzamiento.lanzamiento_eliminado = 0 AND cursos.curso_estado = 1
              AND cursos.curso_tipo = 1 AND lanzamiento.lanzamiento_fin >= :lanzamiento_fin
            ORDER BY cursos.curso_orden ASC, cursos.curso_id,
                     lanzamiento.lanzamiento_estado DESC, lanzamiento.lanzamiento_inicio DESC');
        $stmt->bindValue(':lanzamiento_fin', $fechaMaxFin);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /* ── Compartidos (sin filtro de tipo) ── */

    public function getCursoActivosTableById(int $idCurso)
    {
        return $this->where(['curso_estado' => 1, 'curso_id' => $idCurso])->find();
    }

    public function getCursoActivosPublicadosTableById(int $idCurso)
    {
        return $this->where(['curso_estado' => 1, 'curso_publico' => 1, 'curso_id' => $idCurso])->find();
    }

    public function getLastCursos()
    {
        return $this->where(['curso_estado' => 1])->orderBy(['curso_creacion' => 'desc'])->findAll();
    }

    public function getTodosActivosTable()
    {
        return $this->where(['curso_estado' => 1])
                    ->orderBy(['curso_tipo' => 'asc', 'curso_publico' => 'desc', 'curso_orden' => 'asc', 'curso_creacion' => 'desc'])
                    ->findAll();
    }

    public function getCursoPublicadoConPrecioByIdCurso(int $idCurso, string $fechaMaxFin)
    {
        $stmt = $this->query('SELECT * FROM cursos
            INNER JOIN lanzamiento ON lanzamiento.lanzamiento_curso = cursos.curso_id
            WHERE lanzamiento.lanzamiento_eliminado = 0 AND cursos.curso_estado = 1
              AND lanzamiento.lanzamiento_fin >= :lanzamiento_fin AND cursos.curso_id = :curso_id
            ORDER BY lanzamiento.lanzamiento_estado DESC, lanzamiento.lanzamiento_inicio DESC');
        $stmt->bindValue(':lanzamiento_fin', $fechaMaxFin);
        $stmt->bindValue(':curso_id', $idCurso);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
