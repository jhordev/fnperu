<?php

    namespace FNPERU\Core;
    use FNPERU\Helpers\Helper;

    require \dirname(__FILE__) . '/AutoloadController.php';

    class Routes
    {
        private $controller = 'Index';
        private $method = 'index';
        private $parameters = array();
        private $URLBase = '';
        private $Host = '';

        // ["Route:required" => "/", "Controller:required" => "Index", "Method" => 'index', "Parameters" => array(), "redirect_here" => false]    ||  Route => must end in "/"

        private $routes = [
            ["Route" => "/", "Controller" => "Cursos", "Method" => 'index', "redirect_here" => true],
            ["Route" => "/nosotros", "Controller" => "Nosotros", "Method" => 'index', "redirect_here" => true],
            ["Route" => "/contacto", "Controller" => "Nosotros", "Method" => 'contactenos', "redirect_here" => true],
            ["Route" => "/urbanizaciones", "Controller" => "Urbanizaciones", "Method" => 'ver', "redirect_here" => false]
        ];


        public function __construct(string $base_url)
        {
            $this -> base_url = $base_url;

            $this -> defineRoutes();
            $this -> executeRoutes();
            $this -> callRoutes();
        }

        public function defineRoutes()
        {
            $this -> URLBase = isset($_GET['url']) ? $_GET['url'] : '/'; 
            $this -> URLBase = ($this -> URLBase[strlen($this -> URLBase) - 1] === '/') ? substr($this -> URLBase, 0, -1) : $this -> URLBase;
            $this -> URLBase = ($this -> URLBase != '' && $this -> URLBase[0] === '/') ? $this -> URLBase : '/' . $this -> URLBase;

            /* VERIFICAR HOST */
            $this -> Host = Helper::base_url();
            $auxUrlHttp = \explode('//', $this -> Host);
            $auxUrlHost = \explode('/', $auxUrlHttp[1]);
            $auxUrlHost = $auxUrlHost[0];
            Helper::setDomain($auxUrlHost);

            if ($auxUrlHost != $_SERVER['HTTP_HOST']){
                redirect(Helper::base_url() . $this -> URLBase);
            }
            /* VERIFICAR HOST */

            $url = !empty($_GET['url']) ? $_GET['url'] : 'Index'; 
            $arrUrl = explode("/", $url); 
            
            $this -> controller = trim($arrUrl[0]);
            $this -> method = 'index';
            $this -> parameters = "";
            
            if(isset($arrUrl[1]) && trim($arrUrl[1]) != "")
            {
                $this -> method = trim($arrUrl[1]);
            }
            
            if(isset($arrUrl[2]) && trim($arrUrl[2]) != "")
            {
                $countArrUrl = count($arrUrl);
                
                for ($i = 2; $i < $countArrUrl; $i++){
                    $this -> parameters .= trim($arrUrl[$i]) . ',';
                }

                $this -> parameters = trim(trim($this -> parameters, ","));
            }

            if ($this -> parameters === '') {
                $this -> parameters = array();
            } else {
                $this -> parameters = explode(',', $this -> parameters);
            }
        }

        public function callRoutes()
        {
            $autoload = new AutoloadController();
            $autoload -> runController($this -> controller, $this -> method, $this -> parameters);
        }

        public function executeRoutes()
        {
            $rutaEncontrada = false;
            foreach ($this -> routes as $key => $value) 
            {
                if (\strtolower($value["Route"]) == \strtolower($this -> URLBase)) {
                    $this -> controller = $value["Controller"]; 
                    $this -> method = isset($value["Method"]) ? $value["Method"] : $this -> method;
                    $this -> parameters = isset($value["Parameters"]) ? $value["Parameters"] : $this -> parameters;
                    $rutaEncontrada = true;
                    break;
                }
            }

            if ($rutaEncontrada == false) 
            {   
                foreach ($this -> routes as $key => $value) 
                {  
                    if (strtolower($this -> controller) == strtolower($value["Controller"]) && isset($value["redirect_here"]) && $value["redirect_here"] == \true) 
                    {
                        $validoParaRedirigir = false;
                        if (isset($value["Method"]) && strtolower($value["Method"]) == strtolower($this -> method)) {
                            $validoParaRedirigir = \true;
                        } elseif (!isset($value["Method"])) {
                            $validoParaRedirigir = \true;
                        }
                        
                        if ($validoParaRedirigir === \true) {
                            redirect(Helper::base_url() . $value["Route"]);
                            die;
                        }
                    }
                }
            }
        }
    }
    