<?php
include_once __DIR__ .'/../functions.php';
include_once __DIR__ .'/../../../../autoload.php';
include_once __DIR__ . '/../HtmlGenerator.php';
use PHPUnit\Framework\TestCase;
class HtmlGeneratorTest extends TestCase{

    function setUp(){
        $this->generator = new HtmlGenerator();
    }
    function tearDown(){
    }
    function test_if_functions_are_working(){
        $params = [];
        $content = '';
        $smarty = '';
        $repeat = false;
        $result = smarty_block_panel($params,$content,$smarty,$repeat);
        $result = $this->run_smarty_function('smarty_block_panel',$params,$content);
        $this->assertNotEmpty($result);
        $this->assertContains('panel',$result);
    }
    function test_generating_panel(){
        $content = '';
        $params = [];
        $result = $this->generator->wrapWithPanel($content);
        $expected = $this->run_smarty_function('smarty_block_panel',$params,$content);
        $this->assertEquals($result,$expected);
        
    }
    function run_smarty_function($func_name,$params,$content = ''){
        $smarty = '';
        $repeat = false;
        if(strpos($func_name,'function') !== false)
            return call_user_func($func_name,$params,$content);
        return $func_name($params,$content,$smarty,$repeat);
    }
}
