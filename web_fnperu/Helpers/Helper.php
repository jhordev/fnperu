<?php

    namespace FNPERU\Helpers;

    class Helper
    {
        private static $base_url;
        private static $base_host;
        private static $local_host;
        private static $assets_url;
        private static $development;
        private static $base_path;
        private static $public_path;
        private static $media_version;
        private static $domain;

        public static function setDomain(string $value) {
            self::$domain = $value;
        }

        public static function domain(){
            return self::$domain;
        }

        public static function setBaseUrl(string $url) {
            self::$base_url = $url;
        }

        public static function base_url(){
            return self::$base_url;
        }

        public static function setBaseHost(string $host){
            self::$base_host = $host;
        }

        public static function base_host(){
            return self::$base_host;
        }

        public static function setLocalHost(string $host){
            self::$local_host = $host;
        }

        public static function local_host(){
            return self::$local_host;
        }

        public static function setAssetsUrl(string $url){
            self::$assets_url = $url;
        }

        public static function assets_url(){
            return self::$assets_url;
        }

        public static function setIsDevelopment(bool $dev){
            self::$development = $dev;
        }

        public static function is_development(){
            return self::$development;
        }

        public static function setBasePath(string $path){
            self::$base_path = $path;
        }

        public static function base_path(){
            return self::$base_path;
        }

        public static function setPublicPath(string $path){
            self::$public_path = $path;
        }

        public static function public_path(){
            return self::$public_path;
        }

        public static function setMediaVersion(string $version){
            self::$media_version = $version;
        }

        public static function media_version(){
            return self::$media_version;
        }
    }