<?php

    namespace ADMINFN\Controllers;
    use ADMINFN\Core\BaseController;

    class Login extends BaseController
    {
        public function __construct() {
            parent::__construct();
        }

        public function index()
        {
            if ($this -> verifyLogin(\false)) {
                \redirect($this -> base_url());
            } 

            $data['page_viewport'] = \true;

            $this -> view(['Login/login'], $data);
        }

        /* IMPLEMENTAR EL SESSION */
        //admin
        //2022.FNperu-admin

        public function user()
        {
            $this -> isPost();

            $return = [
                'status' => \false,
                'message' => 'Ocurrió un error inesperado',
                'title' => 'ERROR',
                'type' => 'danger'
            ];
            
            if ( !isset($this -> post['user']) || (isset($this -> post['user']) && !isAlphaNumeric($this -> post['user'])) )
            {
                $return['message'] = 'Usuario no valido';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }

            if ( !isset($this -> post['pass']) || (isset($this -> post['pass']) && !isAlphaDash($this -> post['pass'])) )
            {
                $return['message'] = 'Contraseña no valida';
                $return['title'] = 'ALERTA';
                $return['type'] = 'warning';
                json($return);
            }           

            if ($this -> post['user'] === 'admin' && $this -> post['pass'] === '2022.FNperu-admin') 
            {
                if (!(count($_COOKIE) > 0)) {
                    $return['message'] = 'Las cookies han sido bloqueadas por su navegador o no son soportadas';
                    $return['type'] = 'warning';
                    $return['title'] = 'ALERTA';
                    \json($return);
                }
                
                $userId = '0000000';
                $auxSession = $this -> session() -> new($userId);

                if ($auxSession !== \true) {
                    $return['message'] = 'Se produjo un error al momento de crear la sesión';
                    $return['type'] = 'danger';
                    $return['title'] = 'ERROR';
                    \json($return);
                }
                
                $sessionArray = [
                    'user' => [
                        'user_id' => '0000000',
                        'user_name' => 'admin'
                    ]
                ];

                $auxSession = $this -> session() -> setAll($sessionArray);

                if ($auxSession !== \true) {
                    $return['message'] = 'Se produjo un error al momento de crear la sesión';
                    $return['type'] = 'danger';
                    $return['title'] = 'ERROR';
                    \json($return);
                }
                
                $return['status'] = true;
                json($return);
            } 
            else 
            {
                $return['message'] = 'El usuario o la contraseña ingresada es incorrecto';
                $return['type'] = 'warning';
                $return['title'] = 'ALERTA';
            }            

            \json($return);
        }
    }
    