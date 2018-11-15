<?php
namespace cerkiPrestashopModuleExtension\Controllers;
abstract class BaseController{
    function getContent(){
        $this->module->smarty_assign([
            'token' => $this->module->getToken(),
            'frame' => __PS_BASE_URI__ . basename(_PS_ADMIN_DIR_) . '/filemanager/dialog.php',
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
    protected function displayForm($path,$table){
        if($this->isEdit()){ // TODO test if id exists but not in DB
            $items = $table->getBy(['id' => $this->module->getValue('id')]);
            $this->module->smarty_assign(reset($items));// Assing variabless if edit
        }
        $this->module->smarty_assign(['parent_id' => $this->module->getValue('parent_id')]);
        return $this->module->display($path);
    }

    protected function isEdit(){
        return $this->module->getValue('id');
    }

    protected function displayConfirmationWithPage($confirmation){
        return $this->module->displayConfirmation($confirmation) . $this->displayPage();
    }
}

