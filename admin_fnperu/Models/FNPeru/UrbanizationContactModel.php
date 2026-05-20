<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;

    class UrbanizationContactModel extends Model
    {
        public string $table = 'urbanization_contact';
        public string $dataBase = 'u175908272_fn_peru';

        public function getByUrbanization(int $idUrbanization)
        {
            return $this -> where(['urbanization_id' => $idUrbanization]) -> orderBy(['urbanization_contact.order' => 'asc', 'created' => 'asc']) -> findAll();
        }
    }
