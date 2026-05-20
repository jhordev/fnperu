<?php

    namespace ADMINFN\Core;
    use ADMINFN\Config\AppCofig;
    use ADMINFN\Helpers\Helper;

    require_once \dirname(__FILE__) . '/../Config/AppConfig.php';
    require_once dirname(__FILE__) . '/../../require_funcions.php';

    class App
    {
        public function __construct()
        {
            new AppCofig;
        }

        public function run()
        {
            require_once dirname(__DIR__) . '/Core/Routes.php';
            new Routes(Helper::base_url());
        }
    }
    