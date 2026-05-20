<?php

    namespace FNPERU\Core;
    use FNPERU\Helpers\Helper;
    use FNPERU\System\SystemData;

    class Session
    {
        private $cookieName_CI; 
        private $cookieUser_CI;
        private $dataSession_CI;
        private $secureCookie;

        public function __construct()
        {
            $this -> cookieName_CI = SystemData::namespace() . '_sesion';
            $this -> cookieUser_CI = SystemData::namespace() . '_user';
            $this -> secureCookie = (SystemData::is_development() === \true) ? \false : \true;

            $this -> start();
        }

        private function start()
        {
            if (!isset($_SESSION)) {
                session_start();
            }
            
            $this -> dataSession_CI = [];
            $filePath = $this -> validateSession();

            if ($filePath !== \false) 
            {
                $fileSession = fopen($filePath, "r");
                $contenido = fread($fileSession, filesize($filePath));
                fclose($fileSession);
                $this -> dataSession_CI = \json_decode($contenido);
            }
        }
        
        public function new(string $sessionID)
        {
            if (!(count($_COOKIE) > 0)) {
                return \false;
            }

            $this -> cookieName_CI = SystemData::namespace() . '_sesion';
            $cookieValue = md5(date('HisdmY') . $sessionID . rand(100000000, 900000000)); 
            $fileName = 'session_' . $cookieValue;
            $directoryPath = Helper::base_path() . '/Writable/Session/' . $sessionID;
            $filePath = $directoryPath . '/' . $fileName;

            if (!\is_dir($directoryPath)) {
                mkdir($directoryPath);
            }

            $fileExist = \false;
            $auxContador = 0;

            do {
                $fileExist = \false;

                if (file_exists($filePath)) 
                {
                    $cookieValue = md5(date('HisdmY') . $sessionID . rand(100000000, 900000000)); 
                    $fileName = 'session_' . $cookieValue;
                    $filePath = $directoryPath . '/' . $fileName;
                    $fileExist = \true;
                    break;
                }

                $auxContador++;
                if ($auxContador > 200) {
                    return false;
                }

            } while ($fileExist === true);

            $auxCookie = setcookie(
                $this -> cookieName_CI, 
                $cookieValue, 
                time() + 60*60*3, 
                '/', 
                Helper::domain(), 
                $this -> secureCookie, true
            );

            $_COOKIE[$this -> cookieName_CI] = $cookieValue;

            if ($auxCookie !== true) {
                return false;
            }

            $auxCookie = setcookie(
                $this -> cookieUser_CI, 
                $sessionID, 
                time() + 60*60*3, 
                '/', 
                Helper::domain(), 
                $this -> secureCookie, true
            );

            $_COOKIE[$this -> cookieUser_CI] = $sessionID;

            if ($auxCookie !== true) {
                return \false;
            }

            $fileSession = fopen($filePath, "x+");
            fwrite($fileSession, '');
            fclose($fileSession);

            return true;
        }

        private function validateSession()
        {
            if (!isset($_COOKIE[$this -> cookieName_CI]) || !isset($_COOKIE[$this -> cookieUser_CI])) 
            {
                if (isset($_COOKIE[$this -> cookieName_CI])) {
                    $_COOKIE[$this -> cookieName_CI] = '';
                    setcookie($this -> cookieName_CI, '', \time() - 60*60*3, '/', Helper::domain(), $this -> secureCookie, true);
                }
                if (isset($_COOKIE[$this -> cookieUser_CI])) {
                    $_COOKIE[$this -> cookieUser_CI] = '';
                    setcookie($this -> cookieUser_CI, '', \time() - 60*60*3, '/', Helper::domain(), $this -> secureCookie, true);
                }
                return false;
            }
            
            $fileName = $_COOKIE[$this -> cookieName_CI];
            $sessionID = $_COOKIE[$this -> cookieUser_CI];
            $filePath = Helper::base_path() . '/Writable/Session/' . $sessionID . '/session_' . $fileName;
            
            if (!file_exists($filePath)) {
                $_COOKIE[$this -> cookieName_CI] = '';
                setcookie($this -> cookieName_CI, '', \time() - 60*60*3, '/', Helper::domain(), $this -> secureCookie, true);
                $_COOKIE[$this -> cookieUser_CI] = '';
                setcookie($this -> cookieUser_CI, '', \time() - 60*60*3, '/', Helper::domain(), $this -> secureCookie, true);
                return false;
            }

            return $filePath;
        }

        public function setAll(array $values)
        {
            $filePath = $this -> validateSession(); 
            
            if ($filePath === \false) {
                return false;
            }
            
            $fileSession = fopen($filePath, "w");
            fwrite($fileSession, \json_encode($values));
            fclose($fileSession);
            
            $this -> dataSession_CI = $values;

            return true;
        }

        public function data() {
            return $this -> dataSession_CI;
        }
    }
    