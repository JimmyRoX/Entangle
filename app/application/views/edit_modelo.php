<!DOCTYPE html>
<html>
<head>
    <title>Untitled Page</title>
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('script/dynaform.js') ?>">

    </script>
    <form action="<?php echo base_url('modelo') ?>" method="get">
    <input type="hidden" value="<?php echo $id ?>" >
    <h1>
        Agregar Modelo</h1>
    <input type="submit" title="hai" >
    <p>
        <label>
            nombre
            <input type="text" name="nombre" >
        </label>
    </p>
    <p>
        <label>
            admin
            <select name="admin[]" multiple>
            <?php foreach($admin as $name): ?>
                <option <?php if(in_array($admin, $old_admin)) { echo "selected" } ?> >
                    <?php echo($name); ?>
                </option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>
    <hr >
    <h2>
        Contribuciones <a href="#" id="add_contrib">+</a> </h2>
    
    <script type="text/javascript">

        
        $('#add_contrib').click(function (ev) {
            var count = $('#contrib .contrib').length;
            
            $('#contrib').append(gen_contribfields(count));
        });

    </script>
    <div id="contrib">
        <?php $c_id = 0;
            foreach($old_contrib as $contrib): ?>
            <fieldset class="contrib"><legend>contribución</legend><p>
                <label>nombre
                    <input type="text" name="contrib[<?php echo $c_id ?>][name]" value="<?php echo $contrib["nombre"] ?>" />
                </label>
                <label>template
                    <input type="text" name="contrib[<?php echo $c_id ?>][template]" value="<?php echo $contrib["template"] ?>" />
                </label> </p>

                <fieldset>
                <label>metadata <a href="#"></label>

                <?php $m_id = 0; foreach($contrib['metadata'] as $meta): ?>
                    <div><label>
                            <input type="text" name="contrib[<?php echo $c_id ?>][metadata][<?php echo $m_id ?>][name]" />
                        </label>
                        <label>tipo
                            <select name="' + parent_id + '[metadata][' + count + '][name]">
                                <option value="text">texto</option>
                                <option value="number">número</option>
                                <option value="datetime">fecha/hora</option>
                                <option value="url">url</option>
                                <option value="file">archivo</option>
                            </select>
                        </label>
                    </div>
                <?php $m_id++;  endforeach; ?>
                </fieldset>

            </fieldset>
            
        <?php $c_id++;
            endforeach; ?>
    </div>
    </form>
</body>
</html>
