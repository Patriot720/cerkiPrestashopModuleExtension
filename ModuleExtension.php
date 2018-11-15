<?php

namespace cerkiPrestashopModuleExtension;
use cerkiPrestashopModuleExtension\ModuleFacade;
use cerkiPrestashopModuleExtension\Factories\GatewayFactory;
use cerkiPrestashopModuleExtension\Controllers\cerkiPrestashopModuleExtensionController;
use cerkiPrestashopModuleExtension\ModuleExtension;
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

    function getSmarty(){
        return $this->smarty;
    }
    function getContext(){
        return $this->context;
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
    function getModuleDir(){
        $reflection = new \ReflectionClass($this);
        return dirname($reflection->getFileName());
    }
    function getContent()
    {
        return $this->controller->getContent();
    }

    function getHookNames(){
        Util::getHookNames($this);
    }
}

