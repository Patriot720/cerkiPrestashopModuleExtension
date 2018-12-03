<?php
use PHPHtmlParser\Dom;
// TODO php-html-builder
class HtmlGenerator{
    function __construct(){
        $dom = new Dom();
        $this->node = $dom->load('<div></div>');
    }
    function wrapWithPanel($content){
        var_dump(get_class_methods($this->node));
        die();
    }
    function wrapWithPanel1($content){
        $content = "<div class='panel d-flex align-items-stretch'>
                    " . $content;
        $content .= '</div>';
        return $content;
    }


}
