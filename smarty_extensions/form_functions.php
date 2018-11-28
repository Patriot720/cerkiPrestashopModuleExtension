<?php

// TODO  html construction class
function smarty_block_form($params,$content,&$smarty,&$repeat){
    if(!$repeat){
        $title = isset($params['title']) ? $params['title'] : '';
        $button_text = isset($params['button_text']) ? $params['button_text'] : 'submit';
        $method = isset($params['method']) ? $params['method'] : 'POST';
        $template_vars = $smarty->getTemplateVars();
        $token = isset($template_vars['token']) ? $template_vars['token'] : '';
        $module_name = isset($template_vars['module_name']) ? $template_vars['module_name'] : '';
        $preform = "
        <form  class='defaultForm form-horizontal' method='{$method}'>";
        if($token && $module_name){
        $preform .= "<input type='hidden' name='controller' value='AdminModules'>";
        $preform .= "<input type='hidden' name='configure' value='{$module_name}'>";
        $preform .= "<input type='hidden' name='token' value='{$token}'>";
        }
        $preform .= "
        <div class='panel'>
        <div class='panel-heading'>{$title}</div>
        <div class='form-wrapper'>
            ";
        $postform = "
        </div>
        <div class='panel-footer'>
            <button class='btn btn-default pull-right' type='submit'>
                <i class='process-icon-new'></i>{$button_text}
            </button>
        </div>
        </div>
        </form>
";
        return $preform . $content . $postform;
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

function smarty_function_input_switch($params,&$smarty){
    $enabled = isset($params['enabled']) && $params['enabled'] ? true : false;
    $on_text = $params['on_text'];
    $off_text = $params['off_text'];
    $label = $params['label'];
    $name = $params['name'];

    $slider =  "
<div class='form-group my-2'>
<label class='control-label col-lg-3'>
{$label}
</label>
<div class='col-lg-9'>
<span class='switch prestashop-switch fixed-width-lg'>
    <input type='radio' name='{$name}' id='{$name}_on' value='1'";
    if($enabled) $slider .= "checked='checked'";
    $slider .= ">";
    $slider .= "
    <label for='{$name}_on' class='radioCheck'>{$on_text}</label>
    <input type='radio' name='{$name}' id='{$name}_off' value='0'";
    if(!$enabled)$slider .= "checked='checked'";
    $slider .= ">
    <label for='{$name}_off' class='radioCheck'>{$off_text}</label>
    <a class='slide-button btn'></a>
</span>
</div>
</div>
";
    return $slider;
}

function smarty_function_input_textarea($params,&$smarty){
    $label = $params['label'];
    $rows = isset($params['rows']) ? $params['rows'] : 3;
    $disable_rte = isset($params['disable_rte']) ? '' : 'rte autoload_rte';
    $text = isset($params['text']) ? $params['text'] : '';
return 
"<div class='form-group'>
    <label class='control-label col-lg-3'>{$label}</label>
    <div class='col-lg-9'>
        <textarea class='form-control {$disable_rte}' name='text' id='text' rows='{$rows}'>{$text}</textarea>
    </div>
</div>";
}

function smarty_function_input_image($params,&$smarty){
    $name = $params['name'];
    $image_url = isset($params['image_url']) ? $image_url : '';
    $frame = $smarty->getTemplateVars()['frame'];
    $button_text = isset($params['button_text']) ? $button_text : 'Add image';
    return "
<div class='form-group my-2'>
    <label class='control-label col-lg-3'>label</label>
    <div class='col-lg-9'>
        <div class='input-group'>
            <input type='text' aria-describedby='helpId' name='{$name}' value='{$image_url}'>
            <span class='input-group-btn'>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#{$name}_modal'>{$button_text}</button>
            </span>
        </div>
    </div>
</div>
<div class='modal fade' id='{$name}_modal' tabindex='-1' role='dialog' for_name='{$name}' aria-labelledby='modelTitleId' aria-hidden='true'>
    <div class='modal-dialog modal-lg' style='height:80%' role='document'>
        <div class='modal-content' style='height:100%'>
            <iframe src='{$frame}' class='filemanager' frameborder='0' style='width:100%;height:100%'></iframe>
        </div>
    </div>
</div>
";
} // TODO dependant on Controller and smarty variables
