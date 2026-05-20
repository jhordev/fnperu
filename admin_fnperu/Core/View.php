<?php

    namespace ADMINFN\View;
    use ADMINFN\Helpers\Helper;
    
    class View
    {
        public function getView(string $nameVista, array $data)
        {
            foreach ($data as $key => $value) {
                ${$key} = $value;
            }

            $base_url = Helper::base_url();
            $assets_url = Helper::assets_url();
            $media_version = Helper::media_version();

            unset($data);

            require_once Helper::base_path() . "/Views/" . $nameVista . '.php';
        }   
    }
    