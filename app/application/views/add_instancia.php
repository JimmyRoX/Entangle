<!DOCTYPE html>
<html>
	<head>
		<title>
			A&ntilde;adiendo Cursos
		</title>
	</head>
	
	<body>
	<h3>A continuaci&oacute;n, ingrese los datos necesarios para la creaci&oacute;n de un nuevo curso</h3>
	<?php echo form_open('instancia/add_instancia') ?>
		
		<fieldset>
		<legend>Nuevo Curso:</legend>
		<p>Nombre:<input id="nombre" name="nombre" type=text/></p>
		<p>Tipo de Curso:<select id="modelo" name="modelo">
			<?php 			
				foreach(array_keys($modelos) as $modelo)
				{
					echo "<option value=\"".$modelos[$modelo]."\">".$modelo."</option>";
				}
				
			?>
		</select></p>
		<p>Administrador:<select id="admins" name="admins"> 
			<?php 
				foreach(array_keys($usuarios) as $usuario)
				{
					echo "<option value=\"".$usuarios[$usuario]."\">".$usuario."</option>";
				}
			?>
		</select></p>
		<p>C&iacute;rculo de Usuarios :<select id="circulo" name="circulo">
			<?php 			
				foreach(array_keys($circulos) as $circulo)
				{
					echo "<option value=\"".$circulos[$circulo]."\">".$circulo."</option>";
				}
				
			?>
		</select></p>

		<input type="submit"  value="Crear"/>
		</fieldset>	
	<?php echo form_close(); ?>	
		
	</body>
</html>
