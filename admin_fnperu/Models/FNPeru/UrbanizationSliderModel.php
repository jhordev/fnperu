<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;
    use PDO;

    class UrbanizationSliderModel extends Model
    {
        public string $table = 'urbanization_slider';
        public string $dataBase = 'u175908272_fn_peru';

        public function getByUrbanization(int $idUrbanization)
        {
            return $this -> where(['urbanization_id' => $idUrbanization]) -> orderBy(['urbanization_slider.order' => 'asc', 'created' => 'asc']) -> findAll();
        }
    }
