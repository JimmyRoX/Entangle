<!DOCTYPE html>
<html>
<head>
	<title>Contribuciones</title>
</head>
<body>
	<script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('script/contribution_list.js') ?>"></script>
<h1>Contribuciones</h1>
<p>
	<label>
	    SubModelo
	    <select name="submodel" id="submodel" required>
		<option selected="selected">Seleccione Submodelo</option>
	    <?php foreach($submodels as $submodel): ?>
		<option value="<?php echo($submodel['id']); ?>"><?php echo($submodel['nombre']); ?></option>
	    <?php endforeach; ?>
	    </select>
	</label>
</p>
<table id="contribs">


</table>
</body>
</html>
