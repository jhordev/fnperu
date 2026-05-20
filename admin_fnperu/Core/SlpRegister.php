<?php

    use ADMINFN\System\SystemData;

    spl_autoload_register(function($class){
        
        $classArray = explode(SystemData::namespace() . "\Controllers\\", $class);
        $isController = false;

        if (isset($classArray[0]) && isset($classArray[1]) && $classArray[0] == '' && $classArray[1] != '') 
        {
            if(file_exists(dirname(__FILE__) . '/../Controllers/' . $classArray[1] . '.php')) 
            {
                $isController = true;
                require_once(dirname(__FILE__) . '/../Controllers/' . $classArray[1] . '.php');
            }
        }

        $isModel = false;

        if ($isController == false) 
        {
            $classArray = explode(SystemData::namespace() . "\Models\\", $class);
            $classArray = str_replace('\\', '/', $classArray);
            
            if (isset($classArray[0]) && isset($classArray[1]) && $classArray[0] == '' && $classArray[1] != '') 
            {
                if(file_exists(dirname(__FILE__) . '/../Models/' . $classArray[1] . '.php')) 
                {
                    $isModel = true;
                    require_once(dirname(__FILE__) . '/../Models/' . $classArray[1] . '.php');
                }
            }
        }

    });