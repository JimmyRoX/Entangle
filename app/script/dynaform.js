re_field_id = RegExp('-(\\w+)|(\\w+)$', 'g');

function set_additems()
{
    $('#contrib .metalist').each( function(ix, e){
        var meta_list = $(e);
        console.log(meta_list);
        meta_list.find('.add_meta').click(get_addmeta_function(meta_list, true));
    }
    );

    $('#contrib .reflist').each(function(ix, e){
        var ref_list = $(e);
        ref_list.find('.add_ref').click(get_addref_function(ref_list));
    }
    );

    $('#contrib .metareflist').each(function(ix, e){
        var metaref_list = $(e);
        metaref_list.find('.add_metaref').click(get_addmeta_function(metaref_list, false));
    }
    );
}

function add_contribfields()
{
    var id = 'contrib-' + $("#contrib .contrib").length;
    var container = $("#prototype > .contrib").clone();
    container.attr('id', id);

    $.map(container.find('input,select'), function(e, i)
        {
            e = $(e);
            var input_id = id + '-' + e.attr('name');
            e.attr('id', input_id);
            e.attr('name', input_id.replace(re_field_id,'[$1]'));
        }
    );

    var meta_list = container.children('.metalist');
    var meta_list_id = id + '-metadata';
    var add_meta = meta_list.find('legend a.add_meta');

    meta_list.attr('id',  meta_list_id);
    

    add_meta.click(
        get_addmeta_function(meta_list, true)
    );


    var ref_list = container.children('.reflist');
    var ref_list_id = id + '-refs';
    var add_ref = ref_list.find('legend a.add_ref');

    ref_list.attr('id',  ref_list_id);
    
    add_ref.click(
        get_addref_function(ref_list)
    );
    
    container.find('.delete').click(function(e) { container.remove() } );
    $('#contrib').append(container);

    return false;
    
}

function get_addmeta_function(meta_list, widget)
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

            meta.find('.delete').click(function(e){ meta.remove() });

            if( !widget )
            {
                meta.find('.widget').remove();
            }
            meta_list.append(meta);
            
            return false;
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


            var meta_list = ref.children('.metareflist');
            var meta_list_id = ref_id + '-metadata';
            var add_meta = meta_list.find('legend a.add_metaref');

            meta_list.attr('id', meta_list_id);
        
            add_meta.click( get_addmeta_function(meta_list, false) );
            
            ref.find('.delete').click(function(e) { ref.remove() });

            ref_list.append(ref);

            return false;
        }
}
