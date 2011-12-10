<!DOCTYPE html>
<html>
<head>
	<title>Contribuciones</title>
</head>
<body>
	<script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('script/contribucionform.js') ?>"></script>
<h1>Contribuciones</h1>
<p>
	<label>
	    SubModelo
	    <select name="submodel_list" id="submodel_list" required>
		<option selected="selected" value="-1">Seleccione Submodelo...</option>
	    <?php foreach($submodels as $submodel): ?>
		<option value="<?php echo($submodel['id']); ?>"><?php echo($submodel['nombre']); ?></option>
	    <?php endforeach; ?>
	    </select>
	</label>
</p>
<table id="contribs">


</table>

<div style="display: none" id="prototype">
	<form class="reference_form" action="<?php echo base_url('contribution/add_reference') ?>" method="post">
	    <input type="hidden" value="-1" name="contrib_id" class="contrib_id" />
	    <h3>A&ntilde;adir Referencia</h3>
	    <p>
		<label>
		    Tipo de Referencia
		    <select name="reference[tipoRef]" class="tipoRef" required>
			<option selected="selected" value="-1">Elije el tipo de referencia...</option>
		    </select>
		</label>
	    </p>
	    <div class="metadata" class="metadata">
	    </div>
	    <p>
		Target
		<select name="reference[target]" class="target" required>
			<option selected="selected">Nueva Contribuci&oacute;n...</option>
		</select>
	    </p>
	    <div class="newcontrib">
		<label class="content_label"></label>
		<input type="hidden" value="false" name="is_file" class="is_file" />
		<input type="hidden" value="-1" name="contribution[submodel]" class="submodel" />
		<input type="hidden" value="-1" name="contribution[tipoContrib]" class="tipoContrib" />
		<div class="metadata"></div>
	    </div>

	    <input type="submit" name="add" value="A&ntilde;adir">

	</form>
</div>
</body>
</html>
