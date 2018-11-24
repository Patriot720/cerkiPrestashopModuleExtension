<?php

function smarty_function_keepo($params,&$smarty){
    return 'keepo';
}
function smarty_block_panel($params,$content,&$smarty,&$repeat){
    if(!$repeat){
        $content = "<div class='panel'>" . $content;
        $content .= '</div>';
        return $content;
    }
}
function smarty_block_form($params,$content,&$smarty,&$repeat){
    if(!$repeat){
        $title = isset($params['title']) ? $params['title'] : '';
        $button_text = isset($params['button_text']) ? $params['button_text'] : 'submit';
        $method = isset($params['method']) ? $params['method'] : 'POST';
        $content = "
        <form  class='defaultForm form-horizontal' method='{$method}'>
        <div class='panel'>
        <div class='panel-heading'>{$title}</div>
        <div class='form-wrapper'>
            " . $content;
        $content .= "
        </div>
        <div class='panel-footer'>
            <button class='btn btn-default pull-right' type='submit'>
                <i class='process-icon-new'></i>{$button_text}
            </button>
        </div>
        </div>
        </form>
";
        return $content;
    }
}
function smarty_function_input_text($params,&$smarty){
    $label = $params['label'];
    $value =  $params['value'] ;
    $name = $params['name'];
    $description = isset($params['description']) ? $params['description'] : '';
    return "
<div class='form-group'>
<div>
<label class='control-label col-lg-3'>
    {$label}
</label>
<div class='col-lg-9'>
    <input class='form-control ' type='text' name='{$name}' value='{$value}'>
</div>
<div class='col-lg-9 col-lg-offset-3'>
    <div class='helper-block'>
    {$description}
    </div>
</div>
</div>
</div>
";
}
