<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('script/contribucionform.js') ?>"></script>

    <form action="#<?php //echo base_url('contribucion/add') ?>" method="post">
    <h1><?php echo $title ?></h1>
    <p>
        <label>
            Modelo (TODO: reemplazar con circulos - instancias de modelos)
            <select name="modelo" id="modelo" required>
		<option selected="selected"></option>
            <?php foreach($modelos as $modelo): ?>
                <option value="<?php echo($modelo['id']); ?>"><?php echo($modelo['nombre']); ?></option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>



    <input type="submit" name="add" value="Subir">
    <p>
        <label>
            Tipo de contribucion
            <select name="tipo" id="tipo" required>
		<option selected="selected"></option>
            </select>
        </label>
    </p>
    <p>
        <label>
            nombre
            <input type="text" name="nombre" required>
        </label>
    </p>
    <hr >
    <h2>Metadata</h2>
    <div class="metadata" id="metadata">
    </div>

    </form>


</body>
</html>
