<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('script/dynaform.js') ?>"></script>


    <form action="<?php echo base_url('modelo/add') ?>" method="post" enctype="multipart/form-data">
    <h1><?php echo $title ?></h1>
    <input type="submit" name="add" value="Crear">
    <p>
        <label>
            nombre
            <input type="text" name="nombre" required>
        </label>
    </p>
    <p>
        <label>
            admin
            <select name="circle[]" multiple required>
            <?php foreach($admin as $circle): ?>
                <option value="<?php echo $circle['_id']?>"><?php echo($circle['name']); ?></option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>
    <hr >
    <h2>
        Contribuciones <a href="#" id="add_contrib">+</a> </h2>
    
    <script type="text/javascript">
        $('#add_contrib').click(add_contribfields);
    </script>
    
    <div id="contrib">
        
    </div>
    
    </form>

    <div style="display: none" id="prototype">

        <fieldset class="contrib"><legend>contribución</legend><p>
            <label>nombre<input type="text" name="nombre" required /></label>
            <label>widget (browsing)<input type="file" name="widget_browsing" required/></label>
            <label>widget (display)<input type="file" name="widget_display" required/></label>
            <div><label>tipo contribucion
                <select name="content">
                    <option>string</option>
                    <option value="text">texto</option>
                    <option value="file">archivo</option>
                    <option>url</option>
                </select>
            </label></div>
            </p>

            <fieldset class="metalist">
                <legend>metadata <a class="add_meta" href="#">+</a></legend>

            </fieldset>

            <fieldset class="reflist">
                <legend>referencias <a class="add_ref" href="#">+</a></legend>
            </fieldset>
        </fieldset>


        <div class="metadata">
            <label>nombre<input type="text" name="name" required/></label>
            <label>tipo
                    <select name="tipo" required> 
                        <option value="string">string</option> 
                        <option value="text">texto</option> 
                        <option value="number">número</option> 
                        <option value="datetime">fecha/hora</option> 
                        <option value="url">url</option>
                        <option value="file">archivo</option>
                    </select>
            </label>
            <label class="widget"><input type="file" name="widget"></label>
        </div>

        <fieldset class="ref">
            <label>nombre <input type="text" name="name" required></label>
            <label>tipo destino <input type="text" name="tipo_destino" required></label>
            <fieldset class="metareflist">
                <legend>metadata <a class="add_metaref" href="#">+</a></legend>
            </fieldset>
        </fieldset>
    </div>
</body>
</html>