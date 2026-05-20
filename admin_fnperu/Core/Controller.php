<?php

    namespace ADMINFN\Core;
    use ADMINFN\Core\Session;
    use ADMINFN\System\DBData;
    use ADMINFN\View\View;
    use ADMINFN\Helpers\Helper;

    require_once \dirname(__FILE__). "/View.php";
    require_once \dirname(__FILE__). "/BaseController.php";
    require_once \dirname(__FILE__). "/Session.php";
    
    class Controller
    {
        private $viewClass;
        protected $post;
        protected $get;
        protected $files;
        protected $base_url;
        protected $session;
        protected $sessionClass;

        public function __construct() {
            $this -> post = $_POST;
            $this -> get = $_GET;
            $this -> files = $_FILES;
            $this -> base_url = Helper::base_url();
            $this -> viewClass = new View();
            $this -> sessionClass = new Session();
            $this -> session = $this -> sessionClass -> data();
            DBData::start(Helper::is_development());
        }

        protected function base_url() {
            return $this -> base_url;
        }

        protected function view(array $views, array $data = [])
        {
            foreach ($views as $key => $value) {
                $this -> viewClass -> getView($value, $data);
            }
        }

        public function session() {
            return $this -> sessionClass;
        }
    }
    