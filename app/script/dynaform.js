function gen_contribfields(count) {
    var id = 'contrib['+count+']';

    var container = $('<fieldset class="contrib"><legend>contribución</legend><p> \
                <label>nombre<input type="text" name="' + id + '[name]" /></label> \
                <label>template<input type="text" name="' + id + '][template]" /></label></p> \
    </fieldset>');

    
    var meta_container = $(document.createElement('fieldset'));

    var meta_adder = meta_container.append($('<legend>metadata</legend>')
            .append('<a href="#">+</a>').click(
        function (ev) {
            c = $(ev.target).parent().parent().find("div").length;
            metafield = gen_metadatafields(id, c);
            meta_container.append(metafield);
        }));



        container.append(meta_container);
        
        return container;
}


function gen_metadatafields(parent_id, count) {

return $('<div> \
    <label> \
        <input type="text" name="' + parent_id + '[metadata][' + count + '][name]" /></label>  \
            <label>tipo \
                <select name="' + parent_id + '[metadata][' + count + '][type]"> \
                    <option value="text">texto</option> \
                    <option value="number">número</option> \
                    <option value="datetime">fecha/hora</option> \
                    <option value="url">url</option> \
                    <option value="file">archivo</option> \
                </select></label> \
</div>');
}
