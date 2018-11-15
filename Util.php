<?php
namespace cerkiPrestashopModuleExtension;

class Util{

    static function getHookNames($class){
        $methods = get_class_methods($class);
        $hookMethodNames = [];
        foreach($methods as $method){
            if(strpos($method,'hook') !== FALSE){
                array_push($hookMethodNames,lcfirst(substr($method,4)));
            }
        }
        return $hookMethodNames;
    }
}
