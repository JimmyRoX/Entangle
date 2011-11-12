re_field_id = RegExp('-(\\w+)|(\\w+)$', 'g');

function add_contribfields()
{
    var id = 'contrib-' + $("#contrib .contrib").length;
    var container = $("#prototype > .contrib").clone();
    container.attr('id', id);

    $.map(container.find('input'), function(e, i)
        {
            e = $(e);
            var input_id = id + '-' + e.attr('name');
            e.attr('id', input_id);
            e.attr('name', input_id.replace(re_field_id,'[$1]'));
        }
    );

    var meta_list = container.children('fieldset.metadata');
    var meta_list_id = id + '-metadata';
    var add_meta = meta_list.find('legend a');

    meta_list.attr('id',  meta_list_id);
    

    add_meta.click(
        get_addmeta_function(meta_list)
    );


    var ref_list = container.children('fieldset.ref');
    var ref_list_id = id + '-ref';
    var add_ref = ref_list.find('legend a');

    ref_list.attr('id',  ref_list_id);
    
    add_ref.click(
        get_addref_function(ref_list)
    );
    

    return container;
    
}

function get_addmeta_function(meta_list)
{
    var meta_list_id = meta_list.attr('id');

    return function() {
            var meta_count = meta_list.children('.metadata').length;
            var meta_id = meta_list_id + '-' + meta_count;            
            var meta = $("#prototype > .metadata").clone();

            meta.attr('id', meta_id);

            $.map(meta.find('input,select'), function(e, i)
                {
                    e = $(e);
                    var input_id = meta_id + '-' + e.attr('name');
                    e.attr('id', input_id);
                    e.attr('name', input_id.replace(re_field_id,'[$1]'));
            });

            meta_list.append(meta);
        }
}


function get_addref_function(ref_list)
{
    var ref_list_id = ref_list.attr('id');

    return function() {
            var ref_count = ref_list.children('.ref').length;
            var ref_id = ref_list_id + '-' + ref_count;            
            var ref = $("#prototype > .ref").clone();

            ref.attr('id', ref_id);

            $.map(ref.find('input,select'), function(e, i)
                {
                    e = $(e);
                    var input_id = ref_id + '-' + e.attr('name');
                    e.attr('id', input_id);
                    e.attr('name', input_id.replace(re_field_id,'[$1]'));
            });


            var meta_list = ref.children('fieldset.metadata');
            var meta_list_id = ref_id + '-metadata';
            var add_meta = meta_list.find('legend a');

            meta_list.attr('id', meta_list_id);
            
            console.log(meta_list);

            add_meta.click(
                get_addmeta_function(meta_list)
            );

            ref_list.append(ref);
        }
}
