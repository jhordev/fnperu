<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;
    
    class Inicio extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
            $this -> verifyLogin();
        }

        public function index()
        {
            $data['page_title'] = 'Panel de Análisis';
            $data['page_viewport'] = \true;
            $data['page_active'] = 'inicio';

            $this -> view(['Template/header', 'Inicio/dashboard', 'Template/footer'], $data);
        }
    }
    