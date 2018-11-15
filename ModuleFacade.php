<?php
namespace cerkiPrestashopModuleExtension;
class ModuleFacade{
    function __construct($module)
    {
        $this->module = $module;
    }
    function addJqueryPlugin($name){
        $this->module->getContext()->controller->addJqueryPlugin($name);
    }

    function addJS($path){
        if(strpos($path,'www') !== FALSE) // TODO not reliable
        {
            assert(file_exists($path),'JS Path is wrong or file doesnt exist ' . $path);
        }
        else{
            assert(file_exists($_SERVER['DOCUMENT_ROOT'].$path),'JS Path is wrong or file doesnt exist ' . $path); // TODO refactor
        }
        $this->module->getContext()->controller->addJS($path);
    }
    function display($template){
        return $this->module->display($this->module->getFilePath(),$template);
    }
    function smarty_assign($variables){
        $this->module->getSmarty()->assign($variables);
    }
    function displayConfirmation($confirmation){
        $this->module->displayConfirmation($confirmation);
    }

    function getControllerLink($controller_name){
        return $this->getContext()->link->getModuleLink($this->name,$controller_name);
    }

    function getValue($id){
        return $this->module->getValue($id);
    }

    function getToken(){
        return $this->module->getToken();
    }
    function getModuleDir(){
        return $this->module->getModuleDir();
    }

}
