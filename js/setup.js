$(function(){
    tinySetup();
    $('.filemanager').each(function(i,value){
        $(value).load(function () {
            var old_element = $(this).contents().find('.grid.list-view0')[0]
            var new_element = old_element.cloneNode(true);
            old_element.parentNode.replaceChild(new_element, old_element);
            var content = $(this).contents();
            console.log(content);
            content.find('.file').click(function(e){
                $(this).contents().find('.grid.list-view0').off('click')
                var url = $(this).find(".preview").attr('data-url')
                var modal = $(value).parent().parent().parent();
                var name = modal.attr('for_name'); // TODO too many parents
                var image_input = $(`input[name=${name}]`)
                image_input.val(url)
                $(modal).modal('hide')
                e.preventDefault()
            })
        })
    })
});
