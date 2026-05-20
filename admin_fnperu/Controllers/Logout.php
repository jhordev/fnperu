<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;

    class Logout extends BaseController
    {
        public function __construct() {
            parent::__construct();
        }

        public function index()
        {
            $this -> session() -> destroy();
            redirect($this -> base_url() . '/login');
        }
    }
