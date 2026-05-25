<?php

    namespace FNPERU\Controllers;

    use FNPERU\Core\BaseController;

    class Talleres extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function listado()
        {
            redirect($this -> base_url() . '/cursos?filter=1');
        }

        public function ver(int $idTaller)
        {
            redirect($this -> base_url() . '/cursos/ver/' . $idTaller);
        }
    }
