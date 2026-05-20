<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;
    
    class Error extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function pageNotFound() {
            header("HTTP/1.0 404 Not Found");
            $this -> view(['Template/404']);
        }
    }
    