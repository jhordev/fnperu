<?php

    namespace ADMINFN\Config;
    use ADMINFN\System\DBData;
    use ADMINFN\Helpers\Helper;
    use ADMINFN\System\SystemData;
  
    require_once dirname(__FILE__) . '/../Helpers/Helper.php';
    require_once dirname(__FILE__) . '/../System/SystemData.php';
    require_once dirname(__FILE__) . '/../System/DBData.php';

    class AppCofig
    {
        public function __construct()
        {
            $this -> readConfig();
        }

        private function readConfig()
        {
            $varsApp = [
                'base_url' => 'setBaseUrl',
                'base_host' => 'setBaseHost',
                'local_host' => 'setLocalHost',
                'assets_url' => 'setAssetsUrl',
                'development' => 'setIsDevelopment',
                'base_path' => 'setBasePath',
                'public_path' => 'setPublicPath',
                'namespace' => 'setNamespace',
                'media_version' => 'setMediaVersion',
            ];

            $arrayFile = \file(\dirname(__FILE__) . '/.env');

            $varsAppState = true;
            $varsDBState = false;
            $lastDB = '';

            foreach ($arrayFile as $key => $value) 
            {
                $value = \trim(\str_replace('\n\r', '', $value));

                if (isset($value[0]) && $value[0] != '#') 
                {
                    $valueArray = \explode('=', $value);
                    $valueArray[0] = \trim($valueArray[0]);
                    $valueArray[1] = \trim($valueArray[1]);

                    if ($valueArray[0] == 'db.database') {
                        $varsAppState = \false;
                        $varsDBState = \true;
                    }

                    if ($varsAppState === true) {
                        if ($varsAppState && isset($varsApp[$valueArray[0]])) 
                        {
                            $this -> {$varsApp[$valueArray[0]]}($valueArray[1]);
                        }
                    }

                    if ($varsDBState === true) 
                    {
                        switch ($valueArray[0]) {
                            case 'db.database':
                                $lastDB = $valueArray[1];
                                DBData::$databases[$lastDB] = [];
                                break;
                            case 'db.host':
                                DBData::$databases[$lastDB]['host'] = $valueArray[1];
                                break;
                            case 'db.user':
                                DBData::$databases[$lastDB]['user'] = $valueArray[1];
                                break;
                            case 'db.pass':
                                DBData::$databases[$lastDB]['pass'] = $valueArray[1];
                                break;
                            case 'db.port':
                                DBData::$databases[$lastDB]['port'] = $valueArray[1];
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        }

        private function setBaseUrl(string $url) {
            Helper::setBaseUrl($url);
        }

        private function setBaseHost(string $host) {
            Helper::setBaseHost($host);
        }

        private function setLocalHost(string $host) {
            Helper::setLocalHost($host);
        }
        
        private function setAssetsUrl(string $url) {
            Helper::setAssetsUrl($url);
        }
        
        private function setIsDevelopment($dev) {
            $dev = ($dev == 'true') ? true : false;
            Helper::setIsDevelopment($dev);
            SystemData::setIsDevelopment($dev);
        }

        private function setBasePath(string $path) {
            Helper::setBasePath($path);
        }

        private function setPublicPath(string $value) {
            Helper::setPublicPath($value);
        }

        private function setNamespace(string $value) {
            SystemData::setNamespace($value);
        }

        private function setMediaVersion(string $value) {
            Helper::setMediaVersion($value);
        }
    }