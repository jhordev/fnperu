<?php

    namespace ADMINFN\Models\FNPeru;
    use ADMINFN\Core\Model;
    use PDO;

    class UrbanizationModulesModel extends Model
    {
        public string $table = 'urbanization_modules';
        public string $dataBase = 'u175908272_fn_peru';

        public function getByUrbanization(int $idUrbanization)
        {
            return $this -> where(['urbanization_id' => $idUrbanization]) -> orderBy(['urbanization_modules.order' => 'asc', 'created' => 'asc']) -> findAll();
        }

        public function getWithIndicatorsByUrbanization(int $idUrbanization, bool $inner = false): array
        {
            $join = $inner ? 'INNER' : 'LEFT';

            $update = $this -> query('SELECT
            urbanization_modules.id AS modules_id,
            urbanization_modules.urbanization_id,
            urbanization_modules.name AS modules_name,
            urbanization_modules.order AS modules_order,
            urbanization_indicator.id AS indicators_id,
            urbanization_indicator.module_id AS indicators_module_id,
            urbanization_indicator.name AS indicators_name,
            urbanization_indicator.order AS indicators_order
            FROM urbanization_modules
            ' . $join . ' JOIN urbanization_indicator ON urbanization_indicator.module_id = urbanization_modules.id
            WHERE urbanization_modules.urbanization_id = :idUrbanization
            ORDER BY urbanization_modules.order, urbanization_modules.created, urbanization_indicator.order, urbanization_indicator.created');
            $update -> bindValue(':idUrbanization', $idUrbanization);
            $result = $update -> execute();

            if (!$result) {
                return [];
            }

            $result = $update -> fetchAll(PDO::FETCH_ASSOC);
            return $this -> SortModulesWithIndicators($result);
        }

        private function SortModulesWithIndicators($result): array
        {
            $newArray = [];
            $idAuxModulo = null;
            $index = -1;

            foreach ($result as $key => $value)
            {
                if ($idAuxModulo != $value['modules_id'])
                {
                    $idAuxModulo = $value['modules_id'];
                    $index++;
                    $newArray[$index] = [];
                    $newArray[$index]['id'] = $value['modules_id'];
                    $newArray[$index]['urbanization'] = $value['urbanization_id'];
                    $newArray[$index]['name'] = $value['modules_name'];
                    $newArray[$index]['order'] = $value['modules_order'];
                    $newArray[$index]['indicators'] = [];
                    $indexIndicador = -1;
                }

                if ($value['indicators_id'] != null)
                {
                    $indexIndicador++;
                    $newArray[$index]['indicators'][$indexIndicador] = [];
                    $newArray[$index]['indicators'][$indexIndicador]['id'] = $value['indicators_id'];
                    $newArray[$index]['indicators'][$indexIndicador]['name'] = $value['indicators_name'];
                    $newArray[$index]['indicators'][$indexIndicador]['order'] = $value['indicators_order'];
                }
            }

            return $newArray;
        }
    }
