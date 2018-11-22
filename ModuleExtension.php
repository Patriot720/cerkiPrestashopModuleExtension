<?php

namespace cerkiPrestashopModuleExtension;
use cerkiPrestashopModuleExtension\ModuleFacade;
use cerkiPrestashopModuleExtension\Factories\GatewayFactory;
use cerkiPrestashopModuleExtension\Controllers\cerkiPrestashopModuleExtensionController;
use cerkiPrestashopModuleExtension\ModuleExtension;
// TODO class too complex 
abstract class ModuleExtension extends \Module{

    function constructModule(){
        $this->controller = $this->getController();
        parent::__construct();
    }

    abstract function getController();

    public function install()
    {
        parent::install();
        foreach($this->getHookNames() as $hook){
            $this->registerHook($hook);
        }
        return true;
    }

    function getFilePath(){
        $reflection = new \ReflectionClass($this);
        return $reflection->getFileName();
    }

    function getValue($id){
        return \Tools::getValue($id);
    }

    function getToken(){
        return \Tools::getAdminTokenLite('AdminModules');
    }

    function addJqueryPlugin($name){
        $this->context->controller->addJqueryPlugin($name);
    }

    function addJS($path){
        if(strpos($path,'www') !== FALSE) // TODO not reliable
        {
            assert(file_exists($path),'JS Path is wrong or file doesnt exist ' . $path);
        }
        else{
            assert(file_exists($_SERVER['DOCUMENT_ROOT'].$path),'JS Path is wrong or file doesnt exist ' . $path); // TODO refactor
        }
        $this->context->controller->addJS($path);
    }

    function display($template){
        return $this->display($this->getFilePath(),$template);
    }

    function smarty_assign($variables){
        $this->smarty->assign($variables);
    }

    function getControllerLink($controller_name){
        return $this->context->link->getModuleLink($this->name,$controller_name);
    }

    private function getDir(){
        $reflection = new \ReflectionClass($this);
        return dirname($reflection->getFileName());
    }

    private function getHookNames(){
        Util::getHookNames($this);
    }

}

