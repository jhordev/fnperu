<?php

    namespace FNPERU\Core;
    use FNPERU\Controllers\Error;
    use ADMINFN\Models\FNPeru\WebConfigModel;

    require_once \dirname(__FILE__). '/Controller.php';

    class BaseController extends Controller
    {
        private static ?array $webConfigCache = null;

        public function __construct()
        {
            parent::__construct();
        }

        protected function view(array $views, array $data = [])
        {
            $data['web_config'] = $this->loadWebConfig();
            parent::view($views, $data);
        }

        private function loadWebConfig(): array
        {
            if (self::$webConfigCache !== null) {
                return self::$webConfigCache;
            }
            $model = new WebConfigModel;
            $rows  = $model->getAll();
            self::$webConfigCache = array_column($rows, 'config_value', 'config_key');
            return self::$webConfigCache;
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
    