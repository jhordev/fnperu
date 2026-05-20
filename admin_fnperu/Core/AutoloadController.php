<?php

    namespace ADMINFN\Core;
    use ADMINFN\System\SystemData;

    require_once dirname(__FILE__). '/SlpRegister.php';
    require_once dirname(__FILE__). '/BaseController.php';
    require_once dirname(__FILE__). '/Model.php';

    class AutoloadController
    {
        public function runController(string $controller, string $method, array $parameters)
        {
            $controller = mb_strtolower($controller);
            $directorio = scandir(dirname(__FILE__) . '/../Controllers');
            $exitFile = false;
            
            foreach ($directorio as $key => $value) {
                if (mb_strtolower($value) == $controller . '.php') {
                    $exitFile = true;
                    $controller = explode('.php', $value);
                    $controller = $controller[0];
                    break;
                }
            }
            
            if(!file_exists(dirname(__FILE__) . '/../Controllers/' . $controller . '.php') || !$exitFile)  {
                $this -> runController('Error', 'pageNotFound', []); die;
            }

            $controller = SystemData::namespace() . "\Controllers\\" . $controller;
            $mainController = new $controller();

            if (!method_exists($mainController, $method)) {
                $this -> runController('Error', 'pageNotFound', []); die;
            }
            
            try {
                call_user_func_array(array($mainController, $method), $parameters); 
            } 
            catch (\TypeError $error) 
            {
                if (SystemData::is_development() === true) {
                    $mensaje = '<b>ERROR:</b> ' . $error -> getMessage() . ' ' . $error -> getFile() . ':' . $error -> getLine();
                    echo $mensaje; die;
                }   

                $this -> runController('Error', 'pageNotFound', []); die;
            }
        }
    }
