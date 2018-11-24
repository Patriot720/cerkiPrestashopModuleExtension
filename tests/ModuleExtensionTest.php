<?php
require_once __DIR__ . '/../ModuleExtension.php';
require_once __DIR__ . '/../Util.php';
use cerkiPrestashopModuleExtension\ModuleExtension;
use cerkiPrestashopModuleExtension\Util;
use PHPUnit\Framework\TestCase;
class ModuleExtensionTest extends TestCase{

    function setUp(){
        $this->module = new MockModule();
    }

    function test_test(){
        $this->assertTrue(True);
    }

    function test_creation(){
        $module = new MockModule();
    }

    function test_installation(){
        $this->module->install();
    }


}

class MockModule extends ModuleExtension{
    function getController(){
    }
}
class Module{
    function install(){
    }
    function hookHome(){
    }
}
