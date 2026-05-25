<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class BannersModel extends Model
    {
        public string $table    = 'banners_hero';
        public string $dataBase = 'u175908272_fn_peru';

        public function getBySeccion(int $seccion): array
        {
            $stmt = $this->query('SELECT * FROM banners_hero WHERE banner_seccion = :s ORDER BY banner_orden ASC, banner_id ASC');
            $stmt->bindValue(':s', $seccion);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getActivosBySeccion(int $seccion): array
        {
            $stmt = $this->query('SELECT * FROM banners_hero WHERE banner_seccion = :s AND banner_activo = 1 ORDER BY banner_orden ASC, banner_id ASC');
            $stmt->bindValue(':s', $seccion);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
