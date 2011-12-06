<!DOCTYPE html>
<html>
<head>
    <title>A&ntilde;adir Referencia</title>
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('script/contribucionform.js') ?>"></script>

    <form id="contrib_form" action="<?php echo base_url('contribution/add') ?>" method="post">
    <input type="hidden" value="<?php echo($contrib)?>" name="contrib" id="contrib" />
    <h1>A&ntilde;adir Referencia</h1>
    <p>
        <label>
            Tipo de Referencia
            <select name="tipoRef" id="tipoRef" required>
		<option selected="selected">Elije el tipo de referencia...</option>
            <?php foreach($refsTypes as $ref): ?>
                <option value="<?php echo($ref['name']); ?>"><?php echo($ref['name']); ?></option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>

    <p>
	Target
        <select name="target" id="target" required>
		<option selected="selected">Elije la contribuci&oacute;n objetivo...</option>
        </select>
    </p>
    <hr >
    <div class="metadata" id="metadata">
    </div>
    <input type="submit" name="add" value="Subir">

    </form>


</body>
</html>
