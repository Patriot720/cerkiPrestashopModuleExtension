<?php
namespace cerkiPrestashopModuleExtension;
require_once __DIR__ . '/smarty_extensions/functions.php';
use cerkiPrestashopModuleExtension\ModuleFacade;
use cerkiPrestashopModuleExtension\Factories\GatewayFactory;
use cerkiPrestashopModuleExtension\Controllers\cerkiPrestashopModuleExtensionController;
use cerkiPrestashopModuleExtension\ModuleExtension;
// TODO class too complex 
abstract class ModuleExtension extends \Module{

    function constructModule(){
        $this->controller = $this->getController();
        // $this->smartyFacade = new SmartyFacade();
        // $this->JSPlugin = new JSPlugin();
        //
        parent::__construct();
        //var_dump($this->smarty);
        //$this->smarty->smarty->registerPlugin("function","keepo","smarty_function_keepo");
    }
    public function registerSmartyPlugins(){
        $this->smarty->smarty->addPluginsDir(__DIR__ .'/smarty_extensions/');
    }

    abstract function getController();
    function getContent(){
        return $this->getController()->getContent();
    }

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


    function smarty_assign($variables){
        $this->smarty->assign($variables);
    }

    function getControllerLink($controller_name){
        return $this->context->link->getModuleLink($this->name,$controller_name);
    }

    function getDir(){
        $reflection = new \ReflectionClass($this);
        return dirname($reflection->getFileName());
    }

    private function getHookNames(){
        return Util::getHookNames($this);
    }

}

