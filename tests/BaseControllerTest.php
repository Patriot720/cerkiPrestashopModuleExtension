<?php
require_once __DIR__ . '/../Controllers/BaseController.php';
//require_once __DIR__ . '/../ModuleExtension.php';
use cerkiPrestashopModuleExtension\Controllers\BaseController;
use cerkiPrestashopModuleExtension\ModuleExtension;
use PHPUnit\Framework\TestCase;
class BaseControllerTest extends TestCase{

    function setUp(){
        $this->module = $this->createMock(ModuleExtension::class);
        $this->controller = $this->module;
    }

    function tearDown(){
    }
    function test_creation(){
        $this->module = $this->createMock(ModuleExtension::class);
        $this->controller = $this->module;
    }
}
class MockController extends BaseController{
    function displayPage(){
    }
}
