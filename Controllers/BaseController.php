<?php
namespace cerkiPrestashopModuleExtension\Controllers;
abstract class BaseController{

    function __construct($module){
        $this->module = $module;
    }

    function getContent(){
        $this->module->smarty_assign([
            'token' => $this->module->getToken(),
            'frame' => __PS_BASE_URI__ . basename(_PS_ADMIN_DIR_) . '/filemanager/dialog.php', // TODO unclear stuff
        ]);
        $this->addJSPlugins();
        return $this->handleAction();
    }

    protected function addJSPlugins(){
        $this->addJS(_PS_JS_DIR_ . 'tiny_mce/tiny_mce.js');
        $this->addJqueryPlugin('tablednd');
        $this->addJS(_PS_JS_DIR_ . 'admin/dnd.js');
        $this->addJS(_PS_JS_DIR_ . 'admin/tinymce.inc.js'); // TODO ps js dir outsider
        $this->addJS(__DIR__ . '/../js/setup.js');
    }
    function handleAction(){
        $method = $this->module->getValue('action');
        return $method ? $this->{$method}() : $this->displayPage();
    }

    abstract function displayPage();

    protected function smarty_assign($array){
        return $this->module->smarty_assign($array);
    }

    protected function display($smarty_template){
        return $this->module->display($this->module->getFilePath(),$smarty_template);
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

