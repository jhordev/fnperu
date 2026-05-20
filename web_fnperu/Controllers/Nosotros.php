<?php

    namespace FNPERU\Controllers;
    use FNPERU\Core\Controller;
    
    class Nosotros extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            $data['page_title'] = 'Nosotros';
            $data['page_active'] = 'nosotros';
            $data['page_owl'] = \true;
            $data['page_css'] = 'pages/nosotros';
            $data['page_js'] = 'nosotros/nosotros';

            $this -> view(['WebTemplate/header', 'Nosotros/nosotros', 'WebTemplate/footer'], $data);
        }

        public function contactenos()
        {
            $data['page_title'] = 'Contacto';
            $data['page_owl'] = \true;
            $data['page_isotope'] = \true;
            $data['page_active'] = 'contactenos';
            $data['page_css'] = 'pages/contactenos';
            $data['page_js'] = 'nosotros/contactenos';

            $this -> view(['WebTemplate/header', 'Nosotros/contactenos', 'WebTemplate/footer'], $data);
        }
    }
    