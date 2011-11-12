<!DOCTYPE html>
<html>
<head>
    <title>Untitled Page</title>
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('script/dynaform.js') ?>"></script>


    <form action="<?php echo base_url('modelo/add') ?>" method="post">
    <h1>
        Agregar Modelo</h1>
    <input type="submit" name="add" value="Crear">
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
                <option><?php echo($name); ?></option>
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
            <label>nombre<input type="text" name="nombre" /></label>
            <label>template<input type="text" name="template" /></label></p>
            <fieldset class="metadata">
                <legend>metadata <a href="#">+</a></legend>

            </fieldset>

            <fieldset class="ref">
                <legend>referencias <a href="#">+</a></legend>
            </fieldset>
        </fieldset>


        <div class="metadata">
        <label>nombre<input type="text" name="nombre" /></label>
        <label>tipo
                <select name="tipo"> 
                    <option value="text">texto</option> 
                    <option value="number">número</option> 
                    <option value="datetime">fecha/hora</option> 
                    <option value="url">url</option>
                    <option     value="file">archivo</option>
                </select>
        </label>
        </div>

        <fieldset class="ref">
            <label>nombre <input type="text" name="nombre"></label>
            <label>tipo destino <input type="text" name="tipo_dest"></label>
            <label>template <input type="text" name="template"></label>
            <fieldset class="metadata">
                <legend>metadata <a href="#">+</a></legend>
            </fieldset>
        </fieldset>

    </div>

</body>
</html>
