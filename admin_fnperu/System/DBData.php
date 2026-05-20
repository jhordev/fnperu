<?php

    namespace ADMINFN\System;

    class DBData
    {
        public static $databases = [];

        public static function start(bool $is_dev)
        {
            foreach (self::$databases as $key => $value) 
            {
                if (!is_null(self::$databases[$key]) && gettype(self::$databases[$key]) != "object") 
                {
                    if ( isset($value['host']) && isset($value['user']) && isset($value['pass']) && isset($value['port']) ) 
                    {
                        if ($is_dev !== true) 
                        {
                            try{    
                                self::$databases[$key] = new \PDO('mysql:dbname=' . $key . ';host=' . $value['host'] . ';port=' . $value['port'], $value['user'], $value['pass']);
                                self::$databases[$key] -> exec("SET time_zone = '-5:00';");
                            } 
                            catch (\PDOException $e) {
                                self::$databases[$key] = null;
                            }
                        } 
                        else 
                        {
                            self::$databases[$key] = new \PDO('mysql:dbname=' . $key . ';host=' . $value['host'] . ';port=' . $value['port'], $value['user'], $value['pass']);
                            self::$databases[$key] -> exec("SET time_zone = '-5:00';");
                            self::$databases[$key] -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                        }
                        
                    } 
                    elseif ($is_dev === true) 
                    {
                        echo "ERROR: No se encontro los parametros para la conección a la Base de datos <br>"; 
                        echo $value['host'] . ' - ' . $value['user'] . ' - ' . $value['pass'] . ' - ' . $value['port'];
                        die;
                    } 
                    else {
                        self::$databases[$key] = null;
                    }
                }
                else 
                {
                    break;
                }
            }
        }
    }