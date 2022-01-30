function showTree(data)
{
	$('#tree_menu').on('changed.jstree', function (e, data) {

        var i, j;
        var selected=data.instance.get_selected();

        for(i = 0, j = selected.length; i < j; i++)
        {
            selected = selected.concat(data.instance.get_node(selected[i]).parents);
        }

        selected = $.vakata.array_unique(selected);
        selected = $.grep(selected, function(value) {
            return value != '#';
        });

        $("input[name='permissions']").val(selected);

        if($("input[name='permissions']").val()!='')
        {
            $("#permissions-error").css("display", "none");
        }
        else
        {
            $("#permissions-error").css("display", "block");
        }

    })
    .jstree({
        'core':
        {
            'data': data
        },
        'plugins': ['checkbox'],
    });
}

$("input[name='display_name']").change(function(){
  $(this).val($.trim($(this).val()));
})