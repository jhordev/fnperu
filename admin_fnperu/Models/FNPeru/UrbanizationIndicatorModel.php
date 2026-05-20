<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class UrbanizationIndicatorModel extends Model
    {
        public string $table = 'urbanization_indicator';
        public string $dataBase = 'u175908272_fn_peru';

        public function getByModule(int $idModule)
        {
            return $this -> where(['module_id' => $idModule]) -> orderBy(['urbanization_indicator.order' => 'asc', 'created' => 'asc']) -> findAll();
        }
    }
