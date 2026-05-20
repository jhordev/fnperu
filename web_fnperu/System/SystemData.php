<?php

    namespace FNPERU\System;

    class SystemData
    {
        private static $development;
        private static $namespace;

        public static function setIsDevelopment(bool $dev){
            self::$development = $dev;
        }

        public static function is_development(){
            return self::$development;
        }

        public static function setNamespace(string $name){
            self::$namespace = $name;
        }

        public static function namespace(){
            return self::$namespace;
        }
    }