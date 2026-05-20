<?php

    namespace ADMINFN\Core;
    use ADMINFN\System\DBData;

    class Model
    {
        private $select = [];
        private $where = [];
        private $order = [];
        private $insert = [];
        public $lastQuery = '';

        private function prepareSelect()
        {
            $auxSelect = '';
            $this -> select = ($this -> select === []) ? ['*'] : $this -> select;

            foreach ($this -> select as $key => $value)
            {
                if (isset($this -> select[$key + 1])) {
                    $auxSelect .= $value . ', ';
                } else {
                    $auxSelect .= $value . ' ';
                }
            }

            $auxSelect = "SELECT " . $auxSelect . 'FROM ' . $this -> table;

            return $auxSelect;
        }

        private function prepareWhere()
        {
            $whereText = '';
            $auxWhere = [];
            foreach ($this -> where as $key => $value)
            {
                $auxIndice = \explode(' ', $key, 2);
                $auxVar = $key;

                if (!(isset($auxIndice[1]) && trim($auxIndice[1]) !== '')) {
                    $auxVar .= ' =';
                }

                $whereText = ($whereText !== '') ? $whereText . ' AND ' : $whereText;

                $whereText .= $auxVar . ' :' . $auxIndice[0];
                $auxWhere[$auxIndice[0]] = $value;
            }

            $whereText = ($whereText !== '') ? ' WHERE ' . $whereText : '' ;

            return ['parameters' => $auxWhere, 'text' => $whereText];
        }

        private function prepareInsert()
        {
            $insertText = '';
            $parametText = '';
            $countValues = count($this -> insert);
            $index = 0;

            foreach ($this -> insert as $key => $value)
            {
                $index++;
                $insertText .= $key;
                $parametText .= ':' . $key;

                if ($countValues > $index) {
                    $parametText .= ', ';
                    $insertText .= ', ';
                }
            }

            $insertText = ($insertText !== '') ? 'INSERT INTO ' . $this -> table . '(' . $insertText . ') VALUES(' . $parametText . ')' : '';

            return ['parameters' => $this -> insert, 'text' => $insertText];
        }

        private function prepareOrder()
        {
            $orderText = '';
            $tamano = count($this -> order);
            $countador = 0;

            foreach ($this -> order as $key => $value)
            {
                $value = strtoupper($value);
                $countador++;

                switch ($value) {
                    case '':
                    case 'ASC':
                        $key .= ' ASC';
                        break;
                    case 'DESC':
                        $key .= ' DESC';
                        break;

                    default:
                        continue 2;
                        break;
                }

                if ($tamano > $countador) {
                    $key .= ', ';
                }

                $orderText = ($orderText !== '') ? $orderText : ' ORDER BY ' ;

                $orderText .= $key;
            }
            return $orderText;
        }

        public function select(array $array = [])
        {
            foreach ($array as $key => $value) {
                $this -> select[$key] = $value;
            }
            return $this;
        }

        public function value(array $array = [])
        {
            foreach ($array as $key => $value) {
                $this -> insert[$key] = $value;
            }
            return $this;
        }

        public function where(array $array)
        {
            foreach ($array as $key => $value) {
                $this -> where[$key] = $value;
            }
            return $this;
        }

        public function orderBy(array $array)
        {
            foreach ($array as $key => $value) {
                $this -> order[$key] = $value;
            }
            return $this;
        }

        private function executeSQL(string $typeQuery)
        {
            $select = ($typeQuery === 'select') ? $this -> prepareSelect() : '';
            $where = $this -> prepareWhere();
            $order = $this -> prepareOrder();
            $values = $this -> prepareInsert();

            /* RESET */
            $this -> insert = $this -> order = $this -> select = $this -> where = [];
            /* RESET */

            if (isset(DBData::$databases[$this -> dataBase]) && !is_null(DBData::$databases[$this -> dataBase]))
            {
                switch ($typeQuery) {
                    case 'select':
                        $values['parameters'] = [];
                        $this -> lastQuery = $select . $where['text'] . $order;
                        break;
                    case 'insert':
                        $where['parameters'] = [];
                        $this -> lastQuery = $values['text'];
                        break;
                    default:
                        return false;
                        break;
                }

                $Statement = DBData::$databases[$this -> dataBase] -> prepare($this -> lastQuery);

                foreach ($where['parameters'] as $key => $value) {
                    $auxValirStm = $Statement -> bindValue(':' . $key, $value);
                    $this -> lastQuery = str_replace(':' . $key, $value, $this -> lastQuery);

                    if ($auxValirStm == false || str_replace(' ', '', $key) != $key) {
                        return false;
                    }
                }

                foreach ($values['parameters'] as $key => $value) {
                    $auxValirStm = $Statement -> bindValue(':' . $key, $value);
                    $this -> lastQuery = str_replace(':' . $key, $value, $this -> lastQuery);

                    if ($auxValirStm == false || str_replace(' ', '', $key) != $key) {
                        return false;
                    }
                }

                $result = $Statement -> execute();

                if ($result == false) {
                    return false;
                }

                return $Statement;
            }

            return false;
        }

        public function findAll()
        {
            $Statement = $this -> executeSQL('select');

            if ($Statement === false) {
                return [];
            }

            return $Statement -> fetchAll(\PDO::FETCH_ASSOC);
        }

        public function find()
        {
            $Statement = $this -> executeSQL('select');

            if ($Statement === false) {
                return false;
            }

            $result = $Statement -> fetch(\PDO::FETCH_ASSOC);

            return $result;
        }

        public function insert()
        {
            $Statement = $this -> executeSQL('insert');

            if ($Statement == false) {
                return 0;
            }

            $lastId = DBData::$databases[$this -> dataBase] -> lastInsertId();
            $lastId = intval($lastId);

            return $lastId;
        }

        public function query(string $query)
        {
            $Statement = DBData::$databases[$this -> dataBase] -> prepare($query);
            return $Statement;
        }
    }
