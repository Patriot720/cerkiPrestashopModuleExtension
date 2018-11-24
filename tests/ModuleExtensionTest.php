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
        $this->assertNotEmpty($this->module->hooks);
        $this->assertEquals($this->module->hooks[0],'home');
    }


}

class MockModule extends ModuleExtension{
    function getController(){
    }
}
class Module{
    function __construct(){
    $this->hooks = [];
    }
    function registerHook($string){
        array_push($this->hooks,$string);
    }
    function install(){
    }
    function hookHome(){
    }
}
