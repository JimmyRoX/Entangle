<!DOCTYPE html>
<html>
	<head>
		<title>
			Busqueda de Cursos
		</title>
	</head>
	<body>	
	<div>
	<?php echo form_open('search/search_result') ?>
		<fieldset>
		<legend>Busqueda:</legend>
		<p>Contribucion:<input id="contribucion" name="contribucion" type=text/> Tipo:<input id="tipo" name="tipo" type=text/><input type="submit"  value="Buscar"/></p>
		</fieldset>
				
		<fieldset>
		<legend>Busqueda Avanzada:</legend>
		<p>Curso:<input id="curso" name="curso" type=text/></p>
		<p>Sigla:<input id="sigla" name="sigla" type=text/></p>
		<p>Carrera:<input id="carrera" name="carrera" type=text/></p>
		<p>Autor:<input id="autor" name="autor" type=text/></p>
		</fieldset>	
	<?php echo form_close(); ?>	
	</div>
</body>
</html>
