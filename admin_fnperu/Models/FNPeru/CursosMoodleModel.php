<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class CursosMoodleModel extends Model
    {
        public $table = 'mdl_course';
        public $dataBase = 'u175908272_campus';

        public function getCursosByParent(int $parent)
        {
            $update = $this -> query("SELECT * FROM mdl_course
            WHERE category = :category AND visible = 1 AND ( format  = 'topics'  OR format  = 'tiles')
            ORDER BY sortorder ASC");
            $update -> bindValue(':category', $parent);
            $result = $update -> execute();

            if ($result == false) { 
                return [];
            }

            $result = $update -> fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        }

        public function getImagenesCursos()
        {
            $update = $this -> query("SELECT mdl_context.instanceid, mdl_files.filename, mdl_context.id FROM mdl_files
            INNER JOIN mdl_context ON mdl_context.id = mdl_files.contextid
            WHERE mdl_context.contextlevel = 50 AND mdl_files.component = 'course' AND mdl_files.filearea = 'overviewfiles' 
            AND mdl_files.filename <> '.'
            ORDER BY mdl_files.timecreated ASC");
            $result = $update -> execute();

            if ($result == false) { 
                return [];
            }

            $result = $update -> fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        }
    }
    