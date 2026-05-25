<?php

namespace ADMINFN\Models\FNPeru;
use ADMINFN\Core\Model;

class WebConfigModel extends Model
{
    public string $table    = 'web_config';
    public string $dataBase = 'u175908272_fn_peru';

    public function getAll()
    {
        return $this->findAll();
    }

    public function getByKey(string $key)
    {
        return $this->where(['config_key' => $key])->find();
    }

    public function updateByKey(string $key, string $value)
    {
        $stmt = $this->query(
            'UPDATE web_config SET config_value = :val WHERE config_key = :key'
        );
        $stmt->bindValue(':val', $value, \PDO::PARAM_STR);
        $stmt->bindValue(':key', $key,   \PDO::PARAM_STR);
        return $stmt->execute();
    }
}
