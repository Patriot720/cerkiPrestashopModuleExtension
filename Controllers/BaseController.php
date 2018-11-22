<?php
namespace cerkiPrestashopModuleExtension\Controllers;
abstract class BaseController{

    function __construct($moduleFacade){
        $this->module = $moduleFacade;
    }

    function getContent(){
        $this->module->smarty_assign([
            'token' => $this->module->getToken(),
            'frame' => __PS_BASE_URI__ . basename(_PS_ADMIN_DIR_) . '/filemanager/dialog.php', // TODO unclear stuff
        ]);
        $this->addJSPlugins();
        return $this->handleAction();
    }

    function handleAction(){
        $method = $this->module->getValue('action');
        return $method ? $this->{$method}() : $this->displayPage();
    }

    abstract function displayPage();
    abstract function addJSPlugins();

    protected function smarty_assign($array){
        return $this->module->smarty_assign($array);
    }

    protected function display($smarty_template){
        return $this->module->display($smarty_template);
    }

    protected function getValue($id){
        return $this->module->getValue($id);
    }

    protected function addJS($path){
        return $this->module->addJS($path);
    }

    protected function addJqueryPlugin($path){
        return $this->module->addJqueryPlugin($path);
    }

    protected function isEdit(){
        return $this->module->getValue('id');
    }

    protected function displayConfirmationWithPage($confirmation){
        return $this->module->displayConfirmation($confirmation) . $this->displayPage();
    }
}

