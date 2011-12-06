<!DOCTYPE html>
<html>
<head>
    <title>Subir Contribuci&oacute;n</title>
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('script/contribucionform.js') ?>"></script>

    <form id="contrib_form" action="<?php echo base_url('contribution/add') ?>" method="post">
    <input type="hidden" value="false" name="is_file" id="is_file" />
    <h1>Subir Contribuci&oacute;n</h1>
    <p>
        <label>
            SubModelo
            <select name="submodel" id="submodel" required>
		<option selected="selected">Elije Submodelo...</option>
            <?php foreach($submodels as $submodel): ?>
                <option value="<?php echo($submodel['id']); ?>"><?php echo($submodel['nombre']); ?></option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>

    <p>
        <label>
            Tipo de contribucion
            <select name="tipoContrib" id="tipoContrib" required>
		<option selected="selected">Elije el tipo de contribuci&oacute;n...</option>
            </select>
        </label>
    </p>
    <p>
        <label id="content_label">
            contenido
        </label>
    </p>
    <div class="metadata" id="metadata">
    </div>

    </form>
    <input type="submit" name="add" value="Subir">

</body>
</html>
