<?php

    namespace FNPERU\Controllers;
    use FNPERU\Core\Controller;
    
    class Error extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function pageNotFound() {
            header("HTTP/1.0 404 Not Found");
            $this -> view(['WebTemplate/404']);
        }
    }
    