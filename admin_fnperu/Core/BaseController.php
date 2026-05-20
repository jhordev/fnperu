<?php

    namespace ADMINFN\Core;
    use ADMINFN\Controllers\Error;

    require_once \dirname(__FILE__). '/Controller.php';
    
    class BaseController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function verifyLogin($redirectLogin = true)
        {
            if (isset($this -> session -> user)) {
                return \true;
            }

            if ($redirectLogin === true) {
                redirect($this -> base_url() . '/login'); die;
            }
            return false;
        }

        public function isPost($generateError = true)
        { 
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                if ($generateError == \true) {
                    $error = new Error();
                    $error -> pageNotFound();
                    die;
                } else {
                    return \false;
                }
            }
            return \true;
        }
    }
    